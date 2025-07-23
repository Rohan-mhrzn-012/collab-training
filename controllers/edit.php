<?php
include __DIR__ . '/../database/db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$loggedInUser = $_SESSION['user'] ?? null;

// check if user is signed-in
if ($loggedInUser === null) {
    header("Location: /collab-training/login.php");
    exit;
}
// check if user is signed-in end

$userid = $_GET['id'] ?? "";

$query = "SELECT * FROM users WHERE id = ?";
$prepareStatement = $connection->prepare($query);
 if (!$prepareStatement) {
    die("Prepare failed: " . $connection->error);
}
$prepareStatement->bind_param('i', $userid);
$prepareStatement->execute();

$result = $prepareStatement->get_result();
$user = $result->fetch_assoc();

if ($result && $result->num_rows === 1) {
    $name = $_GET["fullname"] ?? "";
    $uname  = $_GET["username"] ?? '';
    $email = $_GET["email"] ?? '';
    $pno = $_GET["phone_number"] ?? '';
    $gen = $_GET["gender"] ?? '';

    $updateuser = "UPDATE users SET fullname = ?, username = ?, email =?, gender = ?, phone_number = ? WHERE id = ?";
    $stmt = $connection->prepare($updateuser);
    if($stmt === null){
        die("Connection error" . $connection->error);
    }
    $stmt->bind_param(
        "ssssii",
        $name,
        $uname,
        $email,
        $gen, 
        $pno,
        $userid
    );
    $stmt->execute();
    
}
