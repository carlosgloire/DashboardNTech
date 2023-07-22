<?php
session_start();
if(!$_SESSION['mdp']){
    header('Location:admin(mis).php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="acceuil(mis).css">
    <title>Acceuil</title>
</head>
<body>
    <div >
    <h1> <a href="list_students.php">STUDENTS MANAGEMENT</a></h1>
     <h1> <a href="management_system.php">MARKSHEET</a></h1>
     <h1 > <a href="management.php">ADD MARKS</a></h1>
     <h1 > <a href="affichercours.php">COURSES MANAGEMENT</a></h1>
    </div>
</body>
</html>