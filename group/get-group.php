<?php
include('../helper.php');
if (!empty($_POST)) {

    if (isset($_POST['id']) && $_POST['id'] !== '') {
        $id = $conn->real_escape_string($_POST['id']);

        $result = getDataById('users', 'created_by', $id);
        if ($row_count = mysqli_num_rows($result) > 0) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
                http_response_code(201);
                $response = array('status' => true, 'data' => $data);
            }
        } else {
            http_response_code(404);
            $response = array('status' => false, 'message' => 'No Data Found...');
        }
    } else {
        http_response_code(403);
        $response = array('status' => false, 'message' => 'All Field is required !!...');
    }
} else {
    http_response_code(403);
    $response = array('status' => false, 'message' => 'All Field is required !!...');
}

$json = json_encode($response, JSON_PRETTY_PRINT);

echo $json;
