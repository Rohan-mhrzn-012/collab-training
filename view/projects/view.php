<?php include __DIR__ . "/../../controllers/ProjectController.php";
$project_obj = new ProjectController;
$view_data = $project_obj->view();

?>
<!-- <link href="/public/css/my_style.css" rel="stylesheet"> -->
<style>
    h1 {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    table,
    th,
    td {
        border: 2px solid black;
        width: 70%;
    }

    th {
        background-color: #5a5e5aff;
        color: white;
        width: 30%;
    }

    tr:hover {
        background-color: #565555ff;
    }

    th,
    td {
        text-align: center;
    }

    tr:nth-child(even) {
        background-color: #b5adadff;
    }
</style>

<h2><?php echo $view_data["project_name"] . "'s" ?> Information</h2>

<table class="table">  
  <tbody>
     <tr>
            <th class="table-dark">Project Name</th>
            <td><?php echo $view_data["project_name"] ?> </td>
        </tr>
        <tr>
            <th class="table-dark">Project Description</th>
            <td><?php echo $view_data["description"] ?> </td>
        </tr>
        <tr>
            <th class="table-dark">Start Date</th>
            <td><?php echo $view_data["start_date"] ?> </td>
        </tr>
        <tr>
            <th class="table-dark">End Date</th>
            <td><?php echo $view_data["end_date"] ?> </td>
        </tr>
        <tr>
            <th class="table-dark">Status</th>
            <td><?php echo $view_data["status"] ?> </td>
        </tr>
        <tr>
            <th class="table-dark">Image</th>
            <td> <img src="/core_php/collab-training/public/uploads/project_images/<?php echo $view_data["project_image"]; ?>" alt="Project Image" width="150"></td>
        </tr>
  </tbody>
</table>