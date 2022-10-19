<?php

include('../helper.php');
if (
    isset($_POST['username']) && isset($_POST['email']) && isset($_POST['token']) && isset($_POST['device_info']) && isset($_POST['unique_key']) && isset($_POST['phone'])
) {
    // $applock = mysqli_real_escape_string($conn, $_POST['applock']);
    // $filelock = mysqli_real_escape_string($conn, $_POST['filelock']);
    // $youtubelock = mysqli_real_escape_string($conn, $_POST['youtubelock']);
    // $device_id = mysqli_real_escape_string($conn, $_POST['device_id']);

    $insData = array(
        'applock' => mysqli_real_escape_string($conn, $_POST['applock']),
        'filelock' => mysqli_real_escape_string($conn, $_POST['filelock']),
        'youtubelock' => mysqli_real_escape_string($conn, $_POST['youtubelock']),
        'device_id' => mysqli_real_escape_string($conn, $_POST['device_id']),
    );

    $columns = implode(",", array_keys($insData));
    $values  = "'" .implode("','", array_values($insData)). "'";
    $res = updateData('tbl_lock', $columns, $values, $id);

    if ($res) {
        $id = mysqli_insert_id($conn);
        $result = getDataById('tbl_device_info', 'id', $id);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        http_response_code(201);
        $response = array('status' => true, 'message' => 'Device Added Succesfully !!', 'data' => $row);
    } else {
        http_response_code(400);
        $response = array('status' => false, 'data' => 'Device Not Added !!');
    }
} else {
    http_response_code(400);
    $response = array('status' => false, 'data' => 'All Fields is required !!');
}

$json = json_encode($response, JSON_PRETTY_PRINT);

echo $json;
