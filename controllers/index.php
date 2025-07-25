<?php 
    include __DIR__. '/../database/db.php';

    $db = new Database();
    $connection = $db->getConnection();

    $loggedInUser = $_SESSION['user'] ?? null;

    if ($loggedInUser === null) {
        header("Location: /core_php/collab-training/login.php");
        exit;
    }

    $query = 'SELECT * FROM users;';
    $result = $connection->query($query);

    $users = [];

    if ($result) {
        $users = $result->fetch_all(MYSQLI_ASSOC);
    }
?>