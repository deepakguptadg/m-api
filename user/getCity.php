<?php
include('../helper.php');

if (isset($_POST['id'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $res = getDataById('cities', 'state_id', $id);
    if ($row_count = mysqli_num_rows($res) > 0) {
        $data = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
            http_response_code(200);
            $response = array('status' => true, 'data' => $data);
        }
    } else {
        http_response_code(404);
        $response = array('stetus' => false, 'data' => 'No Data Found...');
    }
}else{
    http_response_code(400);
    $response = array('stetus' => false, 'data' => 'Fill All Fields..');
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
