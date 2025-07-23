<?php
    session_start();

    $_SESSION = [];
    unset($_SESSION['user']);

    session_destroy();

    header("Location: /collab-training/login.php");
    exit;

?>