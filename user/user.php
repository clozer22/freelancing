<?php

@include '../database.php';
session_start();
if(!isset($_SESSION['user_name'],$_SESSION['user_email'])){
  header('location:login.php');
}
//UPDATE ACCC
if(isset($_POST['submit']))
{
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $query1 = "UPDATE tbl_users SET contact = '$phone', home = '$address' WHERE email = '$email'";
    $query_run1 = mysqli_query($conn,$query1);
    if($query_run)
    {
      header("Location: ../user/user.php");
    }
    else
    {
        header("Location: ../user/user.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lhenewin Event Website</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../cssproj/home.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>

        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: "Inter", Arial, Helvetica, sans-serif;
  }
  /* .hide{display:none} */
  .formbold-mb-5 {
    margin-bottom: 6px;
  }
  .formbold-pt-3 {
    padding-top: 12px;
  }
  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
  }

  .formbold-form-wrapper {
    margin: -29px auto;
    max-width: 500px;
    width: 100%;
    height: 500px;
    background: #212529;
    border: 1px solid black;
    padding: 40px;
    border-radius: 25px;  
    padding-bottom: 10px;
  }
  .formbold-form-label {
    display: block;
    font-weight: bold;
    font-size: 16px;
    color: white;
    margin-bottom: 12px;
  }
  .formbold-form-label-2 {
    font-weight: 600;
    font-size: 20px;
    margin-bottom: 20px;
  }

  .formbold-form-input {
    width: 100%;
    padding: 12px 24px;
    border-radius: 6px;
    border: 1px solid #e0e0e0;
    background: white;
    font-weight: 500;
    font-size: 16px;
    color: #6b7280;
    outline: none;
    resize: none;
  }
  .formbold-form-input:focus {
    border-color: #fd5f32;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-btn {
    text-align: center;
    font-size: 16px;
    border-radius: 6px;
    padding: 12px 11px;
    border: none;
    font-weight: 600;
    background-color: #fd5f32;
    color: white;
    width: 50%;
    margin: 22px 113px;
    cursor: pointer;
  }
  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(253,95,50, 0.05);
  }

  .formbold--mx-3 {
    margin-left: -12px;
    margin-right: -12px;
  }
  .formbold-px-3 {
    padding-left: 12px;
    padding-right: 12px;
  }
  .flex {
    display: flex;
  }
  .flex-wrap {
    flex-wrap: wrap;
  }
  .w-full {
    width: 100%;
  }
  @media (min-width: 540px) {
    .sm\:w-half {
      width: 50%;
    }
  }

    </style>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar sticky-top navbar-expand-lg bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="../logo.png" width="40px" height="40px">Lhenewin Event</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <i class="fas fa-bars"></i>
</button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto w-100 justify-content-end">
      <li class="nav-item">
            <a class="nav-link" href="order.php"><i class="fas fa-shopping-cart">     </i>  Orders</a></li>
        <li class="nav-item active">
        <a class="nav-link active" href="../user_dash.php">Customer - <?php echo $_SESSION['user_name'] ?><span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
        <a href="appointment.php" class="nav-link">Appointment</a>
        </li> 
        <li class="nav-item">
        <a href="../logout.php" class="nav-link">Logout</a>
        </li>  
        <li class="nav-item">
        <a href="" class="nav-link active" style="margin-right:-45px;"><i class="fas fa-user-circle" style="font-size:30px;"></i></a>
        </li> 
      </ul>
    </div>
  </div>
</nav>
<?php
  $sql = "SELECT * FROM tbl_users WHERE email = '" . $_SESSION['user_email'] ."'";
  $resultAll = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_assoc($resultAll);
?>
<div class="formbold-main-wrapper">
  <div class="formbold-form-wrapper">
    <form action="" method="POST" id="f" enctype="multipart/form-data">
  
        <div class="formbold-mb-5">
            <label for="fullname" class="formbold-form-label"> Full Name: </label>
            <input readonly type="text" name="fullname" value="<?php echo $_SESSION['user_name'] ?>" id="fullname" placeholder="Enter Full Name" class="formbold-form-input" required/>
        </div>

        <div class="formbold-mb-5">
            <label for="email" class="formbold-form-label"> Email Address: </label>
            <input readonly type="email" name="email" id="email" value="<?php echo $_SESSION['user_email'] ?>" placeholder="Enter Email Address" class="formbold-form-input" required/>
        </div>

        <div class="formbold-mb-5">
            <label for="phone" class="formbold-form-label"> Phone Number: </label>
            <input type="text" maxlength="11" name="phone" onkeypress="return isNumber(event)" value="<?php echo $rows['contact'] ?>" id="phone" placeholder="Enter your phone number" class="formbold-form-input" required/>
        </div>

        <div class="formbold-mb-5">
            <label for="address" class="formbold-form-label"> Address: </label>
            <input type="text" name="address" id="address" value="<?php echo $rows['home'] ?>" placeholder="Enter your Address" class="formbold-form-input" required/>
        </div>

        <div class="formbold-mb-5">
            <button type="submit" name="submit" onclick="myFunction()" id="btnsubmit" class="formbold-btn">Submit Appointment</button>
        </div>
    
    </form>
  </div>
</div>

<!-- OKAY -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 
</body>
</html>
<script>
// ALERT AFTER SUBMIT FORM
var form = document.getElementById('f');

function myFunction() {
  if (form.checkValidity()) {
    alert("Saved Information Successful!");
  }
}

// ONLY NUMBERS ALLOWED
function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
  return true;
}

</script>
