<?php

include('../helper.php');
if (
    isset($_POST['role']) && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['company_name']) && isset($_POST['mobile']) && isset($_POST['state']) && isset($_POST['city']) && isset($_POST['gst_number']) && isset($_POST['created_by'])
) {
    // date_default_timezone_set('Asia/Kolkata');
    $insData = array(
        'role' => mysqli_real_escape_string($conn, $_POST['role']),
        'name' => mysqli_real_escape_string($conn, $_POST['name']),
        'username' => mysqli_real_escape_string($conn, $_POST['username']),
        'email' => mysqli_real_escape_string($conn, $_POST['email']),
        'password' => mysqli_real_escape_string($conn, $_POST['password']),
        'company_name' => mysqli_real_escape_string($conn, $_POST['company_name']),
        'mobile' => mysqli_real_escape_string($conn, $_POST['mobile']),
        'state' => mysqli_real_escape_string($conn, $_POST['state']),
        'city' => mysqli_real_escape_string($conn, $_POST['city']),
        'gst_number' => mysqli_real_escape_string($conn, $_POST['gst_number']),
        'created_by' => mysqli_real_escape_string($conn, $_POST['created_by']),
        'assigned_by' => mysqli_real_escape_string($conn, $_POST['assigned_by']),
    );

    $columns = implode(",", array_keys($insData));
    $values  = "'" .implode("','", array_values($insData)). "'";
    $res = addData('users', $columns, $values);
    if ($res) {
        $id = mysqli_insert_id($conn);
        $result = getDataById('users', 'id', $id);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        http_response_code(201);
        $response = array('status' => true, 'message' => 'Data Inserted Succesfully !!', 'data' => $row);
    } else {
        http_response_code(400);
        $response = array('status' => false, 'data' => 'Data Not Inserted !!');
    }
} else {
    http_response_code(400);
    $response = array('status' => false, 'data' => 'All Fields is required !!');
}
$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;

