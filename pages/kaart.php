<?php
require_once '../includes/databaseconnector.php';

$db = connect_db();

// Controleer actie
if (!isset($_REQUEST['actie'])) {
    header('Location: inventaris.php');
    die();
}

$actie = $_REQUEST['actie'];
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
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
        <h1>📚 Kaartenbak P.J. Ros</h1>
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
                echo "<form method='post' action='kaart.php'>";
                echo "<label for='title'>Titel:</label>";
                echo "<input type='text' id='title' name='title' required>";
                echo "<label for='content'>Inhoud:</label>";
                echo "<textarea id='content' name='content'></textarea>";
                echo "<button type='submit' class='btn btn-primary'>💾 Opslaan</button>";
                echo "</form>";
            } else if ($actie == 'wijzigen' && $id) {
                echo "<h2>✏️ Kaart Bewerken</h2>";
                echo "<form method='post' action='kaart.php'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($id) . "'>";
                echo "<label for='title'>Titel:</label>";
                echo "<input type='text' id='title' name='title' required>";
                echo "<label for='content'>Inhoud:</label>";
                echo "<textarea id='content' name='content'></textarea>";
                echo "<div class='btn-group'>";
                echo "<button type='submit' class='btn btn-primary'>💾 Opslaan</button>";
                echo "<button type='button' class='btn btn-danger' onclick='if(confirm(\"Weet je zeker?\")) window.location=\"inventaris.php\";'>🗑️ Verwijderen</button>";
                echo "</div>";
                echo "</form>";
            } else if ($actie == 'bekijken' && $id) {
                echo "<h2>👁️ Kaart Details</h2>";
                echo "<div class='info-box'>";
                echo "<p><strong>ID:</strong> " . htmlspecialchars($id) . "</p>";
                echo "<p><strong>Titel:</strong> Kaartgegevens laden...</p>";
                echo "<p><strong>Inhoud:</strong> Kaartgegevens laden...</p>";
                echo "</div>";
                echo "<div class='btn-group'>";
                echo "<a href='kaart.php?actie=wijzigen&id=" . htmlspecialchars($id) . "' class='btn btn-primary'>✏️ Bewerken</a>";
                echo "<a href='inventaris.php' class='btn btn-secondary'>← Terug</a>";
                echo "</div>";
            } else {
                echo "<div class='warning-box'>⚠️ Onbekende actie of ontbrekende ID</div>";
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
