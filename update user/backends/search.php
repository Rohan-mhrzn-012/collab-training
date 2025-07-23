<?php
include('backends/database/connect.php');

$results = [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ser'])) {
    $search = trim($_POST['ser']);

    if (!empty($search)) {
        $stmt = $conn->prepare('SELECT name, id, pno, JoinDate, Img FROM employee WHERE id = ?');

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param('s', $search);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $results = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $error = "No users found.";
        }

        $stmt->close();
    } else {
        $error = "Search field is empty.";
    }

    $conn->close();
}
?>