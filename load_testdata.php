<?php
require_once 'includes/databaseconnector.php';

$db = connect_db();

// Verwijder alle huidige data
$db->query("DELETE FROM kernen");

// Voeg testdata in met verhalen
$data = [
    ['000. Genesis', 'In het begin schiep God de hemel en de aarde. De aarde was woest en ledig, en duisternis was op het aangezicht der afgrond; en de Geest Gods zweefde over de wateren.'],
    
    ['000. Registers', 'Dit is een overzicht van alle belangrijke kaarten en hun inhoud. De kaarten zijn geordend naar bijbelboeken en verzen.'],
    
    ['000. Synoptici', 'Een synoptische weergave van parallelle evangelieën, met vergelijkingen van verhalen die in meerdere evangeliën voorkomen.'],
    
    ['0000. Kernwoorden', 'Kernwoorden en belangrijke begrippen uit de bijbel, zoals verlossing, genade, hoop en liefde.'],
    
    ['01. Gen. 01', 'Genesis 1 - De schepping. God schiep in zes dagen de hemel, de aarde en alles wat daarin is. Op de zevende dag rustte Hij.'],
    
    ['01. Gen. 01:01-02', 'In het begin schiep God de hemel en de aarde. En de aarde was woest en ledig, en duisternis was op het aangezicht der afgrond; en de Geest Gods zweefde over de wateren.'],
    
    ['01. Gen. 01:01-03', 'In het begin schiep God de hemel en de aarde. En de aarde was woest en ledig, en duisternis was op het aangezicht der afgrond; en de Geest Gods zweefde over de wateren. En God zeide: Laat er licht zijn! En er werd licht.'],
    
    ['01. Gen. 01:01-04', 'In het begin schiep God de hemel en de aarde. En de aarde was woest en ledig, en duisternis was op het aangezicht der afgrond; en de Geest Gods zweefde over de wateren. En God zeide: Laat er licht zijn! En er werd licht. En God zag, dat het licht goed was.'],
    
    ['01. Gen. 01:01-19', 'De volledige eerste dag van de schepping, met de scheiding van licht en duisternis, en de vorming van de hemellichamen.'],
    
    ['01. Gen. 01:02, 07', 'En de aarde was woest en ledig, en duisternis was op het aangezicht der afgrond; en de Geest Gods zweefde over de wateren. En God maakte het firmament, en scheidde de wateren onder het firmament van de wateren boven het firmament.'],
    
    ['01. Gen. 01:04-05', 'En God zag, dat het licht goed was; en God scheidde het licht van de duisternis. En God noemde het licht Dag, en de duisternis noemde Hij Nacht.'],
    
    ['01. Gen. 01:09-13', 'De derde dag van de schepping - het ontstaan van de aarde, planten en bomen.'],
    
    ['01. Gen. 01:14-16', 'De vierde dag - de schepping van zon, maan en sterren.'],
    
    ['01. Gen. 01:20 - 02:02', 'De vijfde en zesde dag - de schepping van dieren en de mens, gevolgd door Gods rust.'],
    
    ['01. Gen. 01:24-26', 'En God zeide: Laat de aarde voortbrengen levende wezens naar hun aard, runderen en kruipende dieren en het gedierte der aarde naar zijn aard. En het werd zoo. En God maakte het gedierte der aarde naar zijn aard, en het vee naar zijn aard, en alles wat op de grond kruipt naar zijn aard.'],
    
    ['01. Gen. 01:26-31', 'En God zeide: Laat ons mensen maken naar ons beeld, naar ons gelijkenis. En zij zullen heerschappij hebben over de vissen der zee, en over het gevogelte des hemels, en over het vee, en over de ganse aarde.'],
    
    ['01. Gen. 02:01 en 02', 'Dus werden voltooid de hemel en de aarde, en al hun heir. En God voltooide op den zevenden dag zijn werk, dat Hij gemaakt had; en Hij rustte op den zevenden dag van al zijn werk, dat Hij gemaakt had.'],
];

foreach ($data as $row) {
    $title = $row[0];
    $content = $row[1];
    $stmt = $db->prepare("INSERT INTO kernen (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    $stmt->close();
}

echo "✅ <h2>Testdata succesvol ingevoerd!</h2>";
echo "<p>17 kaarten met verhalen zijn toegevoegd.</p>";
echo "<p><a href='pages/inventaris.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px;'>→ Ga naar Kaartenbak</a></p>";
?>
