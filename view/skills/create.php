<?php
$errors = $_SESSION['errors'] ?? null;
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
$levels = ['beginner', 'intermediate', 'advanced'];
$users=["woodcarver","programmer","roshan","pradeep"];
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
<h2>Add new Skill</h2>
<form action="/core_php/collab-training/routes.php?route=skills&action=create" method="POST">
    <div class="mb-3">
    <label for="username">Username:</label>
    <select name="username" id="username" class="form-select" aria-label="Default select example" value="<?php echo $old["username"]??'';?>">
        <option value="">Select a username</option>
        <?php foreach($users as $user):?>
        <option value="<?php echo$user;?>"><?php echo$user;?></option>
        <?php endforeach;?>
    </select>
    </div>
    <?php if (!empty($errors["username"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["username"]); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="skill_name" class="form-label">Skill Name:</label>
        <input type="text" class="form-control" name="skill_name" id="skill_name" value="<?php echo $old["skill_name"]??'';?>" placeholder="Enter the skill name">
    </div>
    <?php if (!empty($errors["name"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["name"]); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="skill_category" class="form-label">Skill Category:</label>
        <input type="text" class="form-control" name="skill_category" id="skill_category" value="<?php echo $old["skill_category"]??'';?>" placeholder="Enter the skill category">
    </div>
    <?php if (!empty($errors["category"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["category"]); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="skill_level">Skill Level:</label>
        <select name="skill_level" id="skill_level" class="form-select" aria-label="Default select example" <?php echo $old["skill_level"]??'';?>>
            <option value="">Select the skill level:</option>
            <?php foreach ($levels as $level): ?>
                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php if (!empty($errors["level"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["level"]); ?></div>
    <?php endif; ?>

    <label for="created_at">Created At:</label>
    <input type="date" id="created_at" name="created_at" value="<?php echo $old["created_at"]??'';?>" class="form-control">

    <label for="updated_at">Updated At:</label>
    <input type="date" id="updated_at" name="updated_at" value="<?php echo $old["updated_at"]??'';?>" class="form-control">

    <?php if (!empty($errors["date"])): ?>
        <div class="alert alert-danger" ><?php echo($errors["date"]); ?></div>
    <?php endif; ?>
    
    <button type="submit" id="update_btn" class="btn btn-success">Add new Skill details</button>

</form>