
<?php

    // Connexion à la base de données
    session_start();
    require_once('DB.php');
    require_once('functions.php');

if(isset($_POST['send'])){
        $fname=htmlspecialchars($_POST['nom']);
        $sname=htmlspecialchars($_POST['prenom']);
        $mail=htmlspecialchars($_POST['mail']);
        $mdp=htmlspecialchars(sha1($_POST['pass'])); 
        // cryptage du mot de passe
        $mdp2=htmlspecialchars(sha1($_POST['pass2']));

if(empty($_POST['nom']) && empty($_POST['prenom'])&& empty($_POST['mail']) && empty($_POST['pass'])&& empty($_POST['pass2']))
//si l'utilisateur clique sur le bouton d'envoie verifie si tous les champs ne sont pas vide
{
    echo '<script>alert("Complete all fields");</script>';
    echo '<script>window.location.href="inscription_page.php";</script>';
    exit;
   
    }
if( !preg_match("#^[a-zA-Z0-9_ -]+$#",$_POST['nom']))
{

    echo '<script>alert("Your first name is not correct");</script>';
    echo '<script>window.location.href="inscription_page.php";</script>';
    exit;
}
if( !preg_match("#^[a-zA-Z0-9_-]+$#",$_POST['prenom']))
{
   echo '<script>alert("Your second name is not correct");</script>';
   echo '<script>window.location.href="inscription_page.php";</script>';
   exit;
}

if($_POST['nom'] AND $_POST['prenom'])
{
$query=$bdd->prepare('SELECT * FROM students WHERE nom=? AND prenom=?');// verification si la personne entree existe deja
$query->execute([$_POST['nom'],$_POST['prenom']]);
if($query->fetch())
{
    echo '<script>alert("The names you entered are already taken");</script>';
    echo '<script>window.location.href="inscription_page.php";</script>';
    exit;
}
}

if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$_POST['mail'])){

    echo '<script>alert("Your Email is incorrect");</script>';
    echo '<script>window.location.href="inscription_page.php";</script>';
    exit;
}
if($_POST['mail'] )
{
$query=$bdd->prepare('SELECT * FROM students WHERE mail=? ');
$query->execute([$_POST['mail']]);
if($query->fetch())
{
    echo '<script>alert("Email already taken");</script>';
    echo '<script>window.location.href="inscription_page.php";</script>';
    exit;
}
}

if(!preg_match("#[a-z]+#",$_POST['pass']))//password should contain at least 1 letter
{

    echo '<script>alert("Your password should contain at least 1 letter");</script>';
    echo '<script>window.location.href="inscription_page.php";</script>';
    exit;
}

if(!preg_match("#[0-9]+#",$_POST['pass']))//password should contain at least 1 number
{

    echo '<script>alert("Your password should contain at least 1 number");</script>';
    echo '<script>window.location.href="inscription_page.php";</script>';
    exit;
 }
if(!preg_match("#[-_@%&* ]+#",$_POST['pass']))// password should contain at least 1 number
{

     echo '<script>alert("Your password should contain at least 1 special character (-_@%&* )");</script>';
     echo '<script>window.location.href="inscription_page.php";</script>';
     exit;
}
if(strlen($_POST['pass'])!=8) //password should contain 8 characters
{
            
     echo '<script>alert("Your password should contain 8 characters");</script>';
     echo '<script>window.location.href="inscription_page.php";</script>';
     exit; 
} 
             
if($mdp!=$mdp2)
{
    echo '<script>alert("Passwords don\'t match");</script>';
    echo '<script>window.location.href="inscription_page.php";</script>';
    echo exit;

}

// Insertion des informations dans la base
$donnees= $bdd->prepare('INSERT INTO students (nom,prenom,mail,mdp,confirmation_token) VALUE (:nom,:prenom,:mail,:mdp,:confirmation_token)');
$token = generatetoken(100); //jeton de confirmation. si l'utilisateur n'a pas confirme son inscription ne sera pas connecte
$donnees->execute(array('nom'=> $fname, 'prenom'=> $sname,'mail'=> $mail,'mdp'=> $mdp,'confirmation_token'=>$token));

if(isset($_GET['studid'])){
    $getid = $_GET['studid'];
    $req = $bdd->prepare('SELECT *FROM students WHERE studid = ?');
    $req->execute(array($getid));
   // Recuperer l'identifiant de l'utilisateur
 }

    $email=$_POST['mail'];
    $subject='Confirmation de compte';
    $message='Afin de confirmer votre compte merci de cliquer sur ce lien http://localhost/MIS/USER/confirm.php?id=$getid&token=$token';
    mail($email,$subject,$message);
    echo '<script>alert("Signup successful, check your email box to confirm it");</script>';
 
     exit;
   
}
    ?>

    
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="inscription.css">
        <title>Page d'inscription</title>
    </head>

    <body>
        <section class='forms'>
            <form action="" method ="POST" onsubmit="collect_data(event)">
                <div>
                  <h2>Page d'inscription</h2>
                <input type="text" name='nom' placeholder='Nom*'>
                <br><br>
                <input type="text" name='prenom' placeholder='Prénom*'>
                <br><br>
                <input class='mail' type="mail" name='mail' placeholder='Email*'>
                <br><br>
                <input type="password" name='pass' placeholder='Mot de passe*'>
                <br><br>
                <input type="password" name='pass2' placeholder='Répeter le mot de passe*'>
                <br><br>
                <input type="submit" name='send' value='Envoyer'>
                <br><br>   
                </div>
            </form>
            <div class="link">
                <p style="color:white;margin-left:120px">As-tu deja un compte? <a style="text-decoration:none;color:blue" href="login.php">Connexion</a></p>
            </div>
        </section>
        </body>
</html>


    
