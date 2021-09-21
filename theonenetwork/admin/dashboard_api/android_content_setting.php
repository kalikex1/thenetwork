<?php

require '../../db/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Body_Json =  file_get_contents('php://input');

    $Json_data = $obj = json_decode($Body_Json);



    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // set the PDO error mode to exception

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



            $shuffle_contents = $Json_data->shuffle_contents;
            $Home_Rand_Max_Movie_Show =$Json_data->Home_Rand_Max_Movie_Show;
            $Home_Rand_Max_Series_Show = $Json_data->Home_Rand_Max_Series_Show;
            $Home_Recent_Max_Movie_Show =$Json_data->Home_Recent_Max_Movie_Show;
            $Home_Recent_Max_Series_Show = $Json_data->Home_Recent_Max_Series_Show;



            $sql ="UPDATE config SET shuffle_contents =?, Home_Rand_Max_Movie_Show =?, Home_Rand_Max_Series_Show=?, Home_Recent_Max_Movie_Show=?, Home_Recent_Max_Series_Show=? WHERE id = 1";

            $stmt= $conn->prepare($sql);

            $stmt->execute([$shuffle_contents, $Home_Rand_Max_Movie_Show, $Home_Rand_Max_Series_Show, $Home_Recent_Max_Movie_Show, $Home_Recent_Max_Series_Show]);



            echo "Android Content Setting Updated successfully";

            

    

} else  {

    header("HTTP/1.1 401 Unauthorized");

}







            ?>