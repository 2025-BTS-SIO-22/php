<?php

include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST["id"]) ? strip_tags($_POST["id"]) : null;
    
   
}
$stmt = $conn->prepare("DELETE FROM incident WHERE id = :id");

// Asociamos los parámetros a los marcadores de posición en la consulta
$stmt->bindParam(':id', $id, PDO::PARAM_INT);


// Ejecutamos la consulta
if ($stmt->execute()) {
    header('Location: /PpePhp/home.php');
    exit(); // Terminamos la ejecución del script después de redirigir
} else {
    echo "Error al actualizar datos";
}