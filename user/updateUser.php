

<?php
include('../helper.php');
if (isset($_POST)) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $by = "id = $id";
    $sql = build_sql_update('users', $_POST, $by);

    $res = mysqli_query($conn, $sql);
    if ($res) {
        $response = array('status' => true, 'message' => "User Update Succesfully !!");
    } else {
        $response = array('status' => false, 'message' => "User Can Not be Update !!");
    }
} else {
    $response = array('status' => false, 'message' => "All Fields is Required !!");
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
?>