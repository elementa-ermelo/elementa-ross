<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_REQUEST['f']) ? trim($_REQUEST['f']) : '';
    $password = isset($_REQUEST['h']) ? trim($_REQUEST['h']) : '';

    if ($username == "pjros" && $password == "cardfile") {
        setcookie("ros_auth", $username . ':' . $password, 0, "/");
        header('Location: /pages/inventaris.php');
        exit();
    } else {
        $err = "❌ Foutieve gebruikersnaam of wachtwoord. Gebruik: pjros / cardfile";
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
            <h2>📚 Kaartenbak P.J Em. Ds. Ros</h2>

            <?php
            if (isset($err)) {
                echo "<div class='error-message'>" . htmlspecialchars($err) . "</div>";
            }
            ?>

            <form name="x" method="post" action="/auth/login.php">
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
