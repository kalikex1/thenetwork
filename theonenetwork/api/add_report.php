<?php
require '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            function SQLSafe(string $s): string {
                return addslashes($s);
            }

            $user_id = SQLSafe($_POST["user_id"]);
            $title = SQLSafe($_POST["title"]);
            $description = SQLSafe($_POST["description"]);
            $report_type = SQLSafe($_POST["report_type"]);


            $sql = "INSERT INTO report (user_id, title, description, report_type, status)
                VALUES ('$user_id', '$title', '$description', '$report_type', '0')";
            $conn->exec($sql);
            echo $conn->lastInsertId();
            
    
} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>