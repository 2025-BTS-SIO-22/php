<?php
session_start();

include "session.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

</head>
<?php
include "header.php";
require_once "conexion.php";
$stmt = $conn->prepare("Select * from incident ORDER BY Id_employe");


if (!$stmt->execute()) {
    echo "Error conexion base de datos ";
}

$result = $stmt->fetch(); //fetch ejecuta request completa y regresa resultado
/* editar incidente
 *modificar incidente 
 *buscar incidente
 */

?>

<body>
    <div>
        <h2>Bienvenido <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>

        <table border class = "table" >

        <TR>
    <TH>Id </TH>
    <TH>Username</TH>
    <TH>Incident</TH>
    <TH>Date</TH>
    <TH>Description</TH>
    <TH>Status</TH>
    <TH ><a href='incidents.php'> <button class="button_incidents" type='btn btm succes'> New </button></a> </TH>




</TR>


<?php
if (!$stmt->execute()) {
    echo "Error conexion base de datos ";
}
$result = $stmt->fetchAll();
if (!$result) {
    echo "No existe registro de incidentes";
} else {
    //print_r($result);
    for ($i = 0; $i < count($result); $i++) { //primera fila  
      
        echo "<TR>";
        echo "<TD>" . $result[$i]["id"] . "</TD>";
        echo "<TD>" .  $result[$i]['id_employe'] .  "</TD>";
        echo "<TD>" . $result[$i]['type'] . "</TD>";
        echo "<TD>" .  $result[$i]['date'] . "</TD>";
        echo "<TD>" . $result[$i]['status'] . "</TD>";
        echo "<TD>" .  $result[$i]['description'] . "</TD>";
        echo "<td>
        <form action='updateformulare.php' method='post'>
        <input type='hidden' name='id' value='" . $result[$i]['id']."'>
        <button type='submit' name='update_button'>Update</button>
    </form>
    <form action='delete.php' method='post'>
        <input type='hidden' name='id' value='" . $result[$i]['id'] . "'>
        <button type='submit' name='delete_button'>Delete</button>
    </form>
    </td>";
    echo "</tr>";
   

    }
}
?>






    

    
</body>



</html>