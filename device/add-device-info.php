<?php

include('../helper.php');
// $data = json_decode(file_get_contents('php://input'));
if (
    isset($_POST['username']) && isset($_POST['email']) && isset($_POST['token']) && isset($_POST['device_info']) && isset($_POST['unique_key']) && isset($_POST['phone'])
) {

    $key = mysqli_real_escape_string($conn, $_POST['unique_key']);
    $sql = "SELECT * ,(Case When assign IS NOT NULL then 'assign' else 'not_assign' end) as assign FROM tbl_keys Where token = '$key'";
    $res_check_key = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res_check_key);

    if (mysqli_num_rows($res_check_key) > 0) {
        if ($row['assign'] == 'assign' && $row['status'] == 1) {
            http_response_code(200);
            $response = array('status' => false, 'message' => 'Key is already in Used !!');
        } else if ($row['assign'] == 'assign' && $row['status'] == 0) {
            $insData = array(
                'username' => mysqli_real_escape_string($conn, $_POST['username']),
                'email' => mysqli_real_escape_string($conn, $_POST['email']),
                'phone' => mysqli_real_escape_string($conn, $_POST['phone']),
                'token' => mysqli_real_escape_string($conn, $_POST['token']),
                'device_info' => mysqli_real_escape_string($conn, $_POST['device_info']),
                'unique_key' => $row['id'],
            );

            $columns = implode(",", array_keys($insData));
            $values  = "'" . implode("','", array_values($insData)) . "'";
            $res = addData('tbl_device_info', $columns, $values);

            if ($res) {
                $id = mysqli_insert_id($conn);
                $result = getDataById('tbl_device_info', 'id', $id);
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

                $sql = "UPDATE `tbl_keys` SET `status`= 1, `updated_at` = '$date' WHERE id = '$id'";
                $update_res = mysqli_query($conn, $sql);
                if ($update_res) {
                    http_response_code(201);
                    $response = array('status' => true, 'message' => 'Device Added Succesfully !!', 'data' => $row);
                }
            } else {
                http_response_code(400);
                $response = array('status' => false, 'data' => 'Device Not Added !!');
            }
        } else {
            http_response_code(201);
            $response = array('status' => false, 'message' => 'Invalid Key !!');
        }
    } else {
        http_response_code(404);
        $response = array('status' => false, 'message' => 'Invalid Key !!');
    }
} else {
    http_response_code(400);
    $response = array('status' => false, 'data' => 'All Fields is required !!');
}

$json = json_encode($response, JSON_PRETTY_PRINT);

echo $json;
