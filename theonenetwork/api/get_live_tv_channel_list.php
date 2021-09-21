<?php

require '../db/config.php';

$json =array();
$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET['filter'])) {
        $filter = $_GET['filter'];
        if($filter == "featured") {
            $resultat = $bdd->query("SELECT * FROM live_tv_channels WHERE featured LIKE 1 ORDER BY id DESC");
            $resultat->setFetchMode(PDO::FETCH_OBJ);
            while( $Data = $resultat->fetch() ) 
            {
              $json[] = $Data;
            }
        }

    } else {
        $resultat = $bdd->query("SELECT * FROM live_tv_channels ORDER BY id DESC");
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while( $Data = $resultat->fetch() ) 
        {
           
           $json[] = $Data;
           
        }
    }

    if(json_encode($json) != "[]") {
        echo json_encode($json, JSON_UNESCAPED_SLASHES);
    } else {
        echo "No Data Avaliable";
    }
    
?>