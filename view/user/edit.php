<?php
    include '../collab-training/controllers/edit.php';
?>

<h1>Edit User</h1>

<form action="#" method="POST">
    <input type="text" name="id" value="<?php echo $user['id'] ?> " hidden>
    <div class="mb-3">
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['fullname'] ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="" required>
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="">
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" id="gender" name="gender">
            <option value="Male" <?= ($user['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= ($user['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= ($user['gender'] === 'Other') ? 'selected' : '' ?>>Other</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update User</button>
</form>
