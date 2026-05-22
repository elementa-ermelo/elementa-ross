<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Probeer simpele verbinding
$host = "localhost";
$user = "root";
$password = "";

$connect = mysqli_connect($host, $user, $password);

if (!$connect) {
    echo "<h2>❌ Kan niet verbinden met MySQL</h2>";
    echo "<p>Fout: " . mysqli_connect_error() . "</p>";
    echo "<p>Zorg dat:</p>";
    echo "<ul>";
    echo "<li>MySQL server draait</li>";
    echo "<li>XAMPP gestart is</li>";
    echo "<li>De gebruiker 'ros' bestaat</li>";
    echo "</ul>";
    exit;
}

echo "<h2>✅ MySQL verbinding OK</h2>";

// Probeer database aan te maken
$sql_create_db = "CREATE DATABASE IF NOT EXISTS ros CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (mysqli_query($connect, $sql_create_db)) {
    echo "<p>✅ Database 'ros' aangemaakt/bestaat al</p>";
} else {
    echo "<p>❌ Fout bij database: " . mysqli_error($connect) . "</p>";
    exit;
}

// Selecteer database
mysqli_select_db($connect, "ros");

// Probeer tabel aan te maken
$sql_create_table = "CREATE TABLE IF NOT EXISTS kernen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL UNIQUE,
    content LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if (mysqli_query($connect, $sql_create_table)) {
    echo "<p>✅ Tabel 'kernen' aangemaakt/bestaat al</p>";
} else {
    echo "<p>❌ Fout bij tabel: " . mysqli_error($connect) . "</p>";
    exit;
}

// Controleer hoeveel kaarten er zijn
$result = mysqli_query($connect, "SELECT COUNT(*) as count FROM kernen");
$row = mysqli_fetch_assoc($result);

if ($row['count'] == 0) {
    echo "<p>⚠️ Database is leeg. Voeg testdata toe...</p>";
    
    $test_data = [
        "000. Genesis",
        "000. Registers",
        "000. Synoptici",
        "0000. Kernwoorden",
        "01. Gen. 01",
        "01. Gen. 01:01-02",
        "01. Gen. 01:01-03",
        "01. Gen. 01:01-04",
        "01. Gen. 01:01-19",
        "01. Gen. 01:02, 07",
        "01. Gen. 01:04-05",
        "01. Gen. 01:09-13",
        "01. Gen. 01:14-16",
        "01. Gen. 01:20 - 02:02",
        "01. Gen. 01:24-26",
        "01. Gen. 01:26-31",
        "01. Gen. 02:01 en 02"
    ];
    
    foreach ($test_data as $title) {
        $sql_insert = "INSERT IGNORE INTO kernen (title, content) VALUES ('" . mysqli_real_escape_string($connect, $title) . "', 'Inhoud hier...')";
        mysqli_query($connect, $sql_insert);
    }
    
    echo "<p>✅ Testdata ingevuegd</p>";
} else {
    echo "<p>✅ Database bevat " . $row['count'] . " kaarten</p>";
}

// Toon samenvatte
echo "<h2>🎉 Setup Voltooid!</h2>";
echo "<p><a href='/pages/inventaris.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px;'>→ Ga naar Kaartenbak</a></p>";

mysqli_close($connect);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Setup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: #f5f5f5;
        }
        h2 {
            color: #333;
        }
        p {
            line-height: 1.8;
        }
        a {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
</body>
</html>
