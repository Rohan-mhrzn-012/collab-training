<?php

require_once __DIR__ . "/../../controllers/userController.php";
$controller = new UserController();
$userid = $_GET['id'] ?? 0;
if (!$userid) {
    die("User ID is missing.");
}
$user = $controller->getAllUsers($userid);

$new = "";
$next = "";

switch ($page) {
    case 'edit-role':
        $new = "hidden";
        break;
    case 'edit-user':
        $next = "hidden";
        break;
    default:
        $new = "";
}

?>

<h1>Edit <?php echo $user['fullname']; ?></h1>

<form action="/../collab-training/router.php?route=edit" method="POST" enctype="multipart/form-data">
    <input type="text" name="id" value="<?php echo $user['id'] ?> " hidden>
    <div style="text-align: center;" <?php echo $new ?>>
        <img src="public/images/profilepic/<?php echo $user['pimage'] ?>" style="width:300px; height:300px; object-fit:cover; border-radius:50%; text-align:center;">
        <div class="updateimage">
            <label for="image">Update Image</label><br>
            <input type="file" id="image" name="profileimage" accept="image/">
        </div>
    </div>

    <div class="mb-3" <?php echo $new ?>>
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['fullname'] ?>">
    </div>

    <div class="mb-3" <?php echo $new ?>>
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username'] ?>">
    </div>

    <div class="mb-3" <?php echo $new ?>>
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>">
    </div>

    <div class="mb-3" <?php echo $new ?>>
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $user['phone_number']?>" >

    </div>

    <div class="mb-3" <?php echo $new ?>>
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" id="gender" name="gender">
            <option value="Male" <?= (isset($user['gender']) && $user['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= (isset($user['gender']) && $user['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= (isset($user['gender']) && $user['gender'] === 'Other') ? 'selected' : '' ?>>Other</option>

        </select>
    </div>
    <div class="mb-3">
        <label for="github">Github</label>
        <input type="url" id="github" name="github" value="<?php echo $user["github"]?>">
        <label for="linkedin">LinkedIn</label>
        <input type="url" name="linkedin" id="linkedin" value="<?php echo $user["linkedin"]?>">
    </div>
    
    <!-- userrole edit -->
    <div class='mb-3' <?php echo $next ?>>
        <label for="text">Role</label>
        <input type="text" id="text" value="">
    </div>


    <!-- <div class="mb-3">
        <label for="roles">Roles</label>
        <select class="js-example-basic-multiple form-control" name="states[]" multiple="multiple">
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="WY">Wyoming</option>
        </select>
        </select>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    Select2 JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <!-- Initialize Select2 -->
    <!-- <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script> -->

    <button type="submit" class="btn btn-primary" name="submit" value='submit'>Update User</button>
</form>