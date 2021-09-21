<?php
require '../db/config.php';
$userID = $_GET['userID'];
$limit = $_GET['limit'];
$filter = $_GET['filter'];

$json =array();




if($filter == "Movies") {
$MovieGenres =  getMovieGenres($userID, $servername, $dbname, $username, $password);
if($MovieGenres != "") {
$single_MovieGenres = explode(',', $MovieGenres);
//Movie
$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$resultat = $bdd->query("SELECT * FROM movies ORDER BY id DESC");
$resultat->setFetchMode(PDO::FETCH_OBJ);
while( $Data = $resultat->fetch() ) 
{
    $lastMovieID = getLastMovie($userID, $servername, $dbname, $username, $password);
    if($Data->id != $lastMovieID) {
        if(count($json) < $limit) {
            foreach ($single_MovieGenres as $value) {
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
}
}



if($filter == "WebSeries") {
$WebSeriesGenres  =  getWebSeriesGenres($userID, $servername, $dbname, $username, $password);
if($WebSeriesGenres != "") {
$single_WebSeriesGenres = explode(',', $WebSeriesGenres);
 //WebSeries
 $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
 $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $resultat = $bdd->query("SELECT * FROM web_series ORDER BY id DESC");
 $resultat->setFetchMode(PDO::FETCH_OBJ);
 while( $Data = $resultat->fetch() ) 
 {
    $lastWebSeriesID = getLastWebSeries($userID, $servername, $dbname, $username, $password);
     if($Data->id != $lastWebSeriesID) {
         if(count($json) < $limit) {
             foreach ($single_WebSeriesGenres as $value) {
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
}
}



 if(json_encode($json) != "[]") {
    echo json_encode($json, JSON_UNESCAPED_SLASHES);
} else {
    echo "No Data Avaliable";
}







    function getLastMovie($userID, $servername, $dbname, $username, $password) {
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $resultat = $bdd->query("SELECT * FROM watch_log WHERE user_id = '$userID' AND content_type LIKE 1 ORDER BY id DESC");
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while( $Data = $resultat->fetch() ) 
        {
           
           return $Data->content_id;
           
        }
    }

    function getLastWebSeries($userID, $servername, $dbname, $username, $password) {
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $resultat = $bdd->query("SELECT * FROM watch_log WHERE user_id = '$userID' AND content_type LIKE 2 ORDER BY id DESC");
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while( $Data = $resultat->fetch() ) 
        {
           
           return $Data->content_id;
           
        }
    }


    function getMovieGenres($userID, $servername, $dbname, $username, $password) {
        $contentID = getLastMovie($userID, $servername, $dbname, $username, $password);
        if($contentID != "") {
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $resultat = $bdd->query("SELECT * FROM movies WHERE id = $contentID ORDER BY id DESC");
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while( $Data = $resultat->fetch() ) 
        {
           
           return $Data->genres;
           
        }
    }
    }

    function getWebSeriesGenres($userID, $servername, $dbname, $username, $password) {
        $contentID = getLastWebSeries($userID, $servername, $dbname, $username, $password);
        if($contentID != "") {
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $resultat = $bdd->query("SELECT * FROM web_series WHERE id = $contentID ORDER BY id DESC");
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while( $Data = $resultat->fetch() ) 
        {
           
           return $Data->genres;
           
        }
    }
    }

?>