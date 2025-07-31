<?php
include __DIR__ . "/../../controllers/ProjectController.php";
include __DIR__ . "/../../controllers/userController.php";
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

<a href="/core_php/collab-training/routes.php?route=project&action=create"></a>

<form action="#" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="project_name" class="form-label">Project Name:</label>
        <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Enter project name">
    </div>

    <?php if (!empty($error)):    ?>
        <div>
            <?php echo $error; ?>
        </div>
    <?php endif ?>

    <!-- <label for="project name">Project Name:</label>
    <input type="text" id="project_name" name="project_name" value="" placeholder="Please enter the project name"> -->
    <div class="mb-3">
        <label for="project_description" class="form-label">Project Description:</label>
        <input type="text" class="form-control" name="project_description" id="project_description" placeholder="Enter project details">
    </div>
    <!-- <label for="project description">Project Description:</label>
    <input type="text" id="project_description" name="project_description" value="" placeholder="Enter the project details"> -->
    <label for="start date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="">
    <label for="end date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="">
    <label for="status">Project Status:</label>
    <select name="status" id="status">
        <option value="">Select the project status</option>
        <?php foreach ($statuses as $status_value): ?>
            <option value="<?php echo $status_value; ?>"><?php echo $status_value; ?></option>
        <?php endforeach; ?>
    </select>

    <!-- <input type="text" id="status" name="status" value="" placeholder="Enter the project status"> -->

    <label for="Username">User:</label>
    <select name="username" id="username">
        <option value=""> Select a username </option>
        <?php foreach ($datas as $data): ?>
            <option value="<?php echo $data["username"]; ?>" name=""><?php echo $data["username"]; ?></option>
        <?php endforeach ?>
    </select>
    <div class="mb-3">
        <label for="project_image" class="form-label"></label>
        <input class="form-control" type="file" id="formFile" accept="image/*" name="project_image" id="project_image">
    </div>
    <!-- <input type="file" accept="image/*" name="project_image" id="project_image"> -->
    <button type="submit" id="update_btn" class="btn btn-success">Add new Project details</button>
</form>