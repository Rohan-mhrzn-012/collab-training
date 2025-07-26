function deleteUser(id, el) {
    if (confirm("Are you sure you want to delete user ID " + id + "?")) {
        fetch('/../collab-training/controllers/delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + encodeURIComponent(id)
        })
        .then(response => response.text())
        .then(data => {
            alert("Deleted: " + data);
            const row = el.closest('tr');
            if (row) row.remove();
        })
        .catch(error => {
            console.error("Error deleting user:", error);
            alert("Failed to delete user.");
        });
    }
    return false;
}
