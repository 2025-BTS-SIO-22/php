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
  
 
    <div class= "formulaire">
      <h1>Update Incident</h1>
      <form action="update.php" method="post">
      <input type='hidden' name='id' value= "<?php echo $_POST["id"] ?>">
    <div class="containerformulaire">
        <div class="formulaire">
            <h1>Update Incident</h1>
            <ul>
                
                <li>
                    <label for="employe">Employé:</label>
                    <input type="text" id="employe" name="employe" />
                </li>
                <li>
                    <label for="type">Type :</label>
                    <input type="text" id="type" name="type" />
                </li>
                <li>
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" />
                </li>
                <li>
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" />
                </li>
                <li>
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" />
                </li>
                <li>
                    <input type="submit" id="submit" name="submit" value="Update" />
                </li>
            </ul>
        </div>
    
</form>


</body>
<?php include "footer.php";
?>