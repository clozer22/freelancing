<?php

@include 'database.php';
session_start();
if(!isset($_SESSION['user_name'])){
  header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lhenewin Event Website</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./cssproj/home.css">
    <link rel="stylesheet" href="./cssproj/services.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   
</head>
<body>
  <!-- NAVBAR -->
<nav class="navbar sticky-top navbar-expand-lg bg-dark">
  <div class="container">
  <a style="opacity: 0; cursor: default; ">Lhenewin Party Solution</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <i class="fas fa-bars"></i>
</button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto w-100 justify-content-end">
     
        <li class="nav-item active">
          <a class="nav-link active" href="">Welcome - <?php echo $_SESSION['user_name'] ?><span class="sr-only"></span></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="./user/userhome.php">Home</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="./user/package.php">Packages</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="./user/diy.php">DIY Package</a>
        </li>

        <li class="nav-item">
        <a href="logout.php" class="nav-link">Logout</a>
        </li> 
     
     
      </ul>
    </div>
  </div>
</nav>

<!-- SERVICE -->




    <!-- FOOTER -->
    
    <!-- <div style="justify-content: center; text-align: center;">
        <section class="contact-area" id="contact">
            <div class="contact-content text-center">
                <div class="hr"></div>
                <h6>Copyright © 2024 Lhenewin All Rights Reserved.</h6>
            </div>
        </section>
    </div>   -->

<!-- OKAY -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script>
      $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script>
</body>
</html>