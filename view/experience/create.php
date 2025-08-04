<?php
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
        <select name="username" id="username" class="form-select" aria-label="Default select example">
            <option value="">Select the username:</option>
            <?php foreach($users as $user):?>
            <option value="<?php echo $user?>"><?php echo $user?></option>
           <?php endforeach;?>
        </select>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" name="title" id="title" value="" placeholder="Enter the title of the experience">
    </div>

    <div class="mb-3">
        <label for="organization" class="form-label">Organization:</label>
        <input type="text" class="form-control" name="organization" id="organization" value="" placeholder="Enter the name of the organization">
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Location:</label>
        <input type="text" class="form-control" name="location" id="location" value="" placeholder="Enter the location of the organization">
    </div>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="">

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="">

    <button type="submit" id="update_btn" class="btn btn-success">Add new experience details</button>

</form>