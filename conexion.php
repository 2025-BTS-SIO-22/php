<?php
global $conn;

try {
    
 $conn = new PDO('mysql:host=localhost;dbname=alexinc;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

?>
