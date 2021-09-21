<?php
require '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            function SQLSafe(string $s): string {
                return addslashes($s);
            }

            $user_id = SQLSafe($_POST["user_id"]);
            $content_id = SQLSafe($_POST["content_id"]);
            $content_type = SQLSafe($_POST["content_type"]);


            $sql = "INSERT INTO watch_log (user_id, content_id, content_type)
                VALUES ('$user_id', '$content_id', '$content_type')";
            $conn->exec($sql);
            echo $conn->lastInsertId();
            
    
} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>