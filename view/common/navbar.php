<?php $user = $_SESSION['user'] ?? null; ?>

<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <div class="dropdown ms-auto">
      <button class="btn btn-dark dropdown-toggle d-flex align-items-center" type="button" id="userDropdown"
              data-bs-toggle="dropdown" aria-expanded="false">
            <img src="public/uploads/profilePicture/<?php echo $user['profile_picture'] ?>"
             alt="User Icon" style="height:32px; width:32px; border-radius:50%; margin-right:8px;">
        <span>user Name</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="/collab-training/router.php?route=auth/logout">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

