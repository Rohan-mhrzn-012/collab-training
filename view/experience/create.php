<?php
$errors = $_SESSION['errors'] ?? null;
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
$users=["pradeep","woodcarver","programmer","roshan"];
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
<h2>Add new experience</h2>
<form action="/core_php/collab-training/routes.php?route=experience&action=create" method="POST">

    <div class="mb-3">
        <label for="username">Username:</label>
        <select name="username" id="username" class="form-select" aria-label="Default select example" value="<?php echo $old["username"]??'';?>">
            <option value="">Select the username:</option>
            <?php foreach($users as $user):?>
            <option value="<?php echo $user?>"><?php echo $user?></option>
           <?php endforeach;?>
        </select>
    </div>
    <?php if (!empty($errors["username"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["username"]); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" name="title" id="title" value="<?php echo $old["title"]??'';?>" placeholder="Enter the title of the experience">
    </div>
    <?php if (!empty($errors["title"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["title"]); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="organization" class="form-label">Organization:</label>
        <input type="text" class="form-control" name="organization" id="organization" value="<?php echo $old["organization"]??'';?>" placeholder="Enter the name of the organization">
    </div>
    <?php if (!empty($errors["organization"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["organization"]); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="location" class="form-label">Location:</label>
        <input type="text" class="form-control" name="location" id="location" value="<?php echo $old["location"]??'';?>" placeholder="Enter the location of the organization">
    </div>
    <?php if (!empty($errors["location"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["location"]); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <input type="text" class="form-control" name="description" id="description" value="<?php echo $old["description"]??'';?>" placeholder="Enter the description">
    </div>
    <?php if (!empty($errors["description"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["description"]); ?></div>
    <?php endif; ?>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $old["start_date"]??'';?>" class="form-control">
    
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo $old["end_date"]??'';?>" class="form-control">

    <?php if (!empty($errors["date"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["date"]); ?></div>
    <?php endif; ?>

    <button type="submit" id="update_btn" class="btn btn-success" >Add new experience details</button>

</form>