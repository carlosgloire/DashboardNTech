<?php
 session_start();

?>
<?php
 if(! $_SESSION['nom']){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div >
       <p style='font-size:medium;font-family:arial;'>Welcome dear  <?php echo $_SESSION['nom'];?></p>
    </div>
   
   

    
</body>
</html>