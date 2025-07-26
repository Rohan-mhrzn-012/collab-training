<?php
include __DIR__."/../database/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

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

    $stmt->close();
} else {
    echo "Invalid request.";
}

$connection->close();
?>