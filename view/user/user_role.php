<?php
include __DIR__."/../../controllers/userrole.php";
$page = $_GET['page'] ?? 'home';
$users = $_SESSION['user'] ?? '';
switch ($page) {
    case 'edit-user':
        include 'edit.php';
        return;
}

?>
<h1>User Roles</h1>
<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th style="width: 190px;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allUsers as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['fullname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= implode(', ', $user['user_roles']) ?></td>
                <td>
                    <a href="./index.php?page=edit-user&id=<?= $user['id'] ?>" class="btn btn-primary btn-sm me-1">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="./index.php?page=view-user&id=<?= $user['id'] ?>" class="btn btn-info btn-sm me-1">
                        <i class="bi bi-eye"></i> View
                    </a>
                    <?php if (in_array("Admin", $_SESSION['user']['user_roles'] ?? [])): ?>
                        <a class="btn btn-danger btn-sm" onclick="return deleteUser(<?= $user['id'] ?>, this)">
                            <i class="bi bi-trash"></i> Delete
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="/../collab-training/public/js/deleteUser.js"></script>
