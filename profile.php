<?php
session_start();

include "session.php";
require_once "conexion.php";
$username = $_SESSION["username"];
$stmt = $conn->prepare("Select * from user WHERE username = :username");

$stmt->bindParam("username", $username); //variable username == "remplazar "s", " parametro
$stmt->execute(); // ejecuta bindParam


$result = $stmt->fetch(); //fetch ejecuta request completa y regresa resultado
if (!$result) {
    die("No se encuentra el usuario");
}

$password = $result['password'];

$errorOldPass = $errorNewPass = $errorRenewPass = $errorSamePass = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["old_pass"])) {
        $error = true;
        $errorOldPass = "Vous devez renseigner votre mot de passe actuel";
    } else {
        $hashed_password = password_verify($_POST["old_pass"], $password);
        if (!$hashed_password) {
            $error = true;
            $errorOldPass = "Mot de passe incorrect";
        }
    }
    if (empty($_POST["new_pass"])) {
        $error = true;
        $errorNewPass = "Vous devez renseigner votre nouveau mot de passe";
    }
    if (empty($_POST["renew_pass"])) {
        $error = true;
        $errorRenewPass = "Vous devez renseigner votre nouveau mot de passe";
    }
    if ($_POST["new_pass"] !== $_POST["renew_pass"]) {
        $error = true;
        $errorSamePass = "Votre mot de passe n'est pas identique";
    }

    if (!$error) {
        $hash = password_hash($_POST["new_pass"], PASSWORD_BCRYPT, ['cost' => 10]);
        $stmt = $conn->prepare("UPDATE user SET password = :new_pass WHERE username = :username");
        $data = [
            ':new_pass' => $hash,
            ':username' => $username
        ];
        $stmt->execute($data);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
<div>
    <div><a href="logout.php">Logout</a></div>
    <div><a href="home.php">Home</a></div>
    <h1>Changement de mot de passe</h1>
    <form method="post" name="change_pass" action="profile.php">
        <div>
            <label>
                <div>Ancien mot de passe</div>
                <input type="password" name="old_pass" />
                <div style="color: red"><?= $errorOldPass ?></div>
            </label>
        </div>
        <div>
            <label>
                <div>Nouveau mot de passe</div>
                <input type="password" name="new_pass" />
                <div style="color: red"><?= $errorNewPass ?></div>
            </label>
        </div>
        <div>
            <label>
                <div>Nouveau mot de passe</div>
                <input type="password" name="renew_pass" />
                <div style="color: red"><?= $errorRenewPass ?></div>
                <div style="color: red"><?= $errorSamePass ?></div>
            </label>
        </div>
        <button type="submit">Valider</button>
    </form>
</body>
</html>

