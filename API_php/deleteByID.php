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
//check ton tai
$query1 = "SELECT * FROM streets WHERE id =" . $id;
$result1 = $conn->query($query1);
if ($result1->num_rows != 0) {
    $query = "DELETE FROM streets WHERE id =" . $id;
    $result = $conn->query($query);
    $response = array("message"=>"delete completed");
    echo json_encode($response);
} else {
    $response = array("message"=>"delete completed");
    echo json_encode($response);
}
$conn->close();