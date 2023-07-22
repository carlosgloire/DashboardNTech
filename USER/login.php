<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="connexion.css">
    <title>Connexion</title>
</head>
<body>
<section class='forms'>
    <div class="content">
        <form action="" method ="POST">
            <h2>Connexion</h2>
            <input class='user' type="text" name='username' placeholder="Saisissez votre  Email ou Nom">
            <br><br>
            <input type="password" name='pass' placeholder='Mot de passe'>
            <br><br>
            <div class='remember'>
                <label for="remember">Se souvenir de moi</label>
           <input class="check" type="checkbox" name='remember' id='remember'title='Select this will allow you to be connected automatically'>
           </div>
            <div class="button">
                <input class="sub" type="submit" name='send' value='Connexion'> <p class="register"><a href="inscription_page.php">S'enregister</a></p>
            </div>
            <p class='passforgotten'><a class='passforgotten' href="">Mot de passe oublié?</a></p>
        </form>
       
    </div>
</section>
<?php
// Connexion à la base de données

require_once('DB.php');
require_once('functions.php');

if(isset($_POST['send'])){

$username=htmlspecialchars($_POST['username']);
$password=htmlspecialchars(sha1($_POST['pass'])); 
// cryptage du mot de passe


if( empty($_POST['username']) && empty($_POST['pass']))
//si l'utilisateur clique sur le bouton d'envoie verifie si tous les champs ne sont pas vide
{
    
    ?>
   <div class="alert alert-danger" style="width:300px">
     <p>Complete all fields !!</p>
   </div>
    <?php
    /*
    echo '<script>alert("Complete all fields");</script>';
    echo '<script>window.location.href="login.php";</script>';
    exit;
   */
    }
   

    
    else{
        $requete = $bdd->prepare("SELECT studid FROM students WHERE (mail = :mail OR nom= :nom OR prenom= :prenom ) AND mdp = :mdp ");
      //Connecter l'utilisateur avec son nom ou son email
        $requete->bindValue(':mail', $username);
        $requete->bindValue(':nom', $username );
        $requete->bindValue(':prenom', $username);
        $requete->bindValue(':mdp', $password);
        
        $requete->execute();
        if ($user = $requete->fetch(PDO::FETCH_ASSOC)) {
      
        $_SESSION['nom']=$username;
        header("location:user.php");
    }
    else{
        ?>
        <div style="background-color:white;display:bloc;margin:0px auto;width: 350px; border-radius:5px;box-shadow:0px 0px 5px 0px">
            <p style="color:red;text-align:center">Username or password incorrect !!!</p>
        </div>
        <?php
        /*
        echo '<script>alert("Username or password incorrect");</script>';
        echo '<script>window.location.href="login.php";</script>';
        exit;
        */
    }
    }
}
?>
</body>
</html>