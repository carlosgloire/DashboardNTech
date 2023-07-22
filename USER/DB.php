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