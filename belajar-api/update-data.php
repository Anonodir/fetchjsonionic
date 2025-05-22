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
if ($method !== 'PATCH') {
    http_response_code(400);
    echo 'Only PATCH method is allowed';
    exit();
}

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

// var for data from database
$id = $data['student_id'];
$no = $data['student_no'];
$name = $data['student_name'];
$class = $data['student_class'];

// Jangan Lupa untuk ini syntax diatas diubah menjadi seperti ini
$sql = mysqli_query($connect, "UPDATE students SET student_no='$no', student_name='$name', student_class='$class' WHERE student_id='$id'");

$affectedRow = mysqli_affected_rows($connect);

header('Content-Type: application/json');
// json_encode untuk mengubah array menjadi JSON
echo json_encode([
    'status' => 'OK',
    'msg' => 'Data has been edited succesfully',
    'affected_row' => $affectedRow
]);