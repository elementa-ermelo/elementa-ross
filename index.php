<?php
require_once 'includes/databaseconnector.php';

$db = connect_db();

// Controleer logout request
if (isset($_REQUEST['logout'])) {
    setcookie("ros_auth", "", time() - 3600);
    require_once 'auth/login.php';
    die();
}

// Controleer authenticatie
if (!isset($_COOKIE["ros_auth"])) {
    require_once 'auth/login.php';
    die();
} else {
    if ($_COOKIE["ros_auth"] != "pjros:cardfile") {
        require_once 'auth/login.php';
        die();
    }
}

// Redirect naar inventaris pagina
header('Location: pages/inventaris.php');
die();
?>
