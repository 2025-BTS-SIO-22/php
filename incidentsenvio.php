<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employe = strip_tags(htmlentities($_POST["employe"]));
    $type = strip_tags(htmlentities($_POST["type"]));
    $date = (new DateTime(strip_tags(htmlentities($_POST["date"]))))->format('Y-m-d');
    $status = strip_tags(htmlentities($_POST["status"]));


    require_once "conexion.php";


    $stmt = $conn->prepare("INSERT INTO incident (`id_employe`, `type`, `date`, `status`) VALUES (:id_employe, :type, :date, :status)");
    $stmt->bindParam(':id_employe', $employe, PDO::PARAM_STR);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    //variable username == "remplazar "s"

    if ($stmt->execute()) {
        header('location: /PpePhp/home.php');
    }else{
        echo "Error al insertar el incidente: " ;
    }

}
