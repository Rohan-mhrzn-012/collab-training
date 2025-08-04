<?php
    include_once __DIR__ ."/../../controllers/SkillController.php";
    $skill = new SkillController();
    $datas=$skill->view();
    
?>

<style>
    td{
        width: 70%;
    }
</style>


<h1><?php echo$datas["skill_name"]."' information";?></h1>
<table class="table  table-bordered ">
    
    <tr>
        <th class="table-dark">Skill Name</th>
        <td><?php echo$datas["skill_name"];?></td>
    </tr>
    <tr>
        <th class="table-dark">Skill Category</th>
        <td><?php echo$datas["skill_category"];?></td>
    </tr>
    <tr>
        <th class="table-dark">Skill Level</th>
        <td><?php echo$datas["skill_level"];?></td>
    </tr>
    <tr>
        <th class="table-dark">Created At</th>
        <td><?php echo$datas["created_at"];?></td>
    </tr>
    <tr>
        <th class="table-dark">Updated At</th>
        <td><?php echo$datas["updated_at"];?></td>
    </tr>
    
</table>