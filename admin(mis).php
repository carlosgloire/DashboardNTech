
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="">
    <title>Page Admin MIS</title>
</head>

<body style='font-family: arial; text-align: center; font-size: medium; color: black; background-color: whitesmoke;'>
    <div class='admin' style='border:1px solid black;width: 50%;   background-color: rgb(82, 150, 150); margin:auto; margin-top:10%; '>
        <h1>Connectez-vous en tant que Admin</h1>
       <form method="post" action=" ">
            <input type="text" name="pseudo" placeholder='Pseudo'  style=' border: 1px black solid;width: 250px;height: 30px;border-radius: 8px;font-size: 1rem; font-family:arial'>
            <br><br>
            <input type="password" name="mdp" placeholder='Mot de passe' style=' border: 1px black solid;width: 250px;height: 30px;border-radius: 8px;font-size: 1rem; font-family:arial'>
            <br><br>
            <input class='valider' type="submit" name="valider" value="valider"  style=' border: 1px black solid;width: 250px;height: 30px;border-radius: 8px;  background-color: rgb(49, 48, 48);color: white;font-size: medium;font-size: medium;   font-weight: bold;font-size: 1rem; font-family:arial'>
            <br><br>
       </form> 
    </div>
</body>

</html>

<br>
<?php
session_start();
if(isset($_POST['valider'])){

    if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])){
        $pseudouser="ndayisabagloire@gmail.com";
        $mdpuser="gloire1234";

        $nom=htmlspecialchars($_POST['pseudo']);
        $code=htmlspecialchars($_POST['mdp']);
        if($nom==$pseudouser AND $code==$mdpuser){
            $_SESSION['mdp']=$code;
           
            header('Location:acceuil(mis).php');
        }
     else{
        echo '<script>alert("Password or Email is incorrect");</script>';
        echo '<script>window.location.href="admin(mis).php";</script>';
        exit;
     }
      
    }
    else{
        echo '<script>alert("Make sure you comlete all fields");</script>';
        echo '<script>window.location.href="admin(mis).php";</script>';
        exit;
    }
}

?>