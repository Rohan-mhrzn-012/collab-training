<?php
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
<h2>Add new Skill</h2>
<form action="/core_php/collab-training/routes.php?route=skills&action=create" method="POST">
    <div class="mb-3">
        <label for="skill_name" class="form-label">Skill Name:</label>
        <input type="text" class="form-control" name="skill_name" id="skill_name" value="">
    </div>

    <div class="mb-3">
        <label for="skill_category" class="form-label">Skill Category:</label>
        <input type="text" class="form-control" name="skill_category" id="skill_category" value="">
    </div>

    <div class="mb-3">
        <label for="skill_level">Skill Level:</label>
        <select name="skill_level" id="skill_level" class="form-select" aria-label="Default select example">
            <option value=""></option>
            <?php foreach ($levels as $level): ?>
                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <label for="created_at">Created At:</label>
    <input type="date" id="created_at" name="created_at" value="">

    <label for="updated_at">Updated At:</label>
    <input type="date" id="updated_at" name="updated_at" value="">




    <button type="submit" id="update_btn" class="btn btn-success">Add new Skill details</button>

</form>