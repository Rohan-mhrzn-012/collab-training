<?php 
    include __DIR__. '/../database/db.php';
    session_start();
    $loggedInUser = $_SESSION['user'] ?? null;

    if ($loggedInUser === null) {
        header("Location: /collab-training/login.php");
        exit;
    }

    $query = 'SELECT * FROM users;';
    $result = $connection->query($query);

    $users = [];

    if ($result) {
        $users = $result->fetch_all(MYSQLI_ASSOC);
    }

?>