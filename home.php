<?php
session_start();

include "session.php";
require_once "conexion.php";
$idPatient = $_SESSION["idPatient"];
$stmt = $conn->prepare("Select * from resultat INNER JOIN patient ON resultat.id_patient = patient.id_patient WHERE patient.id_patient = :id");

$stmt->bindParam("id", $idPatient); //variable username == "remplazar "s", " parametro
$stmt->execute(); // ejecuta bindParam


$result = $stmt->fetchAll(); //fetch ejecuta request completa y regresa resultado
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
    <h2>Bienvenido <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>

    <table class="table">
        <TR>
            <TH>id</TH>
            <TH>idPatient</TH>
        </TR>
        <?php
        if (!$result) {
            echo "No existe registro de incidentes";
        } else {
            //print_r($result);
            for ($i = 0; $i < count($result); $i++) { //primera fila
                echo "<TR>";
                echo "<TD>" . $result[$i]["id_resultat"] . "</TD>";
                echo "<TD>" . $result[$i]['id_patient'] . "</TD>";
                echo "</tr>";
            }
        }
        ?>
</body>
</html>