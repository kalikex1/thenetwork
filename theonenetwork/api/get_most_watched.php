<?php
require '../db/config.php';
$limit = $_GET['limit'];
$filter = $_GET['filter'];
$json =array();

$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($filter == "Movies") {
    
    $resultat = $bdd->query("SELECT *, count(content_id ) as max FROM view_log WHERE content_type LIKE 1 GROUP BY content_id ORDER BY max DESC LIMIT $limit");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    while( $Data = $resultat->fetch() ) {

        $resultat2 = $bdd->query("SELECT * FROM movies Where id LIKE $Data->content_id");
        $resultat2->setFetchMode(PDO::FETCH_OBJ);
        while( $Data2 = $resultat2->fetch() ) 
        {
            $json[] = $Data2;
        }
    }

}

if($filter == "WebSeries") {
    $resultat = $bdd->query("SELECT *, count(content_id ) as max FROM view_log WHERE content_type LIKE 2 GROUP BY content_id ORDER BY max DESC LIMIT $limit");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    while( $Data = $resultat->fetch() ) {
        $resultat2 = $bdd->query("SELECT * FROM web_series Where id LIKE $Data->content_id");
        $resultat2->setFetchMode(PDO::FETCH_OBJ);
        while( $Data2 = $resultat2->fetch() ) 
        {
            $json[] = $Data2;
        }
    }

}

if(json_encode($json) != "[]") {
    echo json_encode($json, JSON_UNESCAPED_SLASHES);
} else {
    echo "No Data Avaliable";
}