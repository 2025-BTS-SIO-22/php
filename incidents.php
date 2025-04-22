<?php
session_start();
include "session.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleIncidents.css">
    <title>AlexInc</title>
</head>
<?php include "header.php";
?>
<body>
  
  <div class="containerformulaire">
    <div class= "formulaire">
      <h1>Incident</h1>
<form action="incidentsenvio.php" method="post">
  <ul>
    <ul>
    <ul>
      <label for="employe">Employé:</label>
      <input type="text" id="employe" name="employe" />
  </ul>
      <label for="type">Type Incident:</label>
      <input type="text" id="type" name="type" />
  </ul>
    <ul>
      <label for="date">Date Incident:</label>
      <input type="date" id="date" name="date" />
</ul>

<ul>
      <label for="status">Status:</label>
      <input type="status" id="status" name="status" />
</ul>
    <ul>
      <label for="submit"></label>
      <input type="submit" id="submit" name="submit" />
</ul>
  </ul>
</form>
</div>
</div>
</body>
<?php include "footer.php";
?>









</html>