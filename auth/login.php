<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../config.php");

if (!empty($_POST)) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password  = $conn->real_escape_string($_POST['password']);

        $sql = "SELECT * FROM users WHERE `email` = '$email' AND `password`='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1){
            $data = mysqli_fetch_assoc($result);
            $response = array('status' => 'true', 'data' => $data, 'msg' => 'Login Successfully !!');
        } else{
            $response = array('status' => 'false', 'msg' => 'Invalid Credential !!');
        }
    }else{
        $response = array('status' => 'false', 'msg' => 'All Fields are Required !!');
    }
    echo json_encode($response, JSON_PRETTY_PRINT);
}
$conn->close();