<?php

include "conexion.php";







if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST["id"]) ? strip_tags($_POST["id"]) : null;
    $employe = isset($_POST["employe"]) ? strip_tags($_POST["employe"]) : null;
    $type = isset($_POST["type"]) ? strip_tags($_POST["type"]) : null;
    $date = isset($_POST["date"]) ? (new DateTime($_POST["date"]))->format('Y-m-d') : null;
    $status = isset($_POST["status"]) ? strip_tags($_POST["status"]) : null;
    $description = isset($_POST["description"]) ? strip_tags($_POST["description"]) : null;
   
}

/*$stmt = $conn->prepare("SELECT * FROM incident");
if (!$stmt->execute()) {
    echo "Error conexión base de datos";
}

$result = $stmt->fetchAll();
*/
	

// Preparamos la consulta de actualización




exec($stmt = $conn->prepare("UPDATE incident SET id_employe = :employe, type = :type, date = :date, status = :status, description = :description WHERE id = :id "));

// Asociamos los parámetros a los marcadores de posición en la consulta
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':employe', $employe, PDO::PARAM_STR);
$stmt->bindParam(':type', $type, PDO::PARAM_STR);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->bindParam(':status', $status, PDO::PARAM_INT);
$stmt->bindParam(':description', $description, PDO::PARAM_STR);

// Ejecutamos la consulta
if ($stmt->execute()) {
    header('Location: /PpePhp/home.php');
    exit(); // Terminamos la ejecución del script después de redirigir
} else {
    echo "Error al actualizar datos";
}