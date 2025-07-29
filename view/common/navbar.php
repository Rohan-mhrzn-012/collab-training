<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <div class="dropdown ms-auto">
      <button class="btn btn-dark dropdown-toggle d-flex align-items-center" type="button" id="userDropdown"
              data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png"
             alt="User Icon" style="height:32px; width:32px; border-radius:50%; margin-right:8px;">
        <span>user Name</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="/../collab-training/controllers/AuthController.php?action=logout">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
