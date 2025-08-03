<?php
    include_once __DIR__ ."/../../controllers/SkillController.php";
    $skill_obj= new SkillController;
   $datas= $skill_obj->getAllSkills();
    
?>
<h1>Skills</h1>

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>Skill Name</th>
            <th>Skill Category</th>
            <th>Skill Level</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>        
    </thead>
    <tbody>
        <?php foreach($datas as $data):?>
        <tr>
            <td><?php echo $data["skill_name"];?></td>
            <td><?php echo $data["skill_category"];?></td>
            <td><?php echo $data["skill_level"];?></td>
            <td><?php echo $data["created_at"];?></td>
            <td><?php echo $data["updated_at"];?></td>
            <td>
                <a href="/core_php/collab-training/index.php?page=view-skill&id=<?php echo$data["id"];?>" class="btn btn-success">View</a>
                <a href="/core_php/collab-training/index.php?page=edit-skill&id=<?php echo$data["id"];?>" class="btn btn-info">Edit</a>
                <a href="" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>

</table>