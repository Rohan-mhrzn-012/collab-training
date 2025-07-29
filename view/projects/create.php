<?php 
    include __DIR__ . "/../../controllers/ProjectController.php";
    include __DIR__ . "/../../controllers/userController.php";
    $create_obj=new UserController;  
    $datas=$create_obj->getAllUsers();
    
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

<h1>Create new Project</h1>

<form action="/core_php/collab-training/routes.php?route=project&action=create" method="POST">
    <label for="project name">Project Name:</label>
    <input type="text" id="project_name" name="project_name" value="" placeholder="Please enter the project name">
    <label for="project description">Project Description:</label>
    <input type="text" id="project_description" name="project_description" value="" placeholder="Enter the project details">
    <label for="start date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="">
    <label for="end date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="">
    <label for="status">Project Status:</label>
    <input type="text" id="status" name="status" value="" placeholder="Enter the project status">
    <select name="username" id="username">
         <option value=""> Select a username </option>
        <?php foreach($datas as $data): ?>
        <option value="<?php echo $data["username"];?>" name=""><?php echo $data["username"];?></option>
        <?php endforeach ?>
    </select>
    <button type="submit" id="update_btn">Add new Project details</button>
</form>