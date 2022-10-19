<?php

include('../helper.php');

if (isset($_POST['keys']) && isset($_POST['assign_by']) && isset($_POST['assign_to'])) {
    $keys = mysqli_real_escape_string($conn, $_POST['keys']);
    $assign_by = mysqli_real_escape_string($conn, $_POST['assign_by']);
    $assign_to = mysqli_real_escape_string($conn, $_POST['assign_to']);

    $res = getDataById('users', 'id', $assign_by);

    $row = mysqli_fetch_assoc($res);
    $role = $row['role'];

    $my_array = explode(",", $keys);
    $date = date('d-m-y h:i:s');

    foreach ($my_array as $id) {
        $sql = '';
        $sql .= "UPDATE `tbl_keys` SET `updated_at` = '$date'";
        if($role == 1){
            $sql .= ", `assign_by` = '$assign_by' ,`national_dis` = '$assign_to' ";
        }
        elseif($role == 2){
            $sql .= ",`super_dis` = '$assign_to' ";
        }
        else if ($role == 3){
            $sql .= ",`dis` = '$assign_to' ";
        }
        else if ($role == 4){
            $sql .= ",`retailer` = '$assign_to' ";
        }
       
        $sql .= "WHERE id = '$id'";

        $res = mysqli_query($conn, $sql);
        if ($res) {
            http_response_code(201);
            $response = array('status' => true, 'message' => 'keys Assigned Succesffuly !!');
        } else {
            $response = array('status' => false, 'message' => 'keys not Assigned !!');
        }
    }
} else {
    http_response_code(400);
    $response = array('status' => false, 'message' => 'All Field is Required !!');
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
