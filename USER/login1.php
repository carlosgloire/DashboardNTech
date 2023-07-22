
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
        <input class='user' type="text" name='username' placeholder="Nom d'utulisateur ou Email">
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
       
    </form>
    <p ><a class='pass' href="">Mot de passe oublié?</a></p>
    
</section>
   
</body>
</html>