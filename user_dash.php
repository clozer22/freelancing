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
    <style>
      @font-face {
          font-family: 'myFont';
          src: url(./font/amsterdam-two-ttf.ttf);
      }
      .hero {
    position: relative;
    height: 600px;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    overflow: hidden;
    margin-bottom: 30px;
    background-image: url('./uploads/partySamplePromoBG.jpg ');
    background-size: cover;
    background-position: center;
}

.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3); /* Optional dark overlay */
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px); /* Safari support */
    z-index: 1;
}
.comp-name {
  font-family: 'myFont';
}
.hero h1, .hero p, .cta-button {
    position: relative;
    z-index: 2;
}
        .cta-button {
            background-color: #e67e22;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
        }
        .serv {
          display: flex;
          justify-content: center;
          flex-wrap: wrap;
        }
        .content-section {
            padding: 40px 20px;
        }

        .content-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .services, .packages, .testimonials, .contact {
            max-width: 1200px;
            margin: 0 auto;
        }
        .services img {
            width: 50%;
            margin: 50px;
            height: auto;
        }
        .testimonials img {
            width: 100%;
            height: auto;
        }
        .services .service, .packages .package {
            display: flex;
            padding: 30px;
            margin: 10px;
            align-items: center;
            transition: 0.3s ease-in-out;
        }
        .service {
          display: flex;
          flex-direction: column;
          width: 270px  ;
        }
        .service:hover {
          box-shadow: 0 0 5px 5px #dbdbdb;
          border-radius: 30px;
        }
        .service:hover img, .service:hover div {
          transform: scale(1.1);
          transition: 0.3s ease-in-out;
          /* margin: 50px; */
        }
        .services , .packages .package div {
            flex: 1;
            padding: 0 10px;
        }
        .testimonials .testimonial {
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
  <!-- NAVBAR -->
<nav class="navbar sticky-top navbar-expand-lg" style="background-color: #42b2cf;">
    <div class="logo">
        <img src="img/logo.png" alt="" width="200px">
    </div>
  <div class="container">
    <a style="opacity: 0; cursor: default; ">Lhenewin Party Solution</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <i class="fas fa-bars"></i>
</button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto w-100 justify-content-end">
     
        <li class="nav-item active">
          <a class="nav-link" style="color: #b5246f;" href="">Welcome - <?php echo $_SESSION['user_name'] ?><span class="sr-only"></span></a>
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
        <li class="nav-item ">
          <a class="nav-link " href="#">Cart</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="./user/user_history.php">History</a>
        </li>

        <li class="nav-item">
        <a href="logout.php" class="nav-link">Logout</a>
        </li> 
     
     
      </ul>
    </div>
  </div>
</nav>

<!-- SERVICE -->

<div class="promo-body h-auto">
    <section class="hero" id="home">
      <h1 style="font-family: 'myFont'; font-size: 5rem; line-height: 100px;margin-bottom: 50px">Lhenewin Party Solution</h1>
        <h1 style="margin-top: 50px">Making Your Parties Unforgettable!</h1>
        <p>Expert Balloon and Party Setup Services</p>
        <a href="#contact" class="cta-button">Reserve Now</a>
    </section>

    <h1 style="text-align: center; margin-top: 100px">Our Services</h1>
    <section class="serv services" id="services">
        
        <div class="service">
            <div style="display: flex; justify-content: center; width: 300px;">
                <img class="promo-images" src="./uploads/paintingPromo.jpg" alt="Balloon Setup">
            </div>
            <div>
                <h3>Face Painting Setup</h3>
                <p>From elegant balloon arches to playful balloon animals, we bring a burst of color to your event.</p>
            </div>
        </div>
        <div class="service">
            <div style="display: flex; justify-content: center; width: 300px;">
                <img src="./uploads/partyMatsPromo.jpg" alt="Party Setup">
            </div>
            <div>
                <h3>Party Setup</h3>
                <p>Custom themes, elegant table settings, and complete venue transformations.</p>
            </div>
        </div>
        <div class="service">
            <div style="display: flex; justify-content: center; width: 300px;">
                <img class="promo-images" src="./uploads/balPromo.jpg" alt="Balloon Setup">
            </div>
            <div>
                <h3>Giant Bubble Show</h3>
                <p>From elegant balloon arches to playful balloon animals, we bring a burst of color to your event.</p>
            </div>
        </div>
        <div class="service">
            <div style="display: flex; justify-content: center; width: 300px;">
                <img src="./uploads/photoPromo.jpg" alt="Party Setup">
            </div>
            <div>
                <h3>Standee Photoboth</h3>
                <p>Custom themes, elegant table settings, and complete venue transformations.</p>
            </div>
        </div>
    </section>

    <section class="content-section packages" id="packages">
        <h2>Packages & Pricing</h2>
        <div class="package">
            <div>
                <h3>Basic Package</h3>
                <p>Includes basic balloon decorations and simple party setups.</p>
                <p>Starting at $200</p>
            </div>
            <div>
                <h3>Premium Package</h3>
                <p>Includes advanced balloon decorations, themed setups, and additional services.</p>
                <p>Starting at $500</p>
            </div>
            <div>
                <h3>Deluxe Package</h3>
                <p>Includes premium balloon decorations, customized setups, and full-service planning.</p>
                <p>Starting at $1000</p>
            </div>
        </div>
    </section>

    <section class="content-section gallery" id="gallery">
        <h2>Gallery</h2>
        <div class="images">
            <img src="gallery1.jpg" alt="Gallery Image 1">
            <img src="gallery2.jpg" alt="Gallery Image 2">
            <img src="gallery3.jpg" alt="Gallery Image 3">
        </div>
    </section>

    <section class="content-section testimonials" id="testimonials">
        <h2>What Our Clients Say</h2>
        <div class="testimonial">
            <p>"PartyMagic made my daughter's birthday a dream come true! The decorations were stunning, and the team was so professional. Highly recommend!" - Jessica S.</p>
        </div>
        <div class="testimonial">
            <p>"Amazing service and beautiful setups! Our anniversary party was a hit thanks to PartyMagic." - Michael T.</p>
        </div>
    </section>
</div>



    <!-- FOOTER -->
    
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