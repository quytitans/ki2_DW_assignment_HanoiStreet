<?php
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
//cau hinh db
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "hanoistreet";
//tao ket noi
$conn = new mysqli($serverName, $userName, $password, $dbName);
//check connection
if ($conn->connect_errno) {
    die("Connection failed" . $conn->connect_error);
}
//make query
$query = "SELECT * FROM streets WHERE id =".$id;
$result = $conn->query($query);
header('Content-Type: application/json');
$rows = array();
if ($result->num_rows != 0 ){
    http_response_code(200);
}else{
    http_response_code(400);
}

while ($r = $result->fetch_assoc()) {
    $rows[] = $r;
}
header('Content-Type: application/json');
echo json_encode($rows);

$conn->close();