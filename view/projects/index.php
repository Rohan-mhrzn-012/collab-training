<?php include __DIR__ . "/../../controllers/ProjectController.php";
$project_obj = new ProjectController;
$projects = $project_obj->index();

?>

<style>
    h1 {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    table,
    th,
    td {
        border: 2px solid black;
    }

    tr:hover {
        background-color: #837f7fff;
    }

    th {
        background-color: #5a5e5aff;
        color: white;
    }

    table {
        width: 100%;
    }

    th,
    td {
        text-align: center;
    }

    tr:nth-child(even) {
        background-color: #b5adadff;
    }
    #insert{
        border:2px solid black;
        width: 20%;
        text-align: center;
        padding: 5px;
        margin: 5px;
        border-radius: 5px;        
    }
    a{
        text-decoration: none;
        color:#273043;
        
    }
    a:hover{
        color:#9197ae;
    }
    
</style>

<h1>PROJECTS</h1>
<div id="insert">    
    <a href="/core_php/collab-training/index.php?page=create_project&action=create">Insert New Project</a>
</div>

<table class="table">
  <thead class="table-dark">
    <tr>            
            <th>Project Name</th>
            <th>User Name</th>
            <th>Project Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
  </thead>
  <tbody>
    <tbody>
        <?php foreach ($projects["project_data"] as $project): ?>
            <tr>
                
                <td><?php echo $project["project_name"]; ?></td>
                <td><?php echo $project["fullname"]; ?></td>
                <td><?php echo $project["description"]; ?></td>
                <td><?php echo $project["start_date"]; ?></td>
                <td><?php echo $project["end_date"]; ?></td>
                <td><?php echo $project["status"]; ?></td>
                <td>
                    <a class="btn btn-primary btn-sm me-1" href="/core_php/collab-training/index.php?page=edit_project&id=<?php echo $project["project_id"] ?>">Edit</a>
                    <a class="btn btn-info btn-sm me-1" href="/core_php/collab-training/index.php?page=view_project&id=<?php echo $project["project_id"] ?>">View</a>
                    <a class="btn btn-danger btn-sm" href="/core_php/collab-training/routes.php?route=project&action=delete&project_id=<?php echo $project["project_id"] ?>" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
  </tbody>
</table>
