<?php
include __DIR__ . '/../../controllers/index.php';
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'edit-user':
        include 'edit.php';
        exit;
}
$session_user = $_SESSION['user'] ?? null;
if ($session_user === null) {
    echo "No User in db";
}
if (!empty($_SESSION['message'])) {

    echo $_SESSION['message'];
}
unset($_SESSION['message']);
?>

<h1>Users</h1>
<table class="table table-striped table-bordered align-middle" id="user_table">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th style="width: 190px;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <!-- <input type="text" name="ids" value="<?php echo $user['id'] ?> " hidden> -->
                <td><?php echo $user['fullname'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td>
                    <a href="./index.php?page=edit-user&id=<?php echo $user['id'] ?>" class="btn btn-primary btn-sm me-1">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="./index.php?page=view-user&id=<?php echo $user['id'] ?>" class="btn btn-info btn-sm me-1">
                        <i class="bi bi-eye"></i> View
                    </a>
                    <?php if (in_array("Admin", $session_user["user_roles"])) { ?>
                        <a href="#" class="btn btn-danger btn-sm delete-user" data-id="<?php echo $user['id'] ?>" data-bs-toggle="modal" data-bs-target="#userDeleteModal">
                            <i class="bi bi-trash"></i> Delete
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<div class="modal fade" id="userDeleteModal" tabindex="-1" aria-labelledby="userDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="userDeleteModalLabel">User Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
      </div>
    </div>
  </div>
</div>
