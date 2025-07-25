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
</style>

<h1>PROJECTS</h1>
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
        <?php foreach ($projects as $project): ?>
            <tr>
                <td><?php echo $project["project_id"]; ?></td>
                <td><?php echo $project["project_name"]; ?></td>
                <td><?php echo $project["description"]; ?></td>
                <td><?php echo $project["start_date"]; ?></td>
                <td><?php echo $project["end_date"]; ?></td>
                <td><?php echo $project["status"]; ?></td>
                <td><a href="/core_php/collab-training/index.php?page=edit_project&id=<?php echo$project["project_id"]?>">Edit</a>
                <a href="/core_php/collab-training/index.php?page=view_project&id=<?php echo $project["project_id"]?>">View</a>
                <a href="#">Delete</a></td>
            </tr>            
        <?php endforeach ?>
    </tbody>
    <tfoot>

    </tfoot>
</table>

