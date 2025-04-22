<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "conexion.php";
    $stmt = $conn->prepare("SELECT id_patient, password FROM user WHERE username = :s");
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $stmt->bindParam("s", $username); //variable username == "remplazar "s", " parametro
    $stmt->execute(); // ejecuta bindParam
    $result = $stmt->fetch(); //fetch ejecuta request completa y regresa resultado

    if ($result) {
        $password = $result['password'];
        $idPatient = $result['id_patient'];

        if (!empty($_POST["password"])) {
            // Hasheamos la contraseña proporcionada por el usuario usando bcrypt
            $hashed_password = password_verify($_POST["password"], $password);
            if ($hashed_password && $idPatient != null) {
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = true;
                $_SESSION["idPatient"] = $idPatient;
                $_SESSION["username"] = $username;
                header("location:home.php");
            }
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}
