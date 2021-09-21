<?php

require '../../db/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Body_Json =  file_get_contents('php://input');

    $Json_data = $obj = json_decode($Body_Json);



    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // set the PDO error mode to exception

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



            $apk_version_name = $Json_data->apk_version_name;
            $apk_version_code =$Json_data->apk_version_code;
            $latest_apk_url = $Json_data->latest_apk_url;
            $apk_whats_new =$Json_data->apk_whats_new;
            $update_skipable_int = $Json_data->update_skipable_int;



            $sql ="UPDATE config SET Latest_APK_Version_Name =?, Latest_APK_Version_Code =?, APK_File_URL=?, Whats_new_on_latest_APK=?, Update_Skipable=?, Update_Type=? WHERE id = 1";

            $stmt= $conn->prepare($sql);

            $stmt->execute([$apk_version_name, $apk_version_code, $latest_apk_url, $apk_whats_new, $update_skipable_int, $Json_data->Update_Type_int]);



            echo "Android Update Data Updated successfully";

            

    

} else  {

    header("HTTP/1.1 401 Unauthorized");

}







            ?>