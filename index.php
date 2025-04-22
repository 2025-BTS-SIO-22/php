<?php
session_start();
$error = '';
if (array_key_exists('error', $_SESSION)) {
    $error = $_SESSION["error"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleindex.css">
    <title>AlexInc</title>
</head>

<body>
<div class="containerformulaire">
    <div class="formulaire">
        <form action="login.php" method="post">
            <ul>
                <ul>
                    <div class="error"><?= $error; ?></div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username"/>
                </ul>
                <ul>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password"/>
                </ul>
                <ul>
                    <label for="submit"></label>
                    <input type="submit" id="submit" name="submit"/>
                </ul>
            </ul>
        </form>
    </div>
</div>
</body>
</html>