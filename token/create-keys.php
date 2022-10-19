<?php

include('../helper.php');

if (isset($_POST['noOfToken'])) {
    $noOfToken = mysqli_real_escape_string($conn, $_POST['noOfToken']);
    
    $data = array();
    for ($i = 0; $i < $noOfToken; $i++) {
        $token = openssl_random_pseudo_bytes(5);
        $token = bin2hex($token);
        $data[] = $token;
        $sql = "INSERT INTO tbl_keys(token) VALUES('$token')";
        $res = mysqli_query($conn, $sql);
        if($res){
            http_response_code(201);
            $response = array('status' => true, 'message' => 'Keys created Succesffuly !!', 'token' => $data);
        }else{
            http_response_code(400);
            $response = array('status' => true, 'message' => 'Keys Can Not Created !!');
        }
    }
    
} else {
    http_response_code(400);
    $response = array('status' => false, 'message' => 'All Field is Required !!');
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;

