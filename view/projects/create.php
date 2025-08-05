<?php
$errors = $_SESSION['errors'] ?? null;
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

require_once __DIR__ . "/../../controllers/ProjectController.php";
require_once  __DIR__ . "/../../controllers/userController.php";
$create_obj = new UserController;
$datas = $create_obj->getAllUsers();
$statuses = ['starting', 'ongoing', 'completed'];


?>
<style>
    form {
        display: grid;
        margin: 30px;
    }

    input {
        margin: 10px 0px 10px 0;
    }

    #update_btn {
        margin-top: 10px;
        width: 30%;
        border-radius: 10px;
    }

    button:hover {
        background-color: #4c4f4cff;
        color: white;
    }
</style>

<h1>Create new Project</h1>



<form action="/core_php/collab-training/routes.php?route=project&action=create" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="project_name" class="form-label">Project Name:</label>
        <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Enter project name" value="<?php echo $old["project_name"]??'';?>">
    </div>

    <?php if (!empty($errors["project_name"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["project_name"]); ?></div>
    <?php endif; ?>

    <!-- <label for="project name">Project Name:</label>
    <input type="text" id="project_name" name="project_name" value="" placeholder="Please enter the project name"> -->
    <div class="mb-3">
        <label for="project_description" class="form-label">Project Description:</label>
        <input type="text" class="form-control" name="project_description" id="project_description" placeholder="Enter project details" value="<?php echo$old["project_description"]??'';?>">
    </div>
    <?php if (!empty($errors["description"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["description"]); ?></div>
    <?php endif; ?>
    <!-- <label for="project description">Project Description:</label>
    <input type="text" id="project_description" name="project_description" value="" placeholder="Enter the project details"> -->
    <label for="start date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo$old["start_date"]??'';?>">
    <label for="end date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo$old["end_date"]??'';?>">
    <?php if (!empty($errors["date"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["date"])??'' ?></div>
    <?php endif; ?>
    <label for="status">Project Status:</label>
    <select name="status" id="status">
        <option value="">Select the project status</option>
        <?php foreach ($statuses as $status_value): ?>
            <option value="<?php echo $status_value; ?>" 
            <?php echo (!empty($old['status']) && $old['status'] === $status_value) ? 'selected' : ''; ?>>
            <?php echo $status_value; ?>
        </option>
        <?php endforeach; ?>
    </select>
    <?php if (!empty($errors["status"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["status"]); ?></div>
    <?php endif; ?>

    <!-- <input type="text" id="status" name="status" value="" placeholder="Enter the project status"> -->

    <label for="Username">User:</label>
    <select name="username" id="username">
        <option value=""> Select a username </option>
        <?php foreach ($datas as $data): ?>
            <option value="<?php echo $data["username"]; ?>" name="" <?php echo (!empty($old['username']) && $old['username'] === $data["username"]) ? 'selected' : ''; ?>><?php echo $data["username"]; ?></option>
        <?php endforeach ?>
    </select>
    <?php if (!empty($errors["username"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["username"]); ?></div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="project_image" class="form-label"></label>
        <input class="form-control" type="file" id="formFile" accept="image/*" name="project_image" id="project_image">
    </div>
    <!-- <input type="file" accept="image/*" name="project_image" id="project_image"> -->
    <button type="submit" id="update_btn" class="btn btn-success">Add new Project details</button>
</form>