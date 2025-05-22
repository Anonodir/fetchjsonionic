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
if ($method !== 'DELETE') { 
    http_response_code(400); 
    echo 'Only DELETE method is allowed'; 
    exit(); 
} 
 
$postData = file_get_contents('php://input'); 
$data = json_decode($postData, true); 
 
// Var for data from database 
$id = $_GET['id']; 
 
// Ini adalah cara yang Lain untuk insert data tapi lebih baik pakai variabel 
// $sql = mysqli_query($connect, "INSERT INTO students (student no, student name, student class) VALUES (($data['student_name'] 
 
// Jangan Lupa untuk ini syntax diatas diubah menjadi seperti ini 
$sql = mysqli_query($connect, "DELETE FROM students WHERE student_id = '$id'"); 
$affectedRow = mysqli_affected_rows($connect); 
 
header('Content-Type: application/json'); 
// json_encode untuk mengubah array menjadi JSON
echo json_encode([
    'status' => 'OK', 
    'msg' => 'Data has been deleted succesfully', 
    'affected_row' => $affectedRow 
]);