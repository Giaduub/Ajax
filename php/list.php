<?php
    
        include('bdd.php');

       
        $sql = 'SELECT * FROM `message`';

       
        $requete = $db->query($sql);

      
        $messages = $requete->fetchAll();
        $messagesJson = json_encode($messages);

        echo $messagesJson;