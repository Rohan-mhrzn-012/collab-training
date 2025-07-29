<!-- 
    <?php
    $path = __DIR__ . '/../../controllers/edit.php';
    if (!file_exists($path)) {
        echo "File not found: $path";
    } else {
        include($path);
    }
    
    ?> -->


<h1>Edit User</h1>

<form action="/../collab-training/controllers/userController.php?action=edit" method="POST">
    <input type="text" name="id" value="<?php echo $user['id'] ?> " hidden>
    <div class="mb-3">
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['fullname'] ?>">
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username'] ?>">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>">
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="">

    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" id="gender" name="gender">
            <option value="Male" <?= (isset($user['gender']) && $user['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= (isset($user['gender']) && $user['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= (isset($user['gender']) && $user['gender'] === 'Other') ? 'selected' : '' ?>>Other</option>

        </select>
    </div>

    <button type="submit" class="btn btn-primary" name="submit" value='submit'>Update User</button>
</form>