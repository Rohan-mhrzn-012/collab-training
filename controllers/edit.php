<?php 
    include __DIR__. '/../database/db.php';

    $loggedInUser = $_SESSION['user'] ?? null;

    // check if user is signed-in
    if ($loggedInUser === null) {
        header("Location: /collab-training/login.php");
        exit;
    }
    // check if user is signed-in end

    $userid = $_GET['id'];

    $query = "SELECT * FROM users WHERE id = ?";
    $prepareStatement = $connection->prepare($query);
    $prepareStatement->bind_param('i', $userid);
    $prepareStatement->execute();

    $result = $prepareStatement->get_result();
    $user = $result->fetch_assoc();
?>