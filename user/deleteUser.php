<?php

    include('../helper.php');
    if(isset($_POST['id']) && isset($_POST['deletedBy'])){

        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $deletedBy = mysqli_real_escape_string($conn, $_POST['deletedBy']);
        $date = date('d-m-y h:i:s');
        $sql = "UPDATE users SET is_active = 0, deleted_by = '$deletedBy', deleted_at = '$date'  WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        if($res){
            $response = array('status'=> true, 'message'=> "User Deleted Succesfully !!" );
        }else{
            $response = array('status'=> false, 'message'=> "User Can't Deleted !!" );
        }

    }else{
        $response = array('status'=> false, 'message'=> "All Field is required !!" );
    }
    $json = json_encode($response, JSON_PRETTY_PRINT);
    echo $json;

