<?php
require_once '../includes/databaseconnector.php';

$db = connect_db();

// Controleer actie
if (!isset($_REQUEST['actie'])) {
    header('Location: inventaris.php');
    die();
}

$actie = $_REQUEST['actie'];
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : null;

// Verwijderen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    if ($id) {
        $stmt = $db->prepare("DELETE FROM kernen WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header('Location: inventaris.php');
            exit();
        }
    }
}

// Opslaan (nieuw of wijzigen)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $title = $_POST['title'];
    $text = $_POST['text'] ?? '';

    if ($actie == 'nieuw') {
        $stmt = $db->prepare("INSERT INTO kernen (title, text) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $text);
        if ($stmt->execute()) {
            header('Location: inventaris.php');
            exit();
        }
    } else if ($actie == 'wijzigen' && $id) {
        $stmt = $db->prepare("UPDATE kernen SET title = ?, text = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $text, $id);
        if ($stmt->execute()) {
            header('Location: inventaris.php');
            exit();
        }
    }
}

// Haal kaart op voor bewerken/bekijken
$kaart = null;
if ($id && ($actie == 'wijzigen' || $actie == 'bekijken')) {
    $stmt = $db->prepare("SELECT id, title, text FROM kernen WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $kaart = $result->fetch_assoc();
    $stmt->close();

    if (!$kaart) {
        header('Location: inventaris.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaart - Kaartenbak P.J. Ros</title>
    <link href='../public/css/abonn.css' type='text/css' rel='stylesheet'>
</head>
<body>
    <header>
        <h1>📚 Kaartenbak P.J Em. Ds. Ros</h1>
        <nav>
            <a href="inventaris.php">← Terug naar Inventaris</a>
            <a href="kaart.php?actie=nieuw">+ Nieuwe Kaart</a>
            <a href="../index.php?logout=1">Logout</a>
        </nav>
    </header>

    <div class="container">
        <div class="dashboard">
            <?php
            if ($actie == 'nieuw') {
                echo "<h2>➕ Nieuwe Kaart Toevoegen</h2>";
                echo "<form method='post'>";
                echo "<div class='form-group'>";
                echo "<label for='title'>Titel:</label>";
                echo "<input type='text' id='title' name='title' placeholder='Bijv: 01. Gen. 01' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='text'>Verhaal / Inhoud:</label>";
                echo "<textarea id='text' name='text' placeholder='Voer het verhaal hier in...' rows='15'></textarea>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-primary'>💾 Opslaan</button>";
                echo "</form>";
            } else if ($actie == 'wijzigen' && $kaart) {
                echo "<h2>✏️ Kaart Bewerken</h2>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($kaart['id'] ?? '') . "'>";
                echo "<div class='form-group'>";
                echo "<label for='title'>Titel:</label>";
                echo "<input type='text' id='title' name='title' value='" . htmlspecialchars($kaart['title'] ?? '') . "' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='text'>Verhaal / Inhoud:</label>";
                echo "<textarea id='text' name='text' rows='15'>" . htmlspecialchars($kaart['text'] ?? '') . "</textarea>";
                echo "</div>";
                echo "<div class='btn-group'>";
                echo "<button type='submit' class='btn btn-primary'>💾 Opslaan</button>";
                echo "<button type='submit' name='delete' value='1' class='btn btn-danger' onclick='return confirm(\"Weet je zeker dat je deze kaart wilt verwijderen?\");'>🗑️ Verwijderen</button>";
                echo "</div>";
                echo "</form>";
            } else if ($actie == 'bekijken' && $kaart) {
                echo "<h2>👁️ " . htmlspecialchars($kaart['title'] ?? '') . "</h2>";
                echo "<div class='info-box'>";
                echo "<p><strong>ID:</strong> #" . htmlspecialchars($kaart['id'] ?? '') . "</p>";
                echo "<p><strong>Titel:</strong> " . htmlspecialchars($kaart['title'] ?? '') . "</p>";
                echo "</div>";
                echo "<div style='background: white; padding: 20px; border-radius: 8px; margin: 20px 0;'>";
                echo "<h3>Verhaal:</h3>";
                echo "<p style='line-height: 1.8; white-space: pre-wrap;'>" . htmlspecialchars($kaart['text'] ?? '') . "</p>";
                echo "</div>";
                echo "<div class='btn-group'>";
                echo "<a href='kaart.php?actie=wijzigen&id=" . htmlspecialchars($kaart['id'] ?? '') . "' class='btn btn-primary'>✏️ Bewerken</a>";
                echo "<a href='inventaris.php' class='btn btn-secondary'>← Terug</a>";
                echo "</div>";
            } else {
                echo "<div class='warning-box'>⚠️ Onbekende actie of kaart niet gevonden</div>";
                echo "<a href='inventaris.php' class='btn btn-secondary'>← Terug naar inventaris</a>";
            }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Kaartenbak P.J. Ros - Alle rechten voorbehouden</p>
    </footer>
</body>
</html>
