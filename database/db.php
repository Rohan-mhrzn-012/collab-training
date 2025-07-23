<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'test';
$port = 3310;

$connection = new mysqli($host, $user, $password, $db, $port);
if ($connection->connect_error) {
    die("connection fail:" . $connection->connect_error);
}
?>