<?php 
    include __DIR__ . "/../../controllers/ProjectController.php";
    $edit_obj=new ProjectController;   
    $edit_data=$edit_obj->view();
?>
<style>
    form{
        display: grid;
        margin: 30px;
    }
    input{
        margin: 10px 0px 10px 0;
    }
    #update_btn{
        margin-top: 10px;
        width: 30%;
        border-radius: 10px;
    }
    button:hover{
        background-color: #4c4f4cff;
        color:white;
    }
</style>

<h1>Edit the <?php echo $edit_data["project_name"]."'s details"?></h1>

<!-- <a href="/core_php/collab-training/controllers/ProjectController.php?id=<?php echo$edit_data["project_id"]?>"></a> -->

<form action="/core_php/collab-training/routes.php?route=project&action=edit&id=<?php echo$edit_data["project_id"]?>" method="POST">
    <label for="project name">Project Name:</label>
    <input type="text" id="project_name" name="project_name" value="<?php echo$edit_data["project_name"]?>">
    <label for="project description">Project Description:</label>
    <input type="text" id="project_description" name="project_description" value="<?php echo$edit_data["description"]?>">
    <label for="start date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo$edit_data["start_date"]?>">
    <label for="end date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo$edit_data["end_date"]?>">
    <label for="status">Project Status:</label>
    <input type="text" id="status" name="status" value="<?php echo$edit_data["status"]?>">
    <button type="submit" id="update_btn">Update Project details</button>

</form>