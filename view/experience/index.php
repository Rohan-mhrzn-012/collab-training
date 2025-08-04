<?php
    include_once __DIR__ ."/../../controllers/ExperienceController.php";
    $exp_obj= new ExperienceController;
   $datas= $exp_obj->index();
    
?>
<style>
    .btn-warning{
        margin:10px;
    }
</style>
<h1>Experience</h1>
<a href="/core_php/collab-training/index.php?page=create-experience" class="btn btn-warning">Insert New Experience</a>

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>User Name</th>
            <th>Title</th>
            <th>Organization</th>
            <th>Location</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>
        </tr>        
    </thead>
    <tbody>
        <?php foreach($datas as $data):?>
        <tr>
            <td><?php echo $data['fullname'];?></td>
            <td><?php echo $data["title"];?></td>
            <td><?php echo $data["organization"];?></td>
            <td><?php echo $data["location"];?></td>
            <td><?php echo $data["start_date"];?></td>
            <td><?php echo $data["end_date"];?></td>
            <td>
                <a href="/core_php/collab-training/index.php?page=view-experience&id=<?php echo$data["id"];?>" class="btn btn-success">View</a>
                <a href="/core_php/collab-training/index.php?page=edit-experience&id=<?php echo$data["id"];?>" class="btn btn-info">Edit</a>
                <a class="btn btn-danger" data-id="<?php echo $data["id"] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>

</table>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $(".btn-danger").click(function () {
            let id = $(this).data("id");
            const row = $(this).closest("tr");

            Swal.fire({
                title: "Are you sure you want to delete this experience?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/core_php/collab-training/routes.php?route=experience&action=delete",
                        type: "POST",
                        data: { exp_id: id },
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
