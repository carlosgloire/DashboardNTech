<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="courses.css">
    <title>List of courses</title>
</head>
<body>
    <h2>COURSES</h2>
    <p>Select a course in which you desire to add marks</p>
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
  $recupstudents=$bdd->query('SELECT course_id,code,course_name FROM courses');
  while($user=$recupstudents->fetch()){
    ?>
    <p><a href="management.php? id=<?php echo $user['course_id'];?>"><?php  echo $user['course_id'].' '.$user['code'].' '.$user['course_name'].'<br/>';?></a></p>
    <?php
  }
  $recupstudents->closeCursor();  
    ?>
</body>
</html>