<?php
require '../db/config.php';

$TYPE = $_GET['TYPE'];

    $USER_ID = $_GET['USER_ID'];
    $CONTENT_TYPE = $_GET['CONTENT_TYPE'];
    $CONTENT_ID = $_GET['CONTENT_ID'];


if($TYPE == "SET") {
    
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO favourite (user_id, content_type, content_id)
                              VALUES ('$USER_ID', '$CONTENT_TYPE', '$CONTENT_ID')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New favourite created successfully";
  
  
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
} else if($TYPE == "SEARCH") {
    
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
     $resultat = $bdd->query("SELECT * FROM favourite WHERE user_id = '$USER_ID' AND content_type LIKE '$CONTENT_TYPE' AND content_id LIKE '$CONTENT_ID'");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    while( $Data = $resultat->fetch() ) 
    {
        if(!empty($Data)) {
            echo "Record Found";
        }
    }
    
} else if($TYPE == "REMOVE") {
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DELETE FROM favourite WHERE user_id = '$USER_ID' AND content_type LIKE '$CONTENT_TYPE' AND content_id LIKE '$CONTENT_ID'";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Favourite successfully Removed";
    
}

?>