<?php
include('../helper.php');
$res = getAllData('states');
if ($row_count = mysqli_num_rows($res) > 0) {
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
        $response = array('status' => true, 'data' => $data);
    }
} else {
    $response = array('stetus' => false, 'data' => 'No Data Found...');
}
$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;

