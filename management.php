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
    <link rel="stylesheet" href="management.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>management</title>
</head>
<body>
    
    
    <form action='management.php' method='POST'>
        <div>
            <h1>Points Management</h1>
<input type="number" name='cat1' step=".01" placeholder='CAT1 Marks/30'>
<br><br>
<input type="number" name='cat2' step=".01" placeholder='CAT2 Marks/30'>
<br><br>
<input type="number" name='exam' step=".01" placeholder='EXAM Marks/40'>
<br><br>
<input class='bouton' type="submit" name='envoie' value='Add'>
<br><br>
</div>
</form>
   

</body>
</html>
<?php

    $bdd= new PDO('mysql:host=localhost; dbname=GloryDB', 'root', '');

if(isset($_POST['envoie'])){

  
    $cati1=htmlspecialchars($_POST['cat1']);
    $cati2=htmlspecialchars($_POST['cat2']);
    $examu=htmlspecialchars($_POST['exam']);
 
    if(empty($_POST['cat1']) && empty($_POST['cat2']) && empty($_POST['exam']) )
    {
        echo '<script>alert("Make sure you comlete well all fields");</script>';
        echo '<script>window.location.href="management.php";</script>';
        exit;
          
    }
 
      if($cati1 >30)
      {
        echo '<script>alert("Cat1 marks should less or equal to 30 ");</script>';
        echo '<script>window.location.href="management.php";</script>';
      }
      elseif($cati2 >30)
      {
        echo '<script>alert("Cat2 marks should less or equal to 30 ");</script>';
        echo '<script>window.location.href="management.php";</script>';
      }
      elseif($examu >40)
      {
        echo '<script>alert("Exam marks should less or equal to 40 ");</script>';
        echo '<script>window.location.href="management.php";</script>';
      }
      else{
        
        $totale = $cati1 + $cati2 + $examu;
      
              $donnees = $bdd->prepare('INSERT INTO marksheet (cat1,cat2,exam,total,studid,course_id) VALUE(:cat1,:cat2,:exam,:total,:studid,:course_id)');
        $donnees->execute(array( 'cat1'=> $cati1 ,'cat2'=> $cati2, 'exam'=> $examu ,'total'=> $totale,'studid'=> $_SESSION['studid'],'course_id'=> $_GET['course_id']));
      
      echo '<script>alert("Marks added successfully");</script>';
      echo '<script>window.location.href="management.php";</script>';
      exit;
        
     

   
    

      }
       

}
?>