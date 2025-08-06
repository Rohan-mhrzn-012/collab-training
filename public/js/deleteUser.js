$(function() {
    $('#user_table').on('click', '.delete-user', function(e) {
        e.preventDefault();
        const row = $(this).closest('tr');
        if (!confirm('Are you sure you want to delete this user?')) return;//this is for confirm delete yes 

        $.ajax({
            url: '/../collab-training/router.php?action=delete',
            type: 'POST',
            dataType: 'json',
            data: { id: $(this).data('id') },
            success: function(res) {
                if (res.status === 'success') {
                    row.hide();//after deleting the user in table it removes 
                    alert(res.message);
                    console.log("hello");
                } else {
                    alert(res.message || 'Delete failed');
                }
            },error: function(xhr) {
                alert('AJAX error: ' + xhr.statusText);
            }
        });
        
    });
});
