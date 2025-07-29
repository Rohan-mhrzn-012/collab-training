<?php
include __DIR__ . "/../database/db.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userid = $_SESSION['id'] ?? "";
    $id = intval($_POST['id']);
    if ($userid == $id) {
        echo "You can't delete yourself";
        exit;
    } else {
        $stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
        if (!$stmt) {
            echo "SQL error: " . $connection->error;
            exit;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "User ID $id deleted successfully.";
        } else {
            echo "No user found with ID $id.";
        }
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}

$connection->close();
