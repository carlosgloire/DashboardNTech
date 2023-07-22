<?php
session_start();
if(!$_SESSION['mdp']){
    header('Location:admin(mis).php');
}
?>

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
            $recupart = $bdd->prepare('SELECT *FROM management WHERE id = ?');
            $recupart->execute(array($getid));
            if($recupart->rowCount() > 0){
                $deletart = $bdd->prepare('DELETE FROM management WHERE id = ? ');
                $deletart->execute(array($getid));
                echo '<script>alert("Course deleted successfully");</script>';
        echo '<script>window.location.href="affichercours.php";</script>';
        exit;
           
         }
         else{
            echo '<script>alert("Aucun cours trouvé");</script>';
            echo '<script>window.location.href="affichercours.php";</script>';
            exit;
         }
        
        }else{
            echo '<script>alert("Aucun id trouve");</script>';
            echo '<script>window.location.href="affichercours.php";</script>';
            exit;
         }
        
        ?>
        