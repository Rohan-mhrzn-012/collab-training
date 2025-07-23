<?php
  $errors = $_SESSION['error'] ?? null;
  unset($_SESSION['error']);

  $user = $_SESSION['user'] ?? null;
  if ($user) {
    header('Location: /collab-training/index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="./public/css/login.css">
</head>
<body>
  <h1></h1><?php echo $errors ?></h1>
  <h2>Login</h2>
  <form action="/collab-training/controllers/AuthController.php?action=login" method="POST" class="login-container">
    <label for="email">email:</label><br>
    <input type="text" id="email" name="email"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>

    <button type="submit">Login</button>
  </form>
</body>
</html>
