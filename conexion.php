<?php
global $conn;

try {
    
 $conn = new PDO('mysql:host=157.180.75.132;dbname=lune_db;charset=utf8', 'projetbts', 'MotDePasseComplexe123');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

?>
