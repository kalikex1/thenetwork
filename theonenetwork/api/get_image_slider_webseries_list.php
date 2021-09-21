<?php

require '../db/config.php';



$json =array();

$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $resultat = $bdd->query("SELECT * FROM config");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    while( $Data = $resultat->fetch() ) 
    {
        $webseries_image_slider_max_visible = $Data->webseries_image_slider_max_visible;

        $resultat2 = $bdd->query("SELECT * FROM web_series ORDER BY id DESC LIMIT  $webseries_image_slider_max_visible");
        $resultat2->setFetchMode(PDO::FETCH_OBJ);
        while( $Data2 = $resultat2->fetch() ) 
        {
         $json[] = $Data2;
        }

        if(json_encode($json) != "[]") {
          echo json_encode($json, JSON_UNESCAPED_SLASHES);
        } else {
          echo "No Data Avaliable";
        }
    }

?>