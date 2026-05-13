<?php
require_once '../includes/databaseconnector.php';

$db = connect_db();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris - Kaartenbak P.J. Ros</title>
    <link href='../public/css/abonn.css' type='text/css' rel='stylesheet'>
</head>
<body>
    <header>
        <h1>📚 Kaartenbak P.J. Ros</h1>
        <nav>
            <a href="inventaris.php">Inventaris</a>
            <a href="kaart.php?actie=nieuw">+ Nieuwe Kaart</a>
            <a href="../index.php?logout=1">Logout</a>
        </nav>
    </header>

    <div class="container">
        <div class="dashboard">
            <div class="dashboard-header">
                <h2>📖 Kaarten Overzicht</h2>
                <div class="btn-group">
                    <a href="kaart.php?actie=nieuw" class="btn btn-primary">+ Nieuwe Kaart</a>
                </div>
            </div>

            <div class="search-bar">
                <form method='post' style="display: flex; gap: 10px; width: 100%;">
                    <input type='text' name='zoekstring' placeholder='Zoek kaarten... (typ * voor alles)' value="<?php echo isset($_REQUEST['zoekstring']) ? htmlspecialchars($_REQUEST['zoekstring']) : ''; ?>">
                    <button type="submit" name="zoek">🔍 Zoeken</button>
                </form>
            </div>

            <?php
            // Bepaal welke kaarten getoond moeten worden
            if (isset($_REQUEST['zoekstring'])) {
                if ($_REQUEST['zoekstring'] == '*') {
                    echo "<div class='info-box'>📋 Alle kaarten zijn afgebeeld</div>";
                    $stmt = $db->prepare("SELECT id, title FROM kernen ORDER BY title ASC");
                } else if ($_REQUEST['zoekstring'] != '') {
                    echo "<div class='info-box'>🔍 Zoekresultaten voor: <strong>" . htmlspecialchars($_REQUEST['zoekstring']) . "</strong></div>";
                    $stmt = $db->prepare("SELECT id, title FROM kernen WHERE title LIKE ? ORDER BY title ASC");
                    $search = "%" . $_REQUEST['zoekstring'] . "%";
                    $stmt->bind_param("s", $search);
                } else {
                    echo "<div class='info-box'>📖 De laatste 30 kaarten (typ * voor alles)</div>";
                    $stmt = $db->prepare("SELECT id, title FROM kernen ORDER BY title ASC LIMIT 30");
                }
            } else {
                echo "<div class='info-box'>📖 De laatste 30 kaarten (typ * voor alles)</div>";
                $stmt = $db->prepare("SELECT id, title FROM kernen ORDER BY title ASC LIMIT 30");
            }

            if (!$stmt) {
                die("<div class='warning-box'>❌ Databasefout: " . $db->error . "</div>");
            }

            if (!$stmt->execute()) {
                die("<div class='warning-box'>❌ Query fout: " . $stmt->error . "</div>");
            }

            $result = $stmt->get_result();
            
            if (!$result) {
                die("<div class='warning-box'>❌ Result fout: " . $db->error . "</div>");
            }

            $kaarten = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            if (count($kaarten) > 0) {
                echo "<div class='cards-grid'>";
                
                foreach ($kaarten as $kaart) {
                    echo "<div class='card'>";
                    echo "<div class='card-id'>#" . htmlspecialchars($kaart['id']) . "</div>";
                    echo "<div class='card-title'>" . htmlspecialchars($kaart['title']) . "</div>";
                    echo "<div class='card-actions'>";
                    echo "<a href='kaart.php?actie=bekijken&id=" . htmlspecialchars($kaart['id']) . "' class='card-actions edit-btn'>👁️ Bekijken</a>";
                    echo "<a href='kaart.php?actie=wijzigen&id=" . htmlspecialchars($kaart['id']) . "' class='card-actions edit-btn'>✏️ Bewerken</a>";
                    echo "</div>";
                    echo "</div>";
                }
                
                echo "</div>";
                echo "<div class='info-box'>✅ " . count($kaarten) . " kaart(en) gevonden</div>";
            } else {
                echo "<div class='warning-box'>⚠️ Geen kaarten gevonden in de database. De database is leeg of de tabel 'kernen' bestaat niet.</div>";
            }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Kaartenbak P.J. Ros - Alle rechten voorbehouden</p>
    </footer>
</body>
</html>
