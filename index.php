
<?php
@include 'database.php';
//ADD SERVICE
if(isset($_POST['sendmsg']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $messages = $_POST['messages'];

    $query = "INSERT INTO tbl_message(fullname,email,messages) VALUES('$fullname','$email','$messages')";
    $query_runs = mysqli_query($conn, $query);

    if($query_runs)
    {
      header("Location: index.php");
    }
    else
    {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lhenewin Party Solution</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./cssproj/home.css">
    <link rel="stylesheet" href="./cssproj/services.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Aleo:ital@0;1&display=swap" rel="stylesheet">
    <style>
      @font-face {
          font-family: 'myFont';
          src: url(./font/amsterdam-two-ttf.ttf);
      }
      .details h4{
          color: black;
          line-height: 35px;
          font-family: "Aleo", serif;
          color: #291947;
      }
      .details{
          margin: 120px;
          text-align: justify;
      }
      .head_container{
          display: flex;
          justify-content: space-between;
      }
      .head_container h1{
          font-size: 53px;
          color: #291947;
          font-family: 'myFont';
          margin-bottom: 80px;
      }
      .bgpic{
          margin: 65px;
      }
      .image-container {
      position: relative;
      width: 30%; /* Ensures responsiveness */
    }

    .image-container img {
      width: 100%; /* Ensures image fills container */
      height: auto; /* Maintains image aspect ratio */
    }

    .text-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: rgba(0, 0, 0, 0.9); /* Semi-transparent black background */
      color: white; /* Text color */
      padding: 10px; /* Padding for text */
      text-align: center; /* Center align text */
    }
    @media(min-width:768px) {
      .heading {
        width: 85%;
        margin: 10px auto;
        font-size: 20px;
      }
      .heading > h1 {
        line-height: 45px;
      }
      .heading > p {
        line-height: 30px;
      }

    }
    </style>
</head>
<body>

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
                        <a class="nav-link" style="color: #b5246f;" href="index.php">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#package">Packages</a>
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
      
    <!-- HEADER -->
        <div class="head_container">
            <div class="details"><br>
                <h1>Lhenewin Party Solution</h1>
                <h4>Experience Effortless Party Planning with Lhenewin Party Solution’s Innovative Reservation System!</h4><br>
                <h4 style="margin:-2px;">Streamline your party supply bookings, decorations, and equipment effortlessly, making every celebration a breeze for individuals, event organizers, and businesses</h4>
                <br>
                <a href="login.php"  class="btn btn-land btn-xl">Reserve Now!</a>
            </div>
            
            <div class="bgpic">
                <img src="./img/bgpic.png" alt="">
            </div>
        </div>
   
<!-- SERVICE -->
<br id="package">
  <div >
        <div class="heading" >
            <h1>Our Packages</h1>
            <h4 class="lightblack">We help you organize every detail of your event, from finding the perfect venue to sending invitations, Focus on creating a fantastic event for you and your guests. We'll handle the behind-the-scenes work.</>
        </div>
        <ul class="cards">
   
          <li class="cards_item">
            <div class="card">
              <div class="card_image">
                <img class="imgR" src="./img/A.jpg">
              </div>
              <div class="card_content">
               
               <div style="display: flex; justify-content:space-between">
               <h2 class="card_title">PACKAGE PRICE :</h2>
                   <h4 class="card_price">₱ 1500.00</h4>
               </div>      
               <a type="button" class="btnR card_btn" href="login.php" style="text-align:center; text-decoration:none;">BOOK NOW</a>
       
               </div>
            </div>
          </li>
          <li class="cards_item">
            <div class="card">
              <div class="card_image"><img class="imgR" src="./img/B.jpg"></div>
              <div class="card_content">
               
               <div style="display: flex; justify-content:space-between">
               <h2 class="card_title">PACKAGE PRICE :</h2>
                   <h4 class="card_price">₱ 1500.00</h4>
               </div>      
               <a type="button" class="btnR card_btn" href="login.php" style="text-align:center; text-decoration:none;">BOOK NOW</a>
       
               </div>
            </div>
          </li>
          <li class="cards_item">
            <div class="card">
              <div class="card_image"><img class="imgR" src="./img/C.jpg"></div>
              <div class="card_content">
               
               <div style="display: flex; justify-content:space-between">
               <h2 class="card_title">PACKAGE PRICE :</h2>
                   <h4 class="card_price">₱ 1500.00</h4>
               </div>      
               <a type="button" class="btnR card_btn" href="login.php" style="text-align:center; text-decoration:none;">BOOK NOW</a>
       
               </div>
            </div>
          </li>
          <li class="cards_item">
            <div class="card">
              <div class="card_image"><img class="imgR" src="./img/D.jpg"></div>
              <div class="card_content">
               
               <div style="display: flex; justify-content:space-between">
               <h2 class="card_title">PACKAGE PRICE :</h2>
                   <h4 class="card_price">₱ 1500.00</h4>
               </div>      
               <a type="button" class="btnR card_btn" href="login.php" style="text-align:center; text-decoration:none;">BOOK NOW</a>
       
               </div>
            </div>
          </li>
          <li class="cards_item">
            <div class="card">
              <div class="card_image"><img class="imgR" src="./img/E.jpg"></div>
              <div class="card_content">
               
                <div style="display: flex; justify-content:space-between">
                <h2 class="card_title">PACKAGE PRICE :</h2>
                    <h4 class="card_price">₱ 1500.00</h4>
                </div>      
                <a type="button" class="btnR card_btn" href="login.php" style="text-align:center; text-decoration:none;">BOOK NOW</a>
        
                </div>
            </div>
          </li>
          <li class="cards_item">
            <div class="card">
              <div class="card_image"><img class="imgR" src="./img/G.jpg"></div>
              <div class="card_content">
               
               <div style="display: flex; justify-content:space-between">
               <h2 class="card_title">PACKAGE PRICE :</h2>
                   <h4 class="card_price">₱ 1500.00</h4>
               </div>      
               <a type="button" class="btnR card_btn" href="login.php" style="text-align:center; text-decoration:none;">BOOK NOW</a>
       
               </div>
            </div>
          </li>
        </ul>
      </div>

      <div class="heading" id="service">
            <h1>Other Services</h1>
            <h4 class="lightblack">Managing your event, our system offers other helpful tools.  This can include things like face painting, giant show and standee booths.</>
        </div>

        <div style="display: flex; justify-content: space-evenly;">
    <div class="image-container">
      <img src="./img/5.jpg" alt="Image description">
      <div class="text-overlay">
      <h2>Standee Photobooth</h2>
        <p>Standee Photobooth rents booths for parties.  </p>
      </div>
    </div>
    <div class="image-container">
      <img src="./img/1.jpg" alt="Image description">
      <div class="text-overlay">
      <h2>Face Painting</h2>
        <p>Transform faces with fun & safe paint! </p>
      </div>
    </div>
    <div class="image-container">
      <img src="./img/3.jpg" alt="Image description">
      <div class="text-overlay">
        <h2>Giant Bubble Show</h2>
        <p>Entertaining show with giant for kids events.</p>
      </div>
    </div>
  </div>
    


    <!-- CONTACT --> 
    <section class="contactR">
        
        <div class="section-header">
          <div class="container">
            <h2>Contact Us</h2>
            <p ><span style="font-weight:600;">Need event planning assistance?</span> Contact us for a smooth experience.</p>
          </div>
        </div>
        
        <div class="container">
          <div class="row">
            
            <div class="contact-info">
              <div class="contact-info-item">
                <div class="contact-info-icon">
                  <i class="fas fa-home"></i>
                </div>
                
                <div class="contact-info-content">
                  <h4>Address</h4>
                  <p>BIk16 lot13 Langaray St. Dagat Dagatan, Caloocan</p>   
                </div>
              </div>
              
              <div class="contact-info-item">
                <div class="contact-info-icon">
                  <i class="fas fa-phone"></i>
                </div>
                
                <div class="contact-info-content">
                  <h4>Phone</h4>
                  <p>0981-047-6144</p>
                </div>
              </div>
              
              <div class="contact-info-item">
                <div class="contact-info-icon">
                  <i class="fas fa-envelope"></i>
                </div>
                
                <div class="contact-info-content">
                  <h4>Email</h4>
                 <p>lhenewinpartyss@gmail.com</p>
                </div>
              </div>
            </div>
            
            <div class="contact-form">
              <form action="" method="POST" id="validity" enctype="multipart/form-data">
                <h2>Send Message</h2>
                <div class="input-box">
                  <input type="text" required="true" name="fullname" id="fullname" placeholder="Full Name">
                </div>
                
                <div class="input-box">
                  <input type="email" required="true" name="email" id="email" placeholder="Email Address...">
                </div>
                
                <div class="input-box">
                  <textarea required="true" name="messages" id="messages" placeholder="Enter your Message...."></textarea>
                </div>
                
                <div class="input-box">
                  <input type="submit" name="sendmsg" id="submit"  value="Send" name="">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </section>
    <!-- FOOTER -->
    <div style="justify-content: center; text-align: center;">
        <section class="contact-area" id="contact">
       
            <div class="contact-content text-center">
                <div class="hr"></div>
                <h6>Copyright © 2024 Lhenewin All Rights Reserved.</h6>
            </div>
         
        </section>
    </div>    

    <script>
    // ALERT AFTER SUBMIT FORM
      var form = document.getElementById('validity');
      function myFunction() {
        if (form.checkValidity()) {
          alert("Message Successful!");
        }
      }
    </script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>

