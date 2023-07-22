<?php
session_start();
if(!$_SESSION['mdp']){
    header('Location:admin(mis).php');
}

try
{
    $bdd = new PDO('mysql:host=localhost; dbname=GloryDB', 'root', '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e )
{
    die("Il parait qu'il y'a une erreur dans le nom de la base de donnees ou sur le mot de passe :" .$e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="marksheet.css">
    <title>Markshet</title>
</head>
<body>
   
    <section class="section-centrale">
        <div class="bloc_milieu">
            <h1>MARKSHEET</h1> 
            
             <div class="tablecontenu">
            <table class="table">
                <thead>
             <td colspan="1">CODE</td>
             <td class="mod">MODULE</td>
             <td>CAT1 </td> 
             <td>CAT2</td> 
             <td>EXAM</td>
             <td>TOTAL</td>
                </thead>
                <tbody>
                    <tr >
                        <td ></td>
                        <td></td>
                        <td style=" font-weight: bold;">30</td>
                        <td style=" font-weight: bold;">30</td>
                        <td style=" font-weight: bold;">40</td>
                        <td style=" font-weight: bold;">100</td>
                    </tr>
                </tr>
                <?php
                 $recupuser=$bdd->query('SELECT code,course_name,cat1,cat2,exam,total FROM  marksheet m,students s,courses c where  s.studid=m.studid AND c.course_id=m.course_id');
            
                 while($user=$recupuser->fetch()){
                    ?>
                   <tr>
                
                 <td style=' text-align: left;font-weight:bold;'><?php  echo $user['code']; ?></td><td style=' text-align: left;font-weight:bold;'> <?php echo $user['course_name'];?></td><td><?php echo $user['cat1'];?></td><td><?php echo $user['cat2'];?></td><td><?php echo $user['exam'];?></td><td><?php echo $user['total']?></td>
                 </tr>
                 <?php
                  }
                  $recupuser->closeCursor(); 
                 ?>
             <tr >
                <td></td><td>TOTAL</td><td></td><td></td><td></td>
                <td style='color:rgb(0, 153, 255); font-weight:bold;'>
                    <?php
                        $recupuser=$bdd->query('SELECT total, round(SUM(total),1) as toto FROM marksheet ');
                        while($user=$recupuser->fetch()){
                           echo $user['toto']; 
                        }
                    ?>
                </td>
                </tbody>
            </table>
            </div> 
        </div> 
       
        <div class='marksheet_bar'>
            <?php 
                    $recupuser=$bdd->query('SELECT total, round(AVG(total),1) as toto FROM marksheet ');
           
               while($user=$recupuser->fetch()){
                   if( $user['toto']>=90){
                       ?>
                       <div  style='text-align:left;'>
                      <p >Percentage: </p ><P style='font-weight:bold;color:red;'> <?php echo 'Percentage :'.' '. $user['toto'].'%';?></p>
                       <p >Grade:</p><p style='font-weight:bold;color:red;'> <strong>A</strong></p>
                       <p>Deliberation decision: </p > <p style='font-weight:bold;color:red;'><strong> PASS</strong></p>  
                       </div>
                     
                       <?php
                   }
                   elseif( $user['toto']>=80){
                       ?>
                       <div  style='text-align:left;' >
                       <p style='font-weight:bold;color:green;'><?php echo 'Percentage :'.' ' .$user['toto'].'%';?></p>
                       <p >Grade: <strong>B</strong></p>
                       <p>Deliberation decision: <strong> PASS</strong></p>  
                       </div>
                       
                       <?php
                   }
                   elseif( $user['toto']>=70){
                       ?>
                       <div  style='text-align:left; margin-left:25px;'>
                       <p style='color:darkorange;font-weight:bold;'><?php echo 'Percentage :'.' '  .$user['toto'].'%';?></p>
                       <p >Grade:  <strong>C</strong></p>
                       <p>Deliberation decision: <strong> PASS</strong></p>  
                       </div>
                      
                       <?php
                   }
                   elseif( $user['toto']>=60){
                       ?>
                       <div  style='text-align:left;'>
                       <p style='color:brown;font-weight:bold;'><?php echo 'Percentage :'. ' '  .$user['toto'].'%';?></p>
                       <p >Grade:  <strong>D</strong></p>
                       <p>Deliberation decision: <strong> PASS</strong></p>   
                       </div>
                       
                       <?php
                   }
                   elseif( $user['toto']>=50){
                       ?>
                       <div  style='text-align:left;'>
                          <p style='color:darkmagenta;font-weight:bold;'><?php echo 'Percentage :'. ' ' .$user['toto'].'%';?></p>
                       <p >Grade:  <strong>E</strong></p>
                       <p>Deliberation decision: <strong> PASS</strong></p>  
                       </div>
                        
                       <?php
                   }
                   elseif( $user['toto']<50){
   
                       ?>
                       <div style='text-align:left;'>
                         <p style='color:blue;font-weight:bold;'><?php echo 'Percentage :'. ' ' .$user['toto'].'%';?></p>
                         <p >Grade:  <strong>F</strong></p>
                       <p>Deliberation decision: <strong> FAIL</strong></p>  
                       </div>
                      
                       <?php
                   }
                 
               }
                   $recupuser->closeCursor();  
              ?>
            </div>
    </section>
</body>
</html>