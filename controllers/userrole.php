<?php

require_once __DIR__ . '/../database/db.php'; 

$query = "
    SELECT 
        users.id,
        users.fullname,
        users.email,
        GROUP_CONCAT(DISTINCT roles.name ORDER BY roles.name SEPARATOR ', ') AS user_roles
    FROM users
    LEFT JOIN user_roles ON users.id = user_roles.user_id
    LEFT JOIN roles ON roles.id = user_roles.role_id
    GROUP BY users.id, users.fullname, users.email
";

$result = $connection->query($query);

$allUsers = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['user_roles'] = $row['user_roles'] ? explode(', ', $row['user_roles']) : [];
        $allUsers[] = $row;
    }
}
?>
