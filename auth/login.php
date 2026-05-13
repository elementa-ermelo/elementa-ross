<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_REQUEST['f'] == "pjros" && $_REQUEST['h'] == "cardfile") {
        setcookie("ros_auth", $_REQUEST['f'] . ':' . $_REQUEST['h']);
        header('Location: /');
        die();
    } else {
        $err = "❌ Foutieve gebruikersnaam of wachtwoord";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kaartenbak P.J. Ros</title>
    <link href='../public/css/abonn.css' type='text/css' rel='stylesheet'>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>📚 Kaartenbak P.J. Ros</h2>
            
            <?php
            if (isset($err)) {
                echo "<div class='error-message'>" . $err . "</div>";
            }
            ?>
            
            <form name="x" method="post" action="login.php">
                <div class="form-group">
                    <label for="username">👤 Gebruikersnaam</label>
                    <input type="text" id="username" name="f" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password">🔐 Wachtwoord</label>
                    <input type="password" id="password" name="h" required>
                </div>
                
                <button type="submit">Login →</button>
            </form>
        </div>
    </div>
</body>
</html>
</body>
</html>
