<?php
require '../../db/config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $resultat = $bdd->query("SELECT onesignal_api_key, onesignal_appid FROM config WHERE id = 1");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $json =array();
    while( $Data = $resultat->fetch() ) 
    {
        $json = $Data;

        echo json_encode($json, JSON_UNESCAPED_SLASHES);
    }
            
    
} else  {
    header("HTTP/1.1 401 Unauthorized");
}

?>