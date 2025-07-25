<nav class="sidebar">
  <a href="index.php?page=dashboard" class="<?= ($_GET['page'] ?? '') === 'index' ? 'active' : '' ?>">Dashboard</a>
  <a href="index.php?page=users" class="<?= ($_GET['page'] ?? '') === 'users' ? 'active' : '' ?>">Users</a>
  <a href="index.php?page=projects" class="<?= ($_GET['page']??"")==="projects"?"active":""?>">Projects</a>
</nav>
