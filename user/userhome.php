<?php

@include '../database.php';
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../cssproj/home.css">
    <link rel="stylesheet" href="../cssproj/services.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>
      @font-face {
          font-family: 'myFont';
          src: url(../font/amsterdam-two-ttf.ttf);
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
    /*$tablet: only screen and (min-width:64em);
$desktop: only screen and (min-width:90em);
*/


.page-header {
  font-size: 35px;
  line-height: 1.5;
  letter-spacing: -0.025em;
}


.title-name {
  margin-top: 20px;
  margin-bottom: 10px;
  font-size: 24px;
  line-height: 30px;
  font-weight: 700;
}

.month-name {
  margin-top: 10px;
  margin-bottom: 10px;
  font-size: 18px;
  line-height: 24px;
  font-weight: 700;
}


.container {
  width: 90%;
  margin: 0px auto;
}
@media only screen and (min-width: 64em) {
  .container {
    width: 90%;
  }
}

.page-header {
  border-bottom: 1px solid #eceeed;
  font-weight: 900;
  margin: 0;
  padding: 0;
}

.content-column {
  width: 100%;
}
@media only screen and (min-width: 40em) {
  .content-column {
    width: 80%;
  }
}
@media only screen and (min-width: 64em) {
  .content-column {
    max-width: 70%;
    float: left;
  }
}

.ad-column {
  margin-top: -5em;
    width: 400px;
    float: right;
}
.ad{
  padding: 10px;
}
.list-title {
  color: #9f9f9f;
  font-size: 14px;
  text-transform: uppercase;
}

.events-list {
  padding-left: 0px;
  list-style-type: none;
}
.events-list .event-item {
  border-bottom: 1px solid #eceeed;
  margin-bottom: 1em;
}

.day-column {
  max-width: 20%;
  padding-top: 0.15em;
  padding-right: 2em;
  float: left;
}

.month-name {
  margin-top: 0px;
  margin-bottom: 0px;
  text-align: left;
  text-transform: uppercase;
}
@media only screen and (min-width: 40em) {
  .month-name {
    text-align: right;
  }
}

.day-name {
  text-align: right;
  text-transform: uppercase;
  font-size: 70%;
}

.title-column {
  max-width: 80%;
  float: left;
}

.title-name {
  margin-top: 0px;
  margin-bottom: 0px;
}

.event-title,
.event-details{
  margin-bottom: 1em;
}

.event-details-list {
  padding-bottom: 0em;
  padding-left: 1em;
}
.event-details-list .event-details-item:nth-child(3) {
  color: #9f9f9f;
  font-style: italic;
}


.clearfix:after {
  content: "";
  display: table;
  clear: both;
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
        <img src="../img/logo.png" alt="" width="200px">
    </div>
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
          <li class="nav-item active">
            <a class="nav-link" style="color: #b5246f;" href="">Home</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="package.php">Packages</a>
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



 <div class="head_container">
      <div class="details"><br><br>
          <h1>Lhenewin Party Solution</h1>
          <h4>Experience Effortless Party Planning with Lhenewin Party Solution’s Innovative Reservation System!</h4><br>
        <div style="width:500px;">

        <div style="display: flex; justify-content:space-between;">
        <i class="fas fa-home"style="font-size:30px;"></i>
            <p  style="margin-top:7px;">BIk16 lot13 Langaray St. Dagat Dagatan, Caloocan</p>   
          </div><br>

          <div style="display: flex; justify-content:space-between;">
              <i class="fas fa-phone" style="font-size:30px;"></i>  
              <p  style="margin-top:7px;margin-right: auto; margin-left:22px;" >0981-047-6144</p>
            </div><br>

            <div style="display: flex; justify-content:space-between;">
              <i class="fas fa-envelope" style="font-size:30px;"></i>
              <p style="margin-top:7px; margin-right: auto; margin-left:22px;">lhenewinpartyss@gmail.com</p>
            </div>
        </div>
      </div>
      <div class="bgpic">
          <img src="../img/balloon.png" alt="">
      </div>
      
  </div>


<!-- SERVICE -->


 


<div class="container-fluid" style="background-color: #2c2f34; color:white;" >
    <div class="row row-eq-height align-items-center">
        <div class="col-md-6 p-5 raleway">
            <h2 class="text-uppercase">Read The Story Behind </h2>
            <h2 class="text-uppercase">Our Success</h2>
        
        
            <p><span class="text-primary">We provide buy-side, sell-side and market infrastructure firms</span>
                <span>with a full-service offering, including systems integration and technology consulting services, to assist in delivering high performance trading and settlement.</span></p>

            <p>More than 25 years of experience working in the industry has enabled us to build our services and solutions in strategy, consulting, digital, technology and operations that help our clients with their trading projects around the world. Capabilities we leverage.</p>
        </div>

        <div class="col-md-6 raleway">
       
                <div class="col-md">
                    <div class="row">   
                    <div class="col-md-2">
                        <i class="fas fa-user-circle" style="font-size:70px;margin-top:-15px;"></i>
                    </div>              
                        <div class="col" style="margin-left:-25px;">
                            <h5 class="text-primary">Strong Connection.</h5>
                            <p>Transforming distribution and marketing with key capabilities in customer insight and analytics.</p>
                        </div>
                    </div>
                </div><br>

                <div class="col-md">
                    <div class="row">
                    <div class="col-md-2">
                    <i class="fas fa-user-circle" style="font-size:70px;margin-top:-15px;"></i>
                    </div>
                    <div class="col" style="margin-left:-25px;">
                            <h5 class="text-primary">Strong Connection.</h5>
                            <p>Transforming distribution and marketing with key capabilities in customer insight and analytics.</p>
                        </div>
                    </div>
                </div><br>

                <div class="col">
                    <div class="row">
                    <div class="col-md-2">
                        <i class="fas fa-user-circle" style="font-size:70px;margin-top:-15px;"></i>
                    </div>
                    <div class="col" style="margin-left:-25px;">
                            <h5 class="text-primary">Strong Connection.</h5>
                            <p>Transforming distribution and marketing with key capabilities in customer insight and analytics.</p>
                        </div>
                    </div>
                </div>
                
        </div>
       
        </div>
</div>








  <div style="margin:50px 100px;">
    <div class="content-header">
      <h1 class="page-header">Upcoming Events</h1><br>
    </div>
    <div class="content-column">
      <div class="events-listings">
        <ul class="events-list">
          <li class="event-item clearfix">
            <div class="day-column">
              <h4 class="month-name">Aug 5</h4>
              <p class="day-name">wednesday</p>
            </div>
            <div class="title-column">
              <div class="event-title">
                <h3 class="title-name">Gratiot Lake Road and Troy Graham to perform at Trust Fall Records</h3>
              </div>
              <div class="event-details">
                <ul class="event-details-list">
                  <li class="event-details-item">
                    <div>The Sinclair, Reed City</div>
                  </li>
                  <li class="event-details-item">
                    <div>8:00 AM</div>
                  </li>
                </ul>
              </div>
     
              </div>
            </div>
          </li>

          <li class="event-item clearfix">
            <div class="day-column">
              <h4 class="month-name">Aug 5</h4>
              <p class="day-name">wednesday</p>
            </div>
            <div class="title-column">
              <div class="event-title">
                <h3 class="title-name">Lake Hewlitt Annual Classical Music Festival</h3>
              </div>
              <div class="event-details">
                <ul class="event-details-list">
                  <li class="event-details-item">
                    <div>Lake Hewlitt Center, Hewlitt</div>
                  </li>
                  <li class="event-details-item">
                    <div>5:00 PM</div>
                  </li>
                </ul>
              </div>
             
              </div>
    </div>
     
  </div>
  
    <div class="ad-column">
      <img class="ad" src="../img/5.jpg" width="300" height="150"><br>
      <img class="ad" src="../img/6.jpg"  width="300" height="150">
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