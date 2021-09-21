<?php
require '../db/config.php';
$ID = $_GET['ID'];

$json =array();

$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $resultat = $bdd->query("SELECT * FROM subscription WHERE id = $ID");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    if( $Data = $resultat->fetch() ) 
    {
        $json = $Data;
    } else {
        echo "No Data Avaliable";
    }

    if(json_encode($json) != "[]") {

        echo json_encode($json, JSON_UNESCAPED_SLASHES);

    } else {

        echo "No Data Avaliable";

    }

?>