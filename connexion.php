<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="connexion.css">
    <title>Connexion</title>
</head>
<body>
<section class='forms'>
         <form action="" method ="POST">
        <h2>Connexion</h2>
        <input class='mail' type="mail" name='mail' placeholder='Email'>
        <br><br>
        <input type="password" name='pass' placeholder='Mot de passe'>
        <br><br>
        <input type="submit" name='send' value='Envoyer'>
        <br><br>
       
    </form>
    <p class='pass'><a href="mailto:ndayisabarenzaho@gmail.com">Mot de passe oublié?</a></p><p class='line'>|</p><p class='cmt'><a href="inscription_page.php">Créer Un compte</a></p>
    <br><br>
</section>
   
</body>
</html>
<?php
include('DB.php');


?>