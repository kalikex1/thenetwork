<?php
require '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apikey = $_SERVER['HTTP_X_API_KEY'];

    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $resultat = $bdd->query("SELECT * FROM config");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    if( $Data = $resultat->fetch() ) 
    {
        if($apikey == $Data->api_key) {
			echo 'Valid response';
        } else {
            echo "false";
        }
    } else {
        echo "false";
    }

} else {
    echo "false";
}