<?php
include_once __DIR__ . "/../../controllers/SkillController.php";
$edit_obj = new SkillController;
$edit_data = $edit_obj->view();
$users=["woodcarver","pradeep","roshan","programmer"];
$levels = ['beginner', 'intermediate', 'advanced'];

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

<h1>Edit the <?php echo $edit_data["skill_name"] . "'s details" ?></h1>



<form action="/core_php/collab-training/routes.php?route=skills&action=edit&id=<?php echo $edit_data["id"] ?>" method="POST" >

    <div class="mb-3">
    <label for="username">Username:</label>
    <select name="username" id="username" class="form-select" aria-label="Default select example">
        <option value="<?php echo $edit_data["username"] ?>"><?php echo $edit_data["username"] ?></option>
        <?php foreach($users as $user):?>
        <option value="<?php echo$user;?>"><?php echo$user;?></option>
        <?php endforeach;?>
    </select>
    </div>
    <div class="mb-3">
        <label for="skill_name" class="form-label">Skill Name:</label>
        <input type="text" class="form-control" name="skill_name" id="skill_name" value="<?php echo $edit_data["skill_name"] ?>">
    </div> 

    <div class="mb-3">
        <label for="skill_category" class="form-label">Skill Category:</label>
        <input type="text" class="form-control" name="skill_category" id="skill_category" value="<?php echo $edit_data["skill_category"] ?>">
    </div>  

    <div class="mb-3">
        <label for="skill_level">Skill Level:</label>
        <select name="skill_level" id="skill_level" class="form-select" aria-label="Default select example">
            <option value="<?php echo $edit_data["skill_level"] ?>"><?php echo $edit_data["skill_level"] ?></option>
            <?php foreach ($levels as $level): ?>
                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <label for="created_at">Created At:</label>
    <input type="date" id="created_at" name="created_at" value="<?php echo $edit_data["created_at"]; ?>">

    <label for="updated_at">Updated At:</label>
    <input type="date" id="updated_at" name="updated_at" value="<?php echo $edit_data["updated_at"]; ?>">    

    
    <button type="submit" id="update_btn" class="btn btn-success">Update Skill details</button>

</form>