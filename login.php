<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once "conexion.php";
  

 
    $stmt = $conn->prepare("SELECT  password FROM admin WHERE username = :s");

   $username = $_POST["username"];
   
    $stmt->bindParam("s", $username); //variable username == "remplazar "s", " parametro



    $stmt->execute(); // ejecuta bindParam


    $result = $stmt->fetch(); //fetch ejecuta request completa y regresa resultado

    if ($result) {

        if (!empty($_POST["password"])) {
            // Hasheamos la contraseña proporcionada por el usuario usando bcrypt
            $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = true;
            $_SESSION["username"] = $username;
            header("location:home.php");
            /*  if (($hashed_password == $result['password'])) { //password encriptado y comparando con password de la base de datos
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = true;
            $_SESSION["username"] = $username;
            header("location:home.php");
        } else {
            echo "Usuario o contraseña incorrectos.";
        }*/

            //default version bcrypt 
        } else {

            echo "Usuario o contraseña incorrectos.";
        }

        //elever space
        //reconnaisance balises 
        // chercher fonction hash
        //recuperation de formulaire 
        //droit utilisateur
        //administration interface specifique pour gerer des utilisateur
        //droit corresponde sur le table 

    }
}
//bind parametros 