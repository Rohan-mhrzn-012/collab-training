<?php
    include __DIR__. '/../../controllers/index.php';
    $page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'edit-user':
        include 'edit.php';
        return;
    }
    $session_user = $_SESSION['user'] ?? null;
    var_dump($session_user);
?>

<h1>Users</h1>
<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
    <tr><th>ID</th><th>Name</th><th>Email</th>
    <th style="width: 190px;">Action</th></tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
            <td><?php echo $user['id'] ?></td>
            <td><?php echo $user['fullname'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td>
                    <a href="./index.php?page=edit-user&id=<?php echo $user['id'] ?>" class="btn btn-primary btn-sm me-1">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="./index.php?page=view-user&id=<?php echo $user['id'] ?>" class="btn btn-info btn-sm me-1">
                        <i class="bi bi-eye"></i> View
                    </a>
                    <?php if(in_array("Admin", $session_user["user_roles"])){?>
                    <a class="btn btn-danger btn-sm" 
                       onclick="return deleteUser(<?php echo $user['id']?>, this)">
                        <i class="bi bi-trash"></i> Delete
                    </a>
                    <?php } ?>
                </td>
        </tr>
        <?php endforeach ?>   
    </tbody>
</table>
<script src="/../collab-training/public/js/deleteUser.js"></script>