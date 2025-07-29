<nav class="sidebar">
  <a href="index.php?page=dashboard" class="<?= ($_GET['page'] ?? '') === 'index' ? 'active' : '' ?>">Dashboard</a>
  <a href="index.php?page=users" class="<?= ($_GET['page'] ?? '') === 'users' ? 'active' : '' ?>">Users</a>
  <a href="index.php?page=user_role" class="<?= ($_GET['page'] ?? '') === 'user_role' ? 'active' : '' ?>">User Roles</a>
</nav>
