<?php
require '../../db/config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Body_Json =  file_get_contents('php://input');
    $Json_data = $obj = json_decode($Body_Json);

    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            function SQLSafe(string $s): string {
                return addslashes($s);
            }

            $UserName = SQLSafe($Json_data->add_modal_User_Name);
            $UserEmail = SQLSafe($Json_data->Add_modal_Email);
            $UserPassword = md5($Json_data->Add_modal_Password);


                $stmt = $bdd->prepare("SELECT * FROM user_db WHERE email=?");
                $stmt->execute([$UserEmail]); 
                if($stmt->fetchColumn() == "") {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO user_db (name, email, password, active_subscription, subscription_start, subscription_exp)
                                          VALUES ('$UserName', '$UserEmail', '$UserPassword', 'Free', '0000-00-00', '0000-00-00')";
                    // use exec() because no results are returned
                    $conn->exec($sql);
                    if($conn->lastInsertId() == "") {
                        echo "Something Went Wrong";
                    } else {
                        echo "User Added successfully";
                    }
                
                } else {
                    echo "Email Already Regestered";
                }
            
    
} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>