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
    <title>Modify Marks</title>
</head>
<body>
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


         if(isset($_GET['id']) AND !empty($_GET['id'])){
            $getid = $_GET['id'];
            $recupmarks = $bdd->prepare('SELECT *FROM marksheet WHERE id = ?');
            $recupmarks->execute(array($getid));
            if($recupmarks->rowCount() > 0){
            $infos = $recupmarks->fetch();
            $code = $infos['code'];
            $module = $infos['module'];
            $cat1 = $infos['cat1'];
            $cat2 = $infos['cat2'];
            $exam = $infos['exam'];
   
           
         }
       
         else
         {
            echo '<script>alert("Aucun cours trouvé");</script>';
            echo '<script>window.location.href="affichercours.php";</script>';
            exit;
         }
        
         }
        else{
            echo '<script>alert("Aucun id trouve");</script>';
            echo '<script>window.location.href="affichercours.php";</script>';
            exit;
         }

         if(isset($_POST['envoie'])){
            $codesaisi = htmlspecialchars($_POST['code']);
            $modulesaisi = htmlspecialchars($_POST['module']);
            $cat1saisi = htmlspecialchars($_POST['cat1']);
            $cat2saisi = htmlspecialchars($_POST['cat2']);
            $examsaisi = htmlspecialchars($_POST['exam']);
          
            if(empty($_POST['code'])&& empty($_POST['module'])&&empty($_POST['cat1'])&&empty($_POST['cat2'])&&empty($_POST['exam']))
            {
                echo '<script>alert("Make sure you comlete well all fields");</script>';
                echo '<script>window.location.href="affichercours.php";</script>';
                exit;
                
            }
            if(!preg_match("#^[A-Z]{2,}+[ ]+[0-9]{2,}$#",$_POST['code'])){
    
                echo '<script>alert("Make sure you write well code\'s module");</script>';
                echo '<script>window.location.href="affichercours.php";</script>';
                exit;
            }
            if($cat1saisi >30)
            {
              echo '<script>alert("Cat1 marks should less or equal to 30 ");</script>';
              echo '<script>window.location.href="affichercours.php";</script>';
            }
            elseif($cat2saisi >30)
            {
              echo '<script>alert("Cat2 marks should less or equal to 30 ");</script>';
              echo '<script>window.location.href="affichercours.php";</script>';
            }
            elseif($examsaisi >40)
            {
              echo '<script>alert("Exam marks should less or equal to 40 ");</script>';
              echo '<script>window.location.href="affichercours.php";</script>';
            }   
            else{
                $totale=$cat1saisi+$cat2saisi+$examsaisi;
                  $updtademarks = $bdd->prepare('UPDATE management SET code = ?,  module = ?, cat1 = ? , cat2 = ?, exam = ?, total = ? WHERE id = ?');
            $updtademarks->execute(array($codesaisi, $modulesaisi, $cat1saisi, $cat2saisi, $examsaisi, $totale, $getid));
                
        echo '<script>alert("Marks modified successfully");</script>';
        echo '<script>window.location.href="affichercours.php";</script>';
        exit;
        }
            }
        
        ?>
    
    <form action='' method='POST'>
        <div>
            <h1>Marks Modification</h1>
<input type="text" name='code' placeholder='CODE Of module'value='<?php echo $code ?>'><br><br>
    <input type="text" name='module'  value='<?php echo $module ?>'>
    <br><br>
<input type="number" name='cat1' step=".01"  value='<?php echo $cat1 ?>'>
<br><br>
<input type="number" name='cat2' step=".01" value='<?php echo $cat2 ?>'>
<br><br>
<input type="number" name='exam' step=".01" value='<?php echo $exam ?>'>
<br><br>
<input class='bouton' type="submit" name='envoie' value='Add'>
<br><br>
</div>
</form>
</body>
</html>
        