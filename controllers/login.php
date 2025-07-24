<?php 
    session_start();
    include __DIR__. '/../database/db.php';

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Email or password is required.';
        header('Location: /collab-training/login.php');
        exit;
    }

    $query = "SELECT * FROM users WHERE email = ?";
    $prepareStatement = $connection->prepare($query);
    $prepareStatement->bind_param('s', $email);
    $prepareStatement->execute();

    $result = $prepareStatement->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                "id" => $user['id'],
                "email" => $user['email'],
                "fullname" => $user['fullname'],
                "username" => $user['username'],
            ];
            header('Location: /collab-training/index.php?page=dashboard');
            exit;
        }
    }
    else{
        header('Location: /collab-training/login.php');
    }
?>