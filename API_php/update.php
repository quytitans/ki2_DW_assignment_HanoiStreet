<?php
//get json data
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

$name = $data['name'];
$desciption = $data['desciption'];
$usingDate = $data['usingDate'];
$district = $data['district'];
$status = $data['status'];
$updatedAt = date("Y-m-d");

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
$sql2 = "UPDATE streets SET name = '". $name ."', desciption = '". $desciption ."',usingDate = '" . $usingDate . "',district = " . $district . ",status = " . $status . ",updatedAt = '" . $updatedAt ."' WHERE id = ".$id;
echo $sql2;
$result = $conn->query($sql2);
$conn->close();