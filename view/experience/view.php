<?php
include_once __DIR__ . "/../../controllers/ExperienceController.php";
$exp = new ExperienceController();
$data = $exp->view();


?>

<style>
    td{
        width: 70%;
    }
</style>
<h1><?php echo $data['fullname']. "'s information"; ?></h1>
<table class="table  table-bordered ">
    <tr>
        <th class="table-dark">User's Name</th>
        <td><?php echo $data["fullname"]; ?></td>
    </tr>   
    <tr>
        <th class="table-dark">Title</th>
        <td><?php echo $data["title"]; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Organization</th>
        <td><?php echo $data["organization"]; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Location</th>
        <td><?php echo $data["location"]; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Started At</th>
        <td><?php echo $data["start_date"]; ?></td>
    </tr>
    <tr>
        <th class="table-dark">Started At</th>
        <td><?php echo $data["end_date"]; ?></td>
    </tr>

</table>