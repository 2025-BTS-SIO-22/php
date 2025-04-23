<?php
session_start();

include "session.php";
require_once "conexion.php";
$idPatient = $_SESSION["idPatient"];

$sql = "
    SELECT
        resultat.id_resultat,
        GROUP_CONCAT(DISTINCT CONCAT(doctor.lastname_doctor, ' ', doctor.name_doctor) SEPARATOR ', ') AS doctors
    FROM resultat
    INNER JOIN patient ON resultat.id_patient = patient.id_patient
    LEFT JOIN resultat_doctor ON resultat.id_resultat = resultat_doctor.id_resultat
    LEFT JOIN doctor ON resultat_doctor.id_doctor = doctor.id_doctor
    WHERE patient.id_patient = 2
    GROUP BY resultat.id_resultat
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
            <TH>idPatient</TH>
            <TH>Médecins</TH>
        </TR>
        <?php
        if (!$result) {
            echo "No existe registro de incidentes";
        } else {
            for ($i = 0; $i < count($result); $i++) { //primera fila
                echo "<TR>";
                echo "<TD>" . $result[$i]["id_resultat"] . "</TD>";
                echo "<TD>" . $result[$i]['id_patient'] . "</TD>";
                echo "<TD>" . $result[$i]['doctors'] . "</TD>";
                echo "</tr>";
            }
        }
        ?>
</body>
</html>