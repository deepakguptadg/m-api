<?php
include('../helper.php');
if (!empty($_POST)) {
    if (isset($_POST['role']) && isset($_POST['assign_id'])) {
        $role = $conn->real_escape_string($_POST['role']);
        $assiged_id = $conn->real_escape_string($_POST['assign_id']);
        $sql = '';
        $sql = "SELECT * FROM users  ";
        if($assiged_id == 1 ){
            $sql .= "WHERE role = '$role'";
        }else{ 
            $sql .= "WHERE assigned_by = '$assiged_id'";
        }
        $sql .= "AND is_active = 1";
        $result = mysqli_query($conn, $sql);
        if ($row_count = mysqli_num_rows($result) > 0) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
                $response = array('status' => true, 'data' => $data);
            }
        } else {
            $response = array('status' => false, 'message' => 'No Data Found...');
        }
    } else {
        $response = array('status' => false, 'message' => 'All Field is required !!...');
    }
}else{
    $response = array('status' => false, 'message' => 'All Field is required !!...');
}
$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;

