<?php include __DIR__ . "/../../controllers/ProjectController.php";
$project_obj = new ProjectController;
$view_data=$project_obj->view();

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
    tr:hover{
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

<h2><?php echo $view_data["project_name"]."'s"?> Information</h2>

<table>
    
    <tbody>
        <tr>
            <th>Project Name</th>
            <td><?php echo $view_data["project_name"]?> </td>
        </tr>
         <tr>
            <th>Project Description</th>
            <td><?php echo $view_data["description"]?> </td>
        </tr>
         <tr>
            <th>Start Date</th>
            <td><?php echo $view_data["start_date"]?> </td>
        </tr>
        <tr>
            <th>End Date</th>
            <td><?php echo $view_data["end_date"]?> </td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo $view_data["status"]?> </td>
        </tr>
    </tbody>
</table>