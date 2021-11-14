<?php
//get json data
$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$desciption = $data['desciption'];
$usingDate = $data['usingDate'];
$district = $data['district'];
$status = $data['status'];
$createdAt = date("Y-m-d");
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
//insert
$sql = "INSERT INTO streets (name, desciption, usingDate, district, status, createdAt, updatedAt) 
VALUES ('". $name ."','" . $desciption . "','" . $usingDate . "'," . $district . "," . $status . ",'" . $createdAt . "','" . $updatedAt ."')";
$result = $conn->query($sql);
if ($result){
    echo 'Save success!!!';

}else{
    echo 'Save false!!';
}
$conn->close();