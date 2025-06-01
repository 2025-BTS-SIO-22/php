<?php
session_start();

include "session.php";
require_once "conexion.php";
$idPatient = $_SESSION["idPatient"];

$sql = "
    SELECT
        result.id_result,
        result.description,
        CONCAT(patient.lastname_patient, ' ', patient.name_patient) AS name,
        GROUP_CONCAT(DISTINCT CONCAT(doctor.lastname_doctor, ' ', doctor.name_doctor) SEPARATOR ', ') AS doctors
    FROM result
    INNER JOIN patient ON result.id_patient = patient.id_patient
    LEFT JOIN result_doctor ON result.id_result = result_doctor.id_result
    LEFT JOIN doctor ON result_doctor.id_doctor = doctor.id_doctor
    WHERE patient.id_patient = $idPatient
    GROUP BY result.id_result
";

$stmt = $conn->prepare($sql);

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
    <div><a href="logout.php">Logout</a></div>
    <div><a href="profile.php">Profil</a></div>
    <h2>Bienvenido <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>

    <table class="table">
        <TR>
            <TH>id</TH>
            <TH>description</TH>
            <TH>Name</TH>
            <TH>Médecins</TH>
        </TR>
        <?php
        if (!$result) {
            echo "No existe registro de incidentes";
        } else {
            for ($i = 0; $i < count($result); $i++) { //primera fila
                echo "<TR>";
                echo "<TD>" . $result[$i]["id_result"] . "</TD>";
                echo "<TD>" . $result[$i]['description'] . "</TD>";
                echo "<TD>" . $result[$i]['name'] . "</TD>";
                echo "<TD>" . $result[$i]['doctors'] . "</TD>";
                echo "</tr>";
            }
        }
        ?>
</body>
</html>