<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once "conexion.php";
  

 
    $stmt = $conn->prepare("SELECT  password FROM user WHERE username = :s");

   
   $username = htmlspecialchars( $_POST["username"], ENT_QUOTES, 'UTF-8');
   
    $stmt->bindParam("s", $username); //variable username == "remplazar "s", " parametro



    $stmt->execute(); // ejecuta bindParam


    $result = $stmt->fetch(); //fetch ejecuta request completa y regresa resultado

    if ($result) {
       
        $password = $result['password'];

        if (!empty($_POST["password"])) {
            // Hasheamos la contraseña proporcionada por el usuario usando bcrypt
            $hashed_password = password_verify($_POST["password"],$password);
            if($hashed_password){
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = true;
                $_SESSION["username"] = $username;
                header("location:home.php");
            }
            //$hashed_password = password_hash($_POST["password"], PASSWORD_BCRYPT,['cost'=>10]);
      
           // $2y$10$59ciyWhnW0Sjm0jWT7CT3eu440fq1AMUh0ZoDgmen0bRiJ3p4NMA2
           //$2y$10$9OXRBJcR5jElBZQS5VBB6.2BYfDoKtf2A2uYG9vrZ0.7nbH04wb9y
           // $2a$10$lN2Wrjj28fKyhrMm6t44zurFC613jP9WoiBWNyOKa6nrk78FEuGve
          
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