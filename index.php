<?php
session_start();
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'dashboard';
}

$user = $_SESSION['user'] ?? null;
if ($user === null) {
  $_SESSION['error'] = "Please log-in first bro";
  header('Location: collab-training/login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./public/css/app.css" rel="stylesheet" />
</head>

<body>

  <?php include_once './view/common/navbar.php'; ?>
  <?php include_once './view/common/sidebar.php'; ?>

  <div class="content">
    <?php if ($page === 'dashboard'): ?>
      <h1>Dashboard</h1>
      <h3 style="color: blue"><?php echo $user['fullname'] . "," ?></h3>
      <p> Welcome to the dashboard page.</p>
    <?php elseif ($page === 'users'): ?>
      <?php include_once './view/user/index.php'; ?>
    <?php elseif ($page === 'edit-user'): ?>
      <?php include_once './view/user/edit.php'; ?>
    <?php elseif ($page === 'user_role'): ?>
      <?php include_once './view/user/user_role.php'; ?>
    <?php elseif ($page === 'edit-role'): ?>
      <?php include_once './view/user/edit.php'; ?>
    <?php elseif ($page === 'project'): ?>
      <?php include_once './view/user/project.php' ?>

    <?php else: ?>
      <h1>Page not found</h1>
    <?php endif; ?>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>