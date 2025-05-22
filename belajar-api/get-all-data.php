<?php
include 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
if($method !== 'GET') {
    http_response_code(400);
    echo 'Only GET Method is Allowed blayt.';
    exit();
}

$sql = mysqli_query($connect, "SELECT * FROM students");

$response = [];
while ($result = mysqli_fetch_object($sql))  {
    $response[] = $result;
}

header('Content-Type: application/json');
echo json_encode($response);