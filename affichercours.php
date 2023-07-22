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
    <link rel="stylesheet" href="affichercours.css">
    <title>Display Courses</title>
</head>
<body>
    <h1>COURSES MANAGEMENT</h1>
<?php try
        {
            $bdd = new PDO('mysql:host=localhost; dbname=GloryDB', 'root', '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e )
        {
            die("Il parait qu'il y'a une erreur dans le nom de la base de donnees ou sur le mot de passe :" .$e->getMessage());
        }
        
        $req=$bdd->query('SELECT *FROM marksheet');
        while($donness=$req->fetch()){
            ?>
             
             <div> 
                <?php echo $donness['code'].' '.$donness['module'].'<br/><br/>'; ?>
                <p ><a  href="modify.php?id=<?php echo $donness['id'];?>">Modify</a></p>| <p><a href="deletecourse.php?id=<?php echo $donness['id'];?>">Delete</a></p>
            </div>
            <?php
        }
        $req->closeCursor(); 
        ?>
</body>
</html>