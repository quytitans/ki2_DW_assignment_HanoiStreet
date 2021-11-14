<?php
$data = json_decode(file_get_contents('php://input'), true);
$keyword = $data['keyword'];
$district = $data['district'];
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
//insert in many case
$sql ="";
if ($keyword != null && strlen($keyword) > 0 && ($district == null || strlen($district) == 0)) {
    $sql = "SELECT * FROM streets WHERE name LIKE '%$keyword%'";
};
if ($keyword != null && strlen($keyword) > 0 && $district != null && strlen($district) > 0) {
    $sql = "SELECT * FROM streets WHERE name LIKE '%$keyword%' AND district = '$district'";
}
if ($district != null && strlen($district) > 0 && ($keyword == null || strlen($keyword) == 0)) {
    $sql = "SELECT * FROM streets WHERE district = '$district'";
};
$result = $conn->query($sql);
header('Content-Type: application/json');
$rows = array();
http_response_code(200);
while ($r = $result->fetch_assoc()) {
    $rows[] = $r;
}
header('Content-Type: application/json');
echo json_encode($rows);
$conn->close();