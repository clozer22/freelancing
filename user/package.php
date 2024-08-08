<?php

@include '../database.php';
session_start();
if (!isset($_SESSION['user_name'])) {
  header('location:login.php');
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
  <link rel="stylesheet" href="../cssproj/services.css">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <style>
    .hide {
      display: none;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar sticky-top navbar-expand-lg" style="background-color: #42b2cf;">
    <div class="container">
      <a style="opacity: 0; cursor: default; ">Lhenewin Party Solution</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto w-100 justify-content-end">

          <li class="nav-item ">
            <a class="nav-link " href="../user_dash.php">Welcome - <?php echo $_SESSION['user_name'] ?><span class="sr-only"></span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="userhome.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" style="color: #b5246f;" href="package.php">Packages</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="diy.php">DIY Package</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="diy_cart.php">Cart</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="user_history.php">History</a>
          </li>

          <li class="nav-item">
            <a href="../logout.php" class="nav-link">Logout</a>
          </li>


        </ul>
      </div>
    </div>
  </nav>

  <!-- SERVICE -->

  <div id="service">
    <div style="padding: 25px 35px;">
      <h1>Packages</h1>
      <h4 class="lightblack">We help you organize every detail of your event, from finding the perfect venue to sending invitations, Focus on creating a fantastic event for you and your guests. We'll handle the behind-the-scenes work.</>

    </div>
    <ul class="cards">
      <?php
      include '../database.php';
      $query = $conn->query("SELECT * FROM imagespack ORDER BY uploaded_on");

    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            $imageURL = '../uploadpack/'.$row["file_name"];
    ?>
        <li class="cards_item">
          <div class="card">
            <div class="card_image">
              <img class="imgR" src="<?php echo $imageURL; ?>">
            </div>
            <div class="card_content">
            <p class="card_text hide"><?php echo $row['Product']; ?></p>
               <div style="display: flex; justify-content:space-between">
               
               <h2 class="card_title">PACKAGE PRICE :</h2>
                   <h4 class="card_price">₱ <?php echo $row['Price']; ?></h4>
               </div>      
               <a type="button" class="btnR card_btn" href="booking_form.php?package=<?php echo $row['id']; ?>" style="text-align:center; text-decoration:none;">BOOK NOW</a>
       
               </div>
          </div>
        </li>
        <?php }
    }?>
      </ul>
     
  </div>




  <div style="justify-content: center; text-align: center;">
    <section class="contact-area" id="contact">
      <div class="contact-content text-center">
        <div class="hr"></div>
        <h6>Copyright © 2024 Lhenewin All Rights Reserved.</h6>
      </div>
    </section>
  </div>

  <!-- OKAY -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
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