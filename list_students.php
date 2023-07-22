<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="list_students.css">
    <title>List of students</title>
</head>
<body>
    <h2>Students</h2>
    <?php
  try
  {
      $bdd = new PDO('mysql:host=localhost; dbname=GloryDB', 'root', '',
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch (Exception $e )
  {
      die("Il parait qu'il y'a une erreur dans le nom de la base de donnees ou sur le mot de passe :" .$e->getMessage());
  }
  $recupstudents=$bdd->query('SELECT * FROM students');
  while($user=$recupstudents->fetch()){
    ?>
    <?php 
    $_SESSION['studid']=$user['studid'];
    var_dump($_SESSION['studid']);
    ?>
    <p><a href="courses.php? id=<?php echo $user['studid'];?>"><?php  echo $user['nom'].' '.$user['prenom'].'<br/>';?></a></p>
    <?php
  }
  $recupstudents->closeCursor();  
    ?>
</body>
</html>