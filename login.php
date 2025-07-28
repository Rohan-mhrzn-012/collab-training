<?php
  $errors = $_SESSION['error'] ?? null;
  unset($_SESSION['error']);

  $user = $_SESSION['user'] ?? null;
  if ($user) {
    header('Location: /core_php/collab-training/index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="/core_php/collab-training/public/css/login.css">
</head>
<body>
  <h1></h1><?php echo $errors ?></h1>
  <h2>Login</h2>
  <form action="/core_php/collab-training/controllers/AuthController.php?action=login" method="POST" class="login-container">
    <label for="email">email:</label><br>
    <input type="text" id="email" name="email" placeholder="Please enter your e-mail address"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" placeholder="Please enter the password"><br><br>

    <button type="submit">Login</button>
    <p>Don't have an account? Create a new one.</p>
    <a id="new_user" href="register.php">Create a new account</a>
    
  </form>

</body>
</html>
