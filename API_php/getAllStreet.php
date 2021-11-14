<?php
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
$query = "SELECT * FROM streets";
$result = $conn->query($query);
header('Content-Type: application/json');
$rows = array();
http_response_code(200);
while ($r = $result->fetch_assoc()) {
    $rows[] = $r;
}
header('Content-Type: application/json');
echo json_encode($rows);
$conn->close();