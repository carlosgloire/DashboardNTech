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
    <link rel="stylesheet" href="managementsystem.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet</title>
</head>
<body>
    
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
    
        ?>
       
         <div>
             <table>
             <caption style='font-size: 1.3rem;'>MARKSHEET</caption>
             <tr>
             <th colspan="1">CODE</th><th class="mod">MODULE</th><th>CAT1 </th> <th>CAT2</th> <th>EXAM</th><th>TOTAL</th>
             </tr>
             <tr >
                 <td ></td><td></td><td style=" font-weight: bold;">30</td><td style=" font-weight: bold;">30</td><td style=" font-weight: bold;">40</td><td style=" font-weight: bold;">100</td>
             </tr>
                <?php
                 $recupuser=$bdd->query('SELECT code,module,management.cat1,cat2,exam,total FROM  management ');
            
                 while($user=$recupuser->fetch()){
                    ?>
                   <tr>
                
                 <td style=' text-align: left;font-weight:bold;'><?php  echo $user['code']; ?></td><td style=' text-align: left;font-weight:bold;'> <?php echo $user['module'];?></td><td><?php echo $user['cat1'];?></td><td><?php echo $user['cat2'];?></td><td><?php echo $user['exam'];?></td><td><?php echo $user['total']?></td>
                 </tr>
                 <?php
                  }
                  $recupuser->closeCursor(); 
                 ?>
            
             
             <tr >
                 <td style="background-color: black;"></td><td style="background-color: black;"></td><td style="background-color: black;"></td><td style="background-color: black;"></td><td style="background-color: black;"></td><td><?php 
                 $recupuser=$bdd->query('SELECT total, round(AVG(total),1) as toto FROM management ');
             
            while($user=$recupuser->fetch()){
               
                if( $user['toto']>=90){
                    ?>
                    <p style='color:red;'><?php echo  $user['toto'].'%';?></p>
                    <?php
                }
                elseif( $user['toto']>=80){
                    ?>
                    <p style='color:green;'><?php echo  $user['toto'].'%';?></p>
                    <?php
                }
                elseif( $user['toto']>=70){
                    ?>
                    <p style='color:darkorange;'><?php echo  $user['toto'].'%';?></p>
                    <?php
                }
                elseif( $user['toto']>=60){
                    ?>
                    <p style='color:brown;'><?php echo  $user['toto'].'%';?></p>
                    <?php
                }
                elseif( $user['toto']>=50){
                    ?>
                    <p style='color:darkmagenta;'><?php echo  $user['toto'].'%';?></p>
                    <?php
                }
                elseif( $user['toto']<50){
                    ?>
                    <p style='color:blue;'><?php echo  $user['toto'].'%';?></p>
                    <?php
                }
            
            }
                $recupuser->closeCursor();  
           ?>
        </td>   
       </tr>
         </table>
          <br>
         <div class='marksheet_bar'>
         <?php 
                 $recupuser=$bdd->query('SELECT total, round(AVG(total),1) as toto FROM management ');
        
            while($user=$recupuser->fetch()){
                if( $user['toto']>=90){
                    ?>
                    <div  style='text-align:left; margin-left:25px;'>
                   <p style='font-weight:bold;color:red;'><?php echo 'Percentage :'.' '. $user['toto'].'%';?></p>
                    <p >Grade:  <strong>A</strong></p>
                    <p>Deliberation decision: <strong> PASS</strong></p>  
                    </div>
                  
                    <?php
                }
                elseif( $user['toto']>=80){
                    ?>
                    <div  style='text-align:left; margin-left:25px;' >
                    <p style='font-weight:bold;color:green;'><?php echo 'Percentage :'.' ' .$user['toto'].'%';?></p>
                    <p >Grade: <strong>B</strong></p>
                    <p>Deliberation decision: <strong> PASS</strong></p>  
                    </div>
                    
                    <?php
                }
                elseif( $user['toto']>=70){
                    ?>
                    <div  style='text-align:left; margin-left:25px;'>
                    <p style='color:darkorange;font-weight:bold;margin-left: 15px;'><?php echo 'Percentage :'.' '  .$user['toto'].'%';?></p>
                    <p >Grade:  <strong>C</strong></p>
                    <p>Deliberation decision: <strong> PASS</strong></p>  
                    </div>
                   
                    <?php
                }
                elseif( $user['toto']>=60){
                    ?>
                    <div  style='text-align:left; margin-left:25px;'>
                    <p style='color:brown;font-weight:bold;'><?php echo 'Percentage :'. ' '  .$user['toto'].'%';?></p>
                    <p >Grade:  <strong>D</strong></p>
                    <p>Deliberation decision: <strong> PASS</strong></p>   
                    </div>
                    
                    <?php
                }
                elseif( $user['toto']>=50){
                    ?>
                    <div  style='text-align:left; margin-left:25px;'>
                       <p style='color:darkmagenta;font-weight:bold;'><?php echo 'Percentage :'. ' ' .$user['toto'].'%';?></p>
                    <p >Grade:  <strong>E</strong></p>
                    <p>Deliberation decision: <strong> PASS</strong></p>  
                    </div>
                     
                    <?php
                }
                elseif( $user['toto']<50){

                    ?>
                    <div style='text-align:left; margin-left:25px;'>
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
     </div>
</body>
</html>