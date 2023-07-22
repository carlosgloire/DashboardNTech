<?php
session_start();
require_once('DB.php');
require_once('functions.php');
if(isset($_GET['studid']))
{
    $getid = $_GET['studid'];
$req = $bdd->prepare('SELECT *FROM students WHERE studid = ?');
$req->execute(array($getid));
// Recuperer l'identifiant de l'utilisateur
$user=$req->fetch();
if($user && $token==$user->confirmation_token){
    $req = $bdd->prepare('UPDATE students SET confirmation_token=NULL,confirmed_at=NOW  WHERE studid = ?');
    $req->execute(array($getid));  
    $_SESSION['auth']=$user;
    var_dump($token);
    echo '<script>alert("Account is valid");</script>';
    echo '<script>window.location.href="user.php";</script>';
exit;
}
else{
    echo '<script>alert("Account does not exist");</script>';
    echo '<script>window.location.href="inscription_page.php";</script>';
}
}
