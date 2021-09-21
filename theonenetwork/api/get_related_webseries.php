<?php
require '../db/config.php';

$id = $_GET['id'];
$genres = $_GET['genres'];
$limit = $_GET['limit'];

$json =array();

$genres_single = explode(',', $genres);


$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$resultat = $bdd->query("SELECT * FROM web_series ORDER BY id DESC");
$resultat->setFetchMode(PDO::FETCH_OBJ);
while( $Data = $resultat->fetch() ) 
{
    if($Data->id != $id) {
        if(count($json) < $limit) {
            foreach ($genres_single as $value) {
                $genre = trim($value);
        
               if (stripos($Data->genres, $genre) !== false) {
                    if(json_encode($json) != "[]") {
                        $stat = false;
                        foreach ($json as $item) {
                            if ($item->id == $Data->id) {
                                $stat = true;
                            }
                        }
                        if($stat == false) {
                            $json[] = $Data;
                        }
                    } else {
                      $json[] = $Data; 
                    }
                         
                }
            }
        }
    }
 }


    if(json_encode($json) != "[]") {
        echo json_encode($json, JSON_UNESCAPED_SLASHES);
    } else {
        echo "No Data Avaliable";
    }

?>