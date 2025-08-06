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
        
        width: 20%;
        
        padding: 5px;
        margin: 5px;
                
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
    <a class="btn btn-dark" 
     href="/core_php/collab-training/index.php?page=create_project&action=create">Insert New Project</a>
</div>



<table class="table table-hover table-striped">
  <thead class="table-dark ">
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
                    <a class="btn btn-danger btn-sm" data-id="<?php echo $project["project_id"] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
  </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <script>
    $(document).ready(function (){
        $(".btn-danger").click(function (){
            let id =$(this).data("id");
            const row =$(this).closest("tr");
            // console.log($(this),row.hide());

            if(confirm("Are you sure you want to delete this?")){
                $.ajax({
                    url:"/core_php/collab-training/routes.php?route=project&action=delete",
                    type:"POST",
                    data: {project_id:id},
                    success: function(response){
                        let res = JSON.parse(response);
                        if(res.status === "success"){
                            alert("Deletion successful");
                            // location.reload();
                            row.hide();
                        }
                        else{
                            alert("Deletion failed"+ res.message);
                        }
                    }
                });
            }
        });

    });
</script> -->


<script>
    $(document).ready(function () {
        $(".btn-danger").click(function () {
            let id = $(this).data("id");
            const row = $(this).closest("tr");

            Swal.fire({
                title: "Are you sure you want to delete this project?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/core_php/collab-training/routes.php?route=project&action=delete",
                        type: "POST",
                        data: { project_id: id },
                        success: function (response) {
                            let res = JSON.parse(response);
                            if (res.status === "success") {
                                Swal.fire(
                                    "Deleted!",
                                    "Deletion successful.",
                                    "success"
                                );
                                row.hide();
                            } else {
                                Swal.fire(
                                    "Error!",
                                    "Deletion failed: " + res.message,
                                    "error"
                                );
                            }
                        }
                    });
                }
            });
        });
    });
</script>