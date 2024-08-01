<?php

@include 'database.php';
session_start();
if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./cssproj/home.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
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
      /* END SECTION */

    </style>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar sticky-top navbar-expand-lg bg-dark">
    <div class="logo">
        <img src="./img/logo.png" alt="" width="200px">
    </div>
           
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto w-100 justify-content-end">
        <li class="nav-item active float-left">
            <a class="nav-link" href="./admin/message.php"><i class="fas fa-mail-bulk"></i></a>
          </li>
        <li class="nav-item active float-left">
            <a class="nav-link active" href="./admin_dash.php">Admin - <?php echo $_SESSION['admin_name'] ?><span class="sr-only"></span></a>
          </li>
          <li class="nav-item active">
              <a class="nav-link" href="product.php">Manage</a>
          </li>

          <li class="nav-item">
            <a href="logout.php" class="nav-link">Logout</a>
          </li>  
        </ul>
      </div>
    </div>
  </nav>

<div id="container">
  <h2 style="text-align:center; margin-top:35px;">LHENEWIN EVENT CALENDAR  </h2>
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

</div>

    <div style="justify-content: center; text-align: center;">
        <section class="contact-area" id="contact">
            <div class="contact-content text-center">
                <div class="hr"></div>
                <h6>Copyright © 2024 Lhenewin All Rights Reserved.</h6>
            </div>
        </section>
    </div>  

=  <!-- <script>
    $(document).on("click","#cust_btn",function(){
    $("#myModal").modal("toggle");
  })
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
    select: function(start, end) {
      $('#eventModal').modal('show');
      $('#eventStart').val(moment(start).format('YYYY-MM-DDTHH:mm'));
      $('#eventEnd').val(moment(end).format('YYYY-MM-DDTHH:mm'));
    },
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
