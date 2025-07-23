<?php
    include '../database/db.php';

    //user create
    $fullname = $_POST['fullname'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $phoneNumber = $_POST['phone_number'] ?? '';
    $password = $_POST['password'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $agree = isset($_POST['agree']) ? 1 : 0;
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $rawQuery = "INSERT INTO users (fullname, username, email, phone_number, password, gender, agreed_to_terms)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $executionQuery = $connection->prepare($rawQuery);
    //check if there is error
    if (!$executionQuery) {
    die("Prepare failed: " . $connection->error);
}
    $executionQuery->bind_param('ssssssi',  $fullname, $username, $email, $phoneNumber, $passwordHash, $gender, $agree);
    //user create end

    //created user role assigned
    if ($executionQuery->execute()) {
        $user_id = $connection->insert_id;

        $roleRawQuery = "SELECT id FROM roles WHERE name = 'User' LIMIT 1;";
        $roleData = $connection->query($roleRawQuery);

        if ($roleData->num_rows > 0) {
            $roleRow = $roleData->fetch_assoc();
            $role_id = $roleRow['id'];

            $user_role_raw_query = 'INSERT INTO user_roles (user_id, role_id) VALUES(?, ?)';
            $user_role_execution_query = $connection->prepare($user_role_raw_query);

            $user_role_execution_query->bind_param('ii', $user_id, $role_id);
            $user_role_execution_query->execute();

            header('Location: /collab-training/login.php');
            exit;
        } else {
            echo "User Role not found.";
        }
    }
    //created user role assigned END

?>