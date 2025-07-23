<?php 
$user = "root";
$host = "localhost";
$pass = "";
$db = "update_user";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection Failed". $conn->connect_error);
}
?>