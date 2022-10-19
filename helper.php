<?php

include('config.php');

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Headers: access");

header("Access-Control-Allow-Methods: POST");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// $data = json_decode(file_get_contents('php://input'));
// date('d-m-y h:i:s')


// All Data

function addData($table, $columns, $values)
{
    global $conn;
    $sql = "INSERT INTO $table($columns) VALUES($values)";
    return mysqli_query($conn, $sql);
}

// Get All Data From The Table 
function getAllData($table)
{
    global $conn;
    $sql = "SELECT * FROM $table";
    return mysqli_query($conn, $sql);
}

// Get Active user Data By Role From The Table 
function getUserByRole($table, $id)
{
    global $conn;
    $sql = "SELECT * FROM $table Where role = '$id' AND is_active = 1";
    return mysqli_query($conn, $sql);
}

// Get Data By Id From The Table 
function getDataById($table, $by, $id)
{
    global $conn;
    $sql = "SELECT * FROM $table Where $by = '$id'";
    return mysqli_query($conn, $sql);
}

// Delete --- Update Data From Table By Id
function deleteData($table, $id)
{
    global $conn;
    $sql = "UPDATE $table SET `is_active`= 0 WHERE id = '$id'";
    return mysqli_query($conn, $sql);
}

function updateData($table, $columns, $values, $id)
{
    global $conn;
    $sql = "UPDATE $table SET $columns = $values  WHERE id = '$id'";
    print_r($sql);
    die;
    return mysqli_query($conn, $sql);
}

function build_sql_update($table, $data, $where)
{
    $cols = array();
    foreach ($data as $key => $val) {
        $cols[] = "$key = '$val'";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";
    return ($sql);
}

