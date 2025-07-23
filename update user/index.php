<?php
include('backends/database/connect.php');

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



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update user</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="id">
    <div id="fpart">
        <img src="<?php echo $results[0]['Img'] ; ?>" alt="" id="img">
        <p>Name: <?php echo $results[0]['name'] ?? ''; ?></p>
    </div>

    <div id="spart">
        <p>ID: <?php echo $results[0]['id'] ?? ''; ?></p>
        <p>Join Date: <?php echo $results[0]['JoinDate'] ?? ''; ?></p>
        <p>Number: <?php echo $results[0]['pno'] ?? ''; ?></p>
    </div>

    <form method="post">
        <input type="text" name="ser" placeholder="Enter Employee id" required>
        <button type="submit" >Find</button>
    </form>
</div>


    </div>

   <form id="editForm" method="post" action="backends/save_user.php" enctype="multipart/form-data">
    <label>ID: 
        <input type="text" name="id" placeholder="First enter employee id" require>
    </label><br>
    <label>Profile Image: 
        <input type="file" name="profile_img" accept="image/*">
    </label><br>
    <label>Name: 
        <input type="text" name="name" required>
    </label><br>
    <label>Join Date: 
        <input type="date" name="join_date" required>
    </label><br>
    <label>Number: 
        <input type="text" name="number">
    </label><br>
    <button type="submit">Save</button><br>
</form>



</body>

</html>