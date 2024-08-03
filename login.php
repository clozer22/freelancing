<?php

@include 'database.php';
session_start();
if(isset($_POST['login'])){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password'];

  $select = "SELECT * FROM tbl_users WHERE email = '$email'";
  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);

      // Verify the password
      if(password_verify($password, $row['password'])){
          if($row['user_type'] == 'Admin'){
              $_SESSION['admin_name'] = $row['lastname'];
              header('location:admin_dash.php');
          }elseif($row['user_type'] == 'User'){
              $_SESSION['user_name'] = $row['lastname'];
              $_SESSION['email'] = $row['email'];
              $_SESSION['user_id'] = $row['id'];

              header('location:user_dash.php');
          }
      } else {
          $error[] = 'Incorrect email or password!';
      }
  } else {
      $error[] = 'Incorrect email or password!';
  }
};



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./cssproj/navbar.css">
    <link rel="stylesheet" href="./cssproj/home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<style>
.password-container {
    position: relative;
    display: inline-block;
    width: 100%;
}
#passwordField {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    border: 1px solid rgb(161, 161, 161);
    outline: none;
  
}
#togglePassword {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: black;
}
</style>
<body style="overflow-y: hidden;">

   <!-- NAVBAR -->
   <nav class="navbar sticky-top navbar-expand-lg" style="background-color: #42b2cf;">
        <div class="logo">
            <img src="./img/logo.png" alt="" width="200px">
        </div>
        <div class="container">
            <a style="opacity: 0; cursor: default; ">Lhenewin Party Solution</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto w-100 justify-content-end">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Products</a>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Services</a>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Contact</a>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #b5246f;" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  <div class="formwarp">
    <div class="login-register">
      <div class="login form">
  <!--LOGIN -->

        <form id="login" class="" action="" method="POST">
          <div class="form-header">
            <div class="logocenter">
              <img src="./img/userlogin.png" alt="" class="logoform">
            </div>
            <h1 style="color:#291947;">LOGIN</h1> <br>
          </div>
          
            
          <div class="form-group">
            <br>
            <label for="username">Email Address:</label>
            <input type="email" name="email" placeholder="Email Address" required>
          </div>
          <label for="username">Password:</label>
          <div class="password-container">
            <input type="password" id="passwordField" name="password" placeholder="Enter your password" required>
            <i id="togglePassword" class="fas fa-eye-slash"></i>
          </div>
          <?php
            if(isset($error))
            {
                foreach($error as $error){
                    echo '<span class="error-msg"><pre style="color:red; font-size:15px; margin: 5px -35px ">'.$error.'</pre></span>';
                };
            };
            ?>
          <p style="text-align: right; margin-top:10px" class="forgot-password"><a href="#">Forgot password?</a></p>

          <div class="form-bottom">
            <p class="not-registered">Dont have an account? <a href="signup.php">Create New Account</a></p>
          </div>
          <hr>

          <button class="btnlogin" type="submit" name="login">Sign In</button>
        </form>
        

  <!--  FORGOT  -->
        <form action="" id="forgot-password" method="POST"> 
          <div class="form-header">
            <div class="logocenter">
              <img src="./img/userlogin.png" alt="" class="logoform">
            </div><br>
            <h1 style="color:#291947;">FORGOT PASSWORD</h1><br>
          </div>       <br>
          <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" id="email" placeholder="Email Address" required>
          </div>
          <div class="form-bottom">
            <p class="already-registered">Already have an account? <a href="#">Login</a></p><br>
          </div>
          <button class="btnlogin"  type="submit" name="forgot">Forgot Password</button>

        </form>
      </div>
      
      
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
<script>
  jQuery(document).ready(function ($) {
  
    $(".forgot-password a").click(function () {
      $("#forgot-password").show();
      $("#register").hide();
      $("#login").hide();
    });
  
    $(".already-registered").click(function () {
      $("#login").show();
      $("#register").hide();
      $("#forgot-password").hide();
    });
  });
</script>

<script>
const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('passwordField');

togglePassword.addEventListener('click', function () {
  // Toggle the type attribute between "password" and "text"
  const type = passwordField.type === 'password' ? 'text' : 'password';
  passwordField.setAttribute('type', type);

  // Toggle the icon class between "fa-eye-slash" and "fa-eye"
  this.classList.toggle('fa-eye-slash');
  this.classList.toggle('fa-eye');
});

</script>