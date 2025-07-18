<?php 
    include('./database/db.php');

    $rawQuery = "SELECT * FROM students;";
    $queryReuslt = $connection->query($rawQuery);

    $data = $queryReuslt->fetch_all(MYSQLI_ASSOC);
    $count = count($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
</head>
<body>

<h2>Students</h2>
<table border="1">
    <tr>
        <th>name</th>
        <th>Age</th>
        <th>Email</th>
    </tr>

    <?php for ($i=0; $i < $count ; $i++) { ?>
        <tr>
            <td><?= $data[$i]['name'] ?></td>
            <td><?= $data[$i]['age'] ?></td>
            <td><?= $data[$i]['email'] ?></td>
        </tr>
   <?php } ?>

</table>


</body>
</html>