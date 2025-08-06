<?php
if(session_status() === PHP_SESSION_NONE){
  session_start();
}
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
  <form action="#" method="POST" id="login-form" class="login-container">
    <label for="email">email:</label><br>
    <input type="text" id="email" name="email" placeholder="Please enter your e-mail address"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" placeholder="Please enter the password"><br><br>
    <div class="create_new" style="text-align: center;">
    <a href="/../collab-training/register.php">Create New Account</a></div>
    <br><br>
    <button type="submit">Login</button>
    <p>Don't have an account? Create a new one.</p>
    <a id="new_user" href="register.php">Create a new account</a>
    
  </form>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function () {
      $("#login-form").on('submit', function(e){
        e.preventDefault();
        const formData = $(this).serialize();
        

        $.ajax({
          url: "/collab-training/router.php?route=auth/login",
          type: 'POST',
          data: formData,
          dataType: 'json',
          success: function(response){
            console.log(response);
            
            // check if sucesss true
            // dashboard redirect
             const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
              }
            });
            Toast.fire({
              icon: "success",
              title: 'logged in successfully'
            });
            if (response.success === true) {
              window.location.href = response.redirect_url;
            }
          },
          error: function(response){
            let responseData = JSON.parse(response.responseText);
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
              }
            });
            Toast.fire({
              icon: "error",
              title: responseData.message
            });
          }
        })

      })
    })

  </script>
</body>
</html>
