<?php 
$search = $_POST['ser'];

$stmt = $conn->prepare('SELECT name FROM employee where name = ?');
$stmt->bind_param('s', $search);
if($stmt->execute()){
    echo("Found the user");
}else{
    echo("User not found");
}
?>