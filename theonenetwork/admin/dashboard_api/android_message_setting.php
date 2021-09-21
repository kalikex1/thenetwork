<?php

require '../../db/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Body_Json =  file_get_contents('php://input');

    $Json_data = $obj = json_decode($Body_Json);



    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // set the PDO error mode to exception

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



            $Show_Message = $Json_data->Show_Message;
            $Message_Title =$Json_data->Message_Title;
            $Message = $Json_data->Message;



            $sql ="UPDATE config SET Show_Message =?, Message_Title =?, Message=? WHERE id = 1";

            $stmt= $conn->prepare($sql);

            $stmt->execute([$Show_Message, $Message_Title, $Message]);



            echo "Android Message Setting Updated successfully";

            

    

} else  {

    header("HTTP/1.1 401 Unauthorized");

}







            ?>