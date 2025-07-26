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

<table>
    <thead>
        <tr>
            <th>Project_id</th>
            <th>Project Name</th>
            <th>Project Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects["project_data"] as $project): ?>
            <tr>
                <td><?php echo $project["project_id"]; ?></td>
                <td><?php echo $project["project_name"]; ?></td>
                <td><?php echo $project["description"]; ?></td>
                <td><?php echo $project["start_date"]; ?></td>
                <td><?php echo $project["end_date"]; ?></td>
                <td><?php echo $project["status"]; ?></td>
                <td><a href="/core_php/collab-training/index.php?page=edit_project&id=<?php echo $project["project_id"] ?>">Edit</a>
                    <a href="/core_php/collab-training/index.php?page=view_project&id=<?php echo $project["project_id"] ?>">View</a>
                    <a href="/core_php/collab-training/controllers/ProjectController.php?action=delete&project_id=<?php echo $project["project_id"] ?>" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>

    </tfoot>
</table>

<h2>INNER JOIN on projects and users</h2>
<table>
    <thead>
        <tr>
            <th>Project ID</th>
            <th>Project Name</th>
            <th>Full Name</th>
        </tr>

    </thead>
    <tbody>

        <?php foreach ($projects["join_data"] as $project): ?>
            <tr>
                <td><?php echo $project["project_id"]; ?></td>
                <td><?php echo $project["project_name"]; ?></td>
                <td><?php echo $project["fullname"]; ?></td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>