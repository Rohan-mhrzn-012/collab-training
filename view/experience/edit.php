<?php
    include_once __DIR__ . "/../../controllers/ExperienceController.php";
    $view= new ExperienceController;
    $data=$view->view();

    $users = ["pradeep", "woodcarver", "programmer", "roshan"];
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
<h2>Edit experience</h2>
<form action="/core_php/collab-training/routes.php?route=experience&action=edit&id=<?php echo$data["id"];?>" method="POST">

    <div class="mb-3">
        <label for="username">Username:</label>
        <select name="username" id="username" class="form-select" aria-label="Default select example">
            <option value=""><?php echo$data["username"]?></option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user ?>"><?php echo $user ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" name="title" id="title" value="<?php echo$data["title"]?>" placeholder="Enter the title of the experience">
    </div>

    <div class="mb-3">
        <label for="organization" class="form-label">Organization:</label>
        <input type="text" class="form-control" name="organization" id="organization" value="<?php echo$data["organization"]?>" placeholder="Enter the name of the organization">
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Location:</label>
        <input type="text" class="form-control" name="location" id="location" value="<?php echo$data["location"]?>" placeholder="Enter the location of the organization">
    </div>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo$data["start_date"]?>">

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo$data["end_date"]?>">

    <button type="submit" id="update_btn" class="btn btn-success">Add new experience details</button>

</form>