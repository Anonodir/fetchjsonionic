<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, , PATCH, DELETE, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    http_response_code(400);
    echo 'Only POST method is allowed';
    exit();
}

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

//function createUser($postData)
$nama = $data['student_name'];
$no = $data['student_no'];
$class = $data ['student_class'];

$sql = mysqli_query ($connect, "INSERT INTO students (student_id, student_no, student_name, student_class) VALUES(null,'$no','$nama','$class')");
$insertId = mysqli_insert_id($connect);

header('Content0Type: application/json');
echo json_encode([
    'status' => 'OK',
    'msg'    => 'Data has been created succesfully',
    'inserted_id' => $insertId
]);