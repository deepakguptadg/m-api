<?php
include('../helper.php');

if (isset($_POST['id']) && isset($_POST['role'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = " ";
    $sql .= "SELECT *,(Case when $role=1 then Case when national_dis is not null then 'Transfer' else 'Not Transfer' end else case when $role=2 then (case when super_dis is not null then 'Transfer' else 'Not Transfer' end )else case when $role=3 then (case when dis is not null then 'Transfer' else 'Not Transfer' end) else case when $role=4 then (case when retailer is not null then 'Transfer' else 'Not Transfer' end) else 'Please Send Correct role' end end end end) as Message FROM `tbl_keys`";
    if ($role == 2) {
        $sql .= " WHERE national_dis = '$id'";
    } else if ($role == 3) {
        $sql .= " WHERE super_dis = '$id'";
    } else if ($role == 4) {
        $sql .= " WHERE dis = '$id'";
    } else if ($role == 5) {
        $sql .= " WHERE retailer = '$id'";
    }

    $res = mysqli_query($conn, $sql);
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
    http_response_code(404);
        $response = array('stetus' => false, 'data' => 'Id and Role are Required...');
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
