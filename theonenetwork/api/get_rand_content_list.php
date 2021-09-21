<?php
$ContentType = $_GET['content_type'];
require '../db/config.php';

$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($ContentType == "Movies") {
    Load_Movies($bdd);
} else if ($ContentType == "WebSeries") {
    Load_Series($bdd);
} else {
    echo "No Data Avaliable";
}



function Load_Movies($bdd) {
    $json =array();
    $Max_Data = $bdd->query("SELECT * FROM config WHERE id LIKE 1");
    $Max_Data->setFetchMode(PDO::FETCH_OBJ);
    while( $Data_max_show = $Max_Data->fetch() ) 
    {
        $Max_Movies = $Data_max_show->Home_Rand_Max_Movie_Show;
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $resultat = $bdd->query("SELECT * FROM movies ORDER BY RAND() LIMIT $Max_Movies");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    while( $Data = $resultat->fetch() ) 
    {
       
       $json[] = $Data;
       
    }

    if(json_encode($json) != "[]") {
        echo json_encode($json, JSON_UNESCAPED_SLASHES);
    } else {
        echo "No Data Avaliable";
    }
    }
}


function Load_Series($bdd) {
    $json =array();

    $Max_Data = $bdd->query("SELECT * FROM config WHERE id LIKE 1");
    $Max_Data->setFetchMode(PDO::FETCH_OBJ);
    while( $Data_max_show = $Max_Data->fetch() ) 
    {
        $max_series = $Data_max_show->Home_Rand_Max_Series_Show;

        $resultat = $bdd->query("SELECT * FROM web_series ORDER BY RAND() LIMIT $max_series");

    $resultat->setFetchMode(PDO::FETCH_OBJ);

    while( $Data = $resultat->fetch() ) 
    {
       $json[] = $Data;
    }

    if(json_encode($json) != "[]") {

        echo json_encode($json, JSON_UNESCAPED_SLASHES);

    } else {

        echo "No Data Avaliable";

    }
    }
}
?>