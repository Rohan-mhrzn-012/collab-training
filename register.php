<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register Form</title>
</head>
<link rel="stylesheet" href="./public/css/style.css">

<body>
  <div class="wrapper">
    <div class="container">
      <div class="sub-container">
        <div class="banner-container">
          <img src="./public/images/lavender.jpg" alt="">
        </div>
        <div class="form-container">
          <div id="heading">
            <h2>User Regsitration</h2>
            <div class="errors">
            </div>
          </div>

          <form action="/collab-training/router.php?route=auth/register" method="POST" id="register-form" enctype='multipart/form-data'>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" class="form-control"
                  placeholder="Enter your full name">
                <span class="error-section" hidden></span>
              </div>

              <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input type="username" id="username" name="username" class="form-control"
                  placeholder="Enter your username">
                <span class="error-section" hidden></span>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address">
                <span class="error-section" hidden></span>
              </div>

              <div class="form-group">
                <label class="form-label" for="phone-number">Phone Number</label>
                <input type="text" id="phone-number" name="phone_number" class="form-control"
                  placeholder="Enter your phone number">
                <span class="error-section" hidden></span>
              </div>

            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control"
                  placeholder="Enter your password">
                <span class="error-section" hidden></span>
              </div>

              <div class="form-group">
                <label class="form-label" for="confirm">Confirm Password</label>
                <input type="password" id="confirm" name="confirm" class="form-control"
                  placeholder="Re-enter your password">
                <span class="error-section" hidden></span>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="gender">Gender</label>
                <select id="gender" name="gender" class="form-control">
                  <option value="">Select your gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
                <span class="error-section" hidden></span>
              </div>
              <div class="form-group">
                <label class="form-label" for="profile_picture">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture" class="form-control" accept="image/*">
                <span class="error-section" hidden></span>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <input type="checkbox" name="agree" id="terms-and-conditions" class="checkbox-control">
                I agree to the terms and conditions
                <span class="error-section" hidden></span>
              </div>
            </div>


            <div class="button form-group">
              <button type="submit" id="my_button">Register</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="./public/js/validateform.js" type="module"></script>
</body>

</html>