<?php
include('../helper.php');
$res = getAllData('tbl_device_info');
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
$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;

