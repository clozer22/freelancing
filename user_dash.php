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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
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
            padding: 20px 20px;
            border-radius: 20px;
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
        .testimonials  {
          width: 100%;
          box-shadow: 1px 2px 3px 1px #e0e0e0;
          margin-bottom: 2opx;
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
        .package {
          display: flex;
          gap: 1rem;
        }
        .package div {
          background-color: #c7edff;
          width: 300px;
          height: 200px;
          padding: 13px;
        }
        .testimonials .testimonial {
            margin-bottom: 20px;
            text-align: center;
        }
        #carouselExampleControls {
          width: 80%; 
          height: 500px; 
          margin: 0 auto;
          overflow: hidden;
        }
        #carouselExampleControls .carousel-inner img {
          width: 100%;
          height: 100%;
          object-fit: cover; 
        }

        .th_dark{
          background-color: rgb(52,58,64);
          color: white;
          font-weight: bold;
          text-transform: uppercase;
        }
        .add{
          background-color: #131418;
          color: #c9c9c9;
        }
        td{
          cursor: pointer;
          font-size: 14px;
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
      .heads {
        position: relative;
        min-height: auto;
        text-align: center;
        color: #fff;
        width: 100%;
        background-color: #c9c9c9;
        background-image: url('./img/bg.jpg');
        background-position: center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;         
      }
      .buttons{
        margin: 24px 30px;
      }
      .button{
        display: inline-block;
        background: #ff7d3c;
        margin: 0 10px;
        padding: 10px 32px;
        border-radius: 4px;
        color: black;;
        text-decoration: none;
      }
      a:hover{
        color: black;
        text-decoration: none;
      }
      .actives{
        background-color: #131418;
        color: #ff7d3c;
      }
      .actives:hover{
        color: #ff7d3c;
      }
      .activeadd{
        background-color: #343a40;
        color: white;
        font-weight: bold;
        margin-top: 35px;
      }
      .activeadd:hover{
        color: #ff7d3c;
      }
      .link:hover{
          text-decoration: none;
          color: red;
        }
        .links:hover{
          text-decoration: none;
          color: green;
        }
      
      @media(min-width:768px) {
        .heads {
            min-height: 70%;
        }
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
        .container1 {
          flex-wrap: wrap;
          display: flex;
          justify-content: space-evenly;
          padding: 1%;  
        }
        .info {
          text-align: start;
          line-height: 30px;
          letter-spacing: 1px;
          width: 28%;
          box-shadow: 0 1px 1px 0 rgb(10 16 34 / 20%);
          font-family: "Raleway", sans-serif;
          background-color: #131418;
        }
        .heads .header-content {
            position: absolute;
            top: 50%;
            padding: 0 50px;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        .heads .header-content .inner {
            margin-right: auto;
            margin-left: auto;
            max-width: 1000px;
        }
        .heads .header-content .inner h1 {
            font-size: 53px;
            color: black;
            background-color: white;
            border: 2px solid black;
            border-radius: 25px;
        }
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
          <a class="nav-link " href="./user/diy_cart.php">Cart</a>
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
                <h3>Package 1</h3>
                <p>Includes basic balloon decorations and simple party setups.</p>
                <p>Starting at $200</p>
            </div>
            <div>
                <h3>Package 2</h3>
                <p>Includes advanced balloon decorations, themed setups, and additional services.</p>
                <p>Starting at $500</p>
            </div>
            <div>
                <h3>Package 3</h3>
                <p>Includes premium balloon decorations, customized setups, and full-service planning.</p>
                <p>Starting at $1000</p>
            </div>
        </div>
    </section>

    <section class="content-section gallery" id="gallery">
        <h2>Gallery</h2>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="./uploads/bday.jpeg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="./uploads/bday.jpeg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="./uploads/bday.jpeg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </section>

    <section class="content-section testimonials" id="testimonials">
    <div id="container">
      <h2 style="text-align:center; margin-top:35px;">Lhenewin Event Schedule</h2>
      <p  style="text-align:center; margin-top:35px;">Check for Available date for your event</p>
        <div class="container">
          <div id="calendar"></div>
        </div>

        <!-- MODAL -->
        <div id="eventModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eventModalLabel">Add Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="eventForm">
              <div class="form-group">
                <label for="eventTitle">Event Title</label>
                <input type="text" class="form-control" id="eventTitle" required>
              </div>
              <div class="form-group">
                <label for="eventStart">Start Time</label>
                <input type="datetime-local" class="form-control" id="eventStart" required>
              </div>
              <div class="form-group">
                <label for="eventEnd">End Time</label>
                <input type="datetime-local" class="form-control" id="eventEnd" required>
              </div>
              <div class="form-group">
                <label for="eventColor">Event Color</label>
                <input type="color" class="form-control" id="eventColor" required>
              </div>
              <div class="form-group">
                <label for="eventTextColor">Text Color</label>
                <input type="color" class="form-control" id="eventTextColor" required>
              </div>
              <button type="submit" class="btn btn-primary">Add Event</button>
            </form>
          </div>
        </div>
      </div>
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- <script>
      $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script> -->
</body>
</html>
<script>
$(document).ready(function(){
  // Fetch and display events from the database
  function fetchEvents() {
    $.ajax({
      url: 'fetch_events.php',
      method: 'GET',
      dataType: 'json',
      success: function(events) {
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('addEventSource', events);
      },
      error: function(error) {
        console.log("Error fetching events:", error);
      }
    });
  }

  $('#calendar').fullCalendar({
    selectable: true,
    selectHelper: true,
    header: {
      left: 'month, list',
      center: 'title',
      right: 'prev, today, next'
    },
    buttonText: {
      month: 'Month',
      list: 'List',
    },
    // select: function(start, end) {
    //   $('#eventModal').modal('show');
    //   $('#eventStart').val(moment(start).format('YYYY-MM-DDTHH:mm'));
    //   $('#eventEnd').val(moment(end).format('YYYY-MM-DDTHH:mm'));
    // },
    events: fetchEvents()
  });

  $('#eventForm').on('submit', function(event) {
    event.preventDefault();
    
    var title = $('#eventTitle').val();
    var start = $('#eventStart').val();
    var end = $('#eventEnd').val();
    var color = $('#eventColor').val();
    var textColor = $('#eventTextColor').val();

    $.ajax({
      url: 'add_event.php',
      method: 'POST',
      data: {
        title: title,
        start: start,
        end: end,
        color: color,
        textColor: textColor
      },
      dataType: 'json',
      success: function(response) {
        if(response.status == 'success') {
          fetchEvents();
        } else {
          alert('Failed to add event.');
        }
      },
      error: function(error) {
        console.log("Error adding event:", error);
      }
    });

    $('#eventModal').modal('hide');
    $('#eventForm')[0].reset();
  });

  fetchEvents(); // Initial fetch of events
});
</script>