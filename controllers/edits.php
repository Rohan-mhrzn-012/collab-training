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

$query = "SELECT phone_number FROM users WHERE id = ?";
$prepareStatement = $connection->prepare($query);
if (!$prepareStatement) {
    die("Prepare failed: " . $connection->error);
}
$prepareStatement->bind_param('i', $userid);
$prepareStatement->execute();

$result = $prepareStatement->get_result();
$user = $result->fetch_assoc();



if ($result && $result->num_rows === 1 && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $name  = !empty($_GET['fullname']) ? $_GET['fullname'] : $user['fullname'];
    $uname = !empty($_GET['username']) ? $_GET['username'] : $user['username'];
    $email = !empty($_GET['email']) ? $_GET['email'] : $user['email'];
    $pno   = !empty($_GET['phone_number']) ? $_GET['phone_number'] : $user['phone_number'];
    $gen   = !empty($_GET['gender']) ? $_GET['gender'] : $user['gender'];
    $submit = $_GET['submit'] ?? "";


    $updateuser = "UPDATE users SET fullname = ?, username = ?, email = ?, gender = ?, phone_number = ? WHERE id = ?";
    $stmt = $connection->prepare($updateuser);
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }

    $stmt->bind_param("sssssi", $name, $uname, $email, $gen, $pno, $userid);

    $stmt->execute();

    if ($submit === "submit") {
        if ($stmt->affected_rows > 0) {
            // header('Location: /collab-training/');
            echo "User updated successfully!";
        } else {
            echo "No user updated";
        }
    }
    $stmt->close();
}
