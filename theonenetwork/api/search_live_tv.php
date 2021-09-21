<?php
require '../db/config.php';

$onlyPremium = $_GET['onlypremium'];

$search_term = $_GET['search'];

    $json =array();

    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($onlyPremium == 0) {
        $resultat = $bdd->query("SELECT * FROM live_tv_channels WHERE type LIKE 0 ORDER BY id DESC");
    } else if ($onlyPremium == 1) {
        $resultat = $bdd->query("SELECT * FROM live_tv_channels ORDER BY id DESC");
    }
  
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    while( $Data = $resultat->fetch() ) 
    {

        if (stripos($Data->name, $search_term) !== false) {
            $json[] = $Data;
        }
       
    }

    if(json_encode($json) != "[]") {
        echo json_encode($json, JSON_UNESCAPED_SLASHES);
    } else {
        echo "No Data Avaliable";
    }
    
?>