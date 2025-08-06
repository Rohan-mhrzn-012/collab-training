<?php
include __DIR__ . "/../../controllers/ProjectController.php";
$errors = $_SESSION['errors'] ?? null;
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$edit_obj = new ProjectController;
$edit_data = $edit_obj->view();


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

<h1>Edit the <?php echo $edit_data["project_name"] . "'s details" ?></h1>

<!-- <a href="/core_php/collab-training/controllers/ProjectController.php?id=<?php echo $edit_data["project_id"] ?>"></a> -->

<form action="/core_php/collab-training/routes.php?route=project&action=edit&id=<?php echo $edit_data["project_id"] ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="project_name" class="form-label">Project Name:</label>
        <input type="text" class="form-control" name="project_name" id="project_name" value="<?php echo $old["project_name"] ??$edit_data["project_name"]  ?>" >
    </div> 
    <?php if (!empty($errors["project_name"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["project_name"]); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="project_description" class="form-label">Project Description:</label>
        <input type="text" class="form-control" name="project_description" id="project_description" value="<?php echo $old["project_description"]?? $edit_data["description"] ?>">
    </div>  
    <?php if (!empty($errors["project_description"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["project_description"]); ?></div>
    <?php endif; ?>
    
    <label for="start date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $old["start_date"] ??$edit_data["start_date"] ?>" class="form-control">

    <label for="end date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo $old["end_date"]??$edit_data["end_date"] ?>" class="form-control">

    <?php if (!empty($errors["date"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["date"]); ?></div>
    <?php endif; ?>

    <label for="status">Project Status:</label>
    <select name="status" id="status" class="form-select" aria-label="Default select example">
        <option value="<?php echo $edit_data["status"] ?>"><?php echo  $old["status"]??$edit_data["status"] ?></option>
        <?php foreach ($statuses as $status_value): ?>
            <option value="<?php echo $status_value; ?>"><?php echo $status_value; ?></option>
        <?php endforeach; ?>
    </select> 
    <?php if (!empty($errors["status"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["status"]); ?></div>
    <?php endif; ?>  

    <img src="/core_php/collab-training/public/uploads/project_images/<?php echo $edit_data["project_image"]; ?>" alt="Project Image" width="150">
    <div class="mb-3">
        <label for="project_image" class="form-label">Select New Image</label>
        <input class="form-control" type="file" accept="image/*" name="project_image" id="project_image">
    </div>
    <!-- <input type="file" id="project_image" name="project_image">  -->
    <button type="submit" id="update_btn" class="btn btn-success">Update Project details</button>

</form>