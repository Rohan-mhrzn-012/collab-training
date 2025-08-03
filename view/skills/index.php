<?php
    include_once __DIR__ ."/../../controllers/SkillController.php";
    $skill_obj= new SkillController;
   $datas= $skill_obj->getAllSkills();
    
?>
<style>
    .btn-secondary{
        margin:10px;
    }
</style>
<h1>Skills</h1>
<a href="/core_php/collab-training/index.php?page=create-skill" class="btn btn-secondary">Insert New Skill</a>

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
                <a class="btn btn-danger" data-id="<?php echo $data["id"] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>

</table>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"> </script>

<script>
    $(document).ready(function (){
        $(".btn-danger").click(function (){
            let id =$(this).data("id");
            const row =$(this).closest("tr");           

            if(confirm("Are you sure you want to delete this?")){
                $.ajax({
                    url:"/core_php/collab-training/routes.php?route=skills&action=delete",
                    type:"POST",
                    data: {skill_id:id},
                    success: function(response){
                        let res = JSON.parse(response);
                        if(res.status === "success"){
                            alert("Deletion successful");                           
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
</script>