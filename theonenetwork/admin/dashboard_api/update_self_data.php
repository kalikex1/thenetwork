<?php
require '../../db/config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Body_Json =  file_get_contents('php://input');
    $Json_data = $obj = json_decode($Body_Json);

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function SQLSafe(string $s): string {
        $NewData = stripslashes($s);
        return addslashes($NewData);
    }

    $userID = $Json_data->Edit_modal_User_id;
    $Edit_modal_User_Name = SQLSafe($Json_data->Edit_modal_User_Name);
    $Edit_modal_Email = SQLSafe($Json_data->Edit_modal_Email);
    $Edit_modal_Password = SQLSafe($Json_data->Edit_modal_Password);

    $resultat1 = $conn->query("SELECT * FROM user_db WHERE id = $userID");
    $resultat1->setFetchMode(PDO::FETCH_OBJ);
    while( $UData = $resultat1->fetch() ) 
    {
        $UserData = $UData;
    }

    if($Edit_modal_Password == $UserData->password) {
        $sql2 ="UPDATE user_db SET name =? , email =? WHERE id =?";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$Edit_modal_User_Name, $Edit_modal_Email, $userID]);
        echo "User Updated successfully";
    } else {
        $sql2 ="UPDATE user_db SET name =?, email =?, password=? WHERE id =?";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$Edit_modal_User_Name, $Edit_modal_Email, md5($Edit_modal_Password), $userID]);
        echo "User Updated successfully";
    }
} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>