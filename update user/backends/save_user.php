<?php
include ('database/connect.php');

$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$join_date = $_POST['join_date'] ?? '';
$number = $_POST['number'] ?? '';
$profile_img = $_FILES["profile_img"];

$stmt = $conn->prepare("SELECT id FROM employee WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql = "UPDATE employee SET name = ?, joinDate = ?, pno = ?, Img = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $join_date, $number, $profile_img, $id);
} else {
    $sql = "INSERT INTO employee (id, name, joinDate, pno, Img) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $id, $name, $join_date, $number, $profile_img);
}

if ($stmt->execute()) {
    echo "User saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
