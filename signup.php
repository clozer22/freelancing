<?php
@include 'database.php';

if(isset($_POST['register'])){
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
  
    $select = " SELECT * FROM tbl_users WHERE email = '$email'";
    $result = mysqli_query($conn, $select);
  
    if(mysqli_num_rows($result) > 0)
    {
       $error[] = 'User Already Exist!';
    }
    else
    {
       if($password != $passwordConfirm)
       {
          $error[] = 'Password Not Matched!';

       }
       else
       {
          $insert = "INSERT INTO tbl_users(user_type, firstname,lastname, email, password) VALUES('$user_type','$firstname','$lastname','$email','$password')";
          mysqli_query($conn, $insert);
          header('location:login.php');
       }
    }
  };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Portal</title>
    <link rel="stylesheet" href="./cssproj/home.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./cssproj/navbar.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
  </head>
<body style="overflow-y: hidden;">
<!-- NAVBAR -->
  <nav class="navbar sticky-top navbar-expand-lg bg-dark">
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
                    <a class="nav-link active" href="index.php">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#product">Products</a>
                <li class="nav-item">
                    <a class="nav-link" href="#service">Services</a>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
  </nav>

  <div class="formwarp">
  <div class="login-register">
    <div class="login form" >

<!-- REGISTER -->
      <form id="" action="" class="" method="POST">
        <div class="form-header" id="">

        <div class="logocenter">
              <img src="./img/userlogin.png" alt="" class="logoform">
          </div>

            <h1 style="color:#291947; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">Create a new account</h1>
          <?php
          if(isset($error))
          {
              foreach($error as $error){
                  echo '<span class="error-msg"><pre style="color:red; font-size:15px; margin-bottom: -10px;" >'.$error.'</pre></span>';
              };
          };
          ?>
        </div>
  
        <div style="display:flex; justify-content:space-between">
          <div class="form-group" >
          <input style="margin-top: -40px; visibility:hidden;"  type="text" name="user_type" value="User" required>
          <label for="firstname">Full Name:</label>
          <input type="text" name="firstname" placeholder="First Name" required>
          </div>

          <div class="form-group" >
          <input style="margin-top: -40px; visibility:hidden;" type="text" >
          <label for="lastname">Last Name:</label>
          <input type="text" name="lastname" placeholder="Last Name" required>
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" name="email" placeholder="Email Address" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <!-- <input type="password" name="password" id="passwordField" placeholder="Password" required> -->
          <div class="password-container">
            <input type="password" id="passwordField" name="password" placeholder="Enter your password" required>
            <i id="togglePassword" class="fas fa-eye-slash"></i>
          </div>
        </div>
        
        <div class="form-group">
          <label for="password">Confirm Password:</label>
          <!-- <input type="password" name="passwordConfirm" id="passwordField" placeholder="Confirm Password" required> -->
          <div class="password-container">
            <input type="password" id="passwordField2" name="passwordConfirm" placeholder="Confirm Password" required>
           
          </div>
        </div>

        <div class="form-bottom">
          <p class="already-registered">Already have an account? <a href="login.php">Login</a></p>
        </div>
        <button class="btnlogin" type="submit" name="register">Sign Up</button>

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

togglePassword.addEventListener('click', function () {
  // Toggle the type attribute between "password" and "text"
  const types = passwordField2.type === 'password' ? 'text' : 'password';
  passwordField2.setAttribute('type', types);

  // Toggle the icon class between "fa-eye-slash" and "fa-eye"
  this.classList.toggle('fa-eye-slash');
  this.classList.toggle('fa-eye');
});
</script>
<script>
  jQuery(document).ready(function ($) {
    $(".not-registered").click(function () {
      $("#register").show();
      $("#login").hide();
    });
  
    $(".forgot-password a").click(function () {
      $("#forgot-password").show();
      $("#register").hide();
      $("#login").hide();
    });
  });
</script>