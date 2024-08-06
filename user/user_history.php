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
    <link rel="stylesheet" href="../cssproj/navbar.css">
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
    .table tr:hover {
      background-color: #8adaff;
    }
    .info-popup {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  border: 1px solid #ccc;
  padding: 10px;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
  z-index: 1000;
}

.hoverable {
  cursor: pointer;
}

.hoverable:hover {
  background-color: #f1f1f1;
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
            <a class="nav-link" href="userhome.php">Home</a>
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
            <a class="nav-link"  style="color: #b5246f;">History</a>
          </li>

          <li class="nav-item">
          <a href="../logout.php" class="nav-link">Logout</a>
          </li> 
      
      
        </ul>
      </div>
    </div>
  </nav>




<!-- SERVICE -->

<div class="container">
  <h1 class="m-5">History Transaction</h1>
  <table class="table border mt-5">
    <thead class="thead-light">
      <tr>
        <th scope="col"></th>
        <th scope="col">Event Name</th>
        <th scope="col">Celebrant Name</th>
        <th scope="col">Start Time</th>
        <th scope="col">End Time</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT title, celebrant_name, package_price, start_datetime, end_datetime FROM tbl_events_list WHERE user_id = $user_id "; // Replace 'events' with your table name
      $result = mysqli_query($conn, $sql);
      
      if (mysqli_num_rows($result) > 0) {
          echo '<tbody>';
          $rowNumber = 1;
          while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr class="hoverable" data-info="'.$row["package_price"].'">';
              echo '<th scope="row">' . $rowNumber++ . '</th>';
              echo '<td>' . $row["title"] . '</td>';
              echo '<td>' . $row["celebrant_name"] . '</td>';
              echo '<td>' . $row["start_datetime"] . '</td>';
              echo '<td>' . $row["end_datetime"] . '</td>';
              echo '</tr>';
          }
          echo '</tbody>';
      } else {
          echo '<tbody><tr><td colspan="7">No events found</td></tr></tbody>';
      }
    ?>
    </tbody>
  </table>
  <div id="infoPopup" class="info-popup"></div>
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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
  var rows = document.querySelectorAll('.hoverable');
  var popup = document.getElementById('infoPopup');

  rows.forEach(function (row) {
    row.addEventListener('mouseenter', function (event) {
      var info = this.getAttribute('data-info');
      popup.innerHTML = info;
      popup.style.display = 'block';
      var rect = this.getBoundingClientRect();
      popup.style.left = rect.right + 'px';
      popup.style.top = rect.top + window.scrollY + 'px';
    });

    row.addEventListener('mouseleave', function () {
      popup.style.display = 'none';
    });
  });
});

  </script>
</body>
</html>