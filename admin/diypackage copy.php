
<?php
@include '../database.php';
session_start();
if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}
//ADD DIY Package
if(isset($_POST['savecategory']))
{
    $category = $_POST['category'];
    $price = $_POST['price'];

    $query = "INSERT INTO tbl_category(Category,Price) VALUES('$category','$price')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
      header("Location: ../admin/diypackage.php");
    }
    else
    {
        header("Location: ../admin/diypackage.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../cssproj/home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

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

  .formbold-form-inputs{
    width: 80%;
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
        background-color: #007bff;
        color: white;
        font-weight: bold;
        margin-top: 35px;

      }
      .activeadd:hover{
        color: #c9f8ff;
      }
      .link:hover{
          text-decoration: none;
          color: red;
        }
        :root {
  --pmcolor: #f1f0f9;
  --sdcolor: #fefefe;
  --ttcolor: #2e2e2e;
}

html,
body {
  width: 100%;
  height: 100vh;
  font-family: "Poppins", sans-serif;
  color: var(--ttcolor);
  background-color: var(--pmcolor);
}

a {
  color: inherit;
  text-decoration: none;
}

section {
  width: 90%;
  margin: 2rem auto;
  display: grid;
  gap: 0.75rem;
  grid-template-columns: repeat(auto-fill, minmax(20rem, 1fr));
}

.card {
  width: 100%;
  cursor: default;
  padding: 1.25rem;
  border-radius: 0.25rem;
  background-color: var(--sdcolor);
  transition: transform 0.3s ease-in-out;
}
.card-title {
  text-transform: capitalize;
  margin: 0.75rem 0;
}
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar sticky-top navbar-expand-lg bg-dark">
    <div class="logo">
            <img src="../img/logo.png" alt="" width="200px">
    </div>

    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto w-100 justify-content-end">
        <li class="nav-item active float-left">
            <a class="nav-link" href="message.php"><i class="fas fa-mail-bulk"></i></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="../admin_dash.php">Admin - <?php echo $_SESSION['admin_name'] ?><span class="sr-only"></span></a>
          </li>
          <li class="nav-item ">
          <a class="nav-link" href="../product.php">Products</a>
          </li>
          <li class="nav-item ">
          <a class="nav-link " href="service.php">Services</a>
          </li>
          <li class="nav-item ">
          <a class="nav-link " href="account.php">Accounts</a>
          </li>
          <li class="nav-item ">
          <a class="nav-link active" href="">DIY Package</a>
          </li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">Logout</a>
          </li>  
        </ul>
      </div>
    </div>
  </nav>

<!-- TABLE LIST -->
<div class="container table-responsive"> 
    <h1 class="float-left mtoptitle">DIY Package Lists</h1>

    <a type="button" class="button activeadd float-right" href="#" data-toggle="modal" data-target="#myModal">Add Category</a>
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
</div>



      <section id="myTable">
         <?php
        include '../database.php';

        $sql = "SELECT * FROM tbl_category"; // Change 'your_table' to your actual table name 

        $result = mysqli_query($conn, $sql);

        // Check if any results were found
        if (mysqli_num_rows($result) > 0) {
          // Display search results
          while($row = mysqli_fetch_assoc($result)) {
          
        ?>

        <a href="#">
          <article class="card">
            <div class="card-body">
              <h2 class="card-title"><?php echo $row['Category']; ?></h2>
              <p class="card-text"><?php echo $row['Price']; ?></p>
            </div>
          </article>
        </a>
        
      <?php }
              }?> 
      </section>

 <!-- ADDING MODAL  -->
<div class="container">
<!-- <button id="cust_btn" type="button"  class="btn btn-info btn-lg">Click func</button> -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Add Category</h2>
        </div>

        <form action="" method="POST" id="f" enctype="multipart/form-data">
          <div class="modal-body">
            <label for="" class="formbold-form-label"> Name: </label>
            <input type="text" id="category" name="category" placeholder="Enter Name" class="formbold-form-input" style="margin-bottom: 15px;" required/>
              
            <label for="" class="formbold-form-label"> Price: </label>
            <input type="text" name="price" onkeypress="return isNumber(event)" maxlength="11" id="price" placeholder="Enter Contact Number" class="formbold-form-input" required/>                 
          </div>
        
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-info" name="savecategory" id="savecategory">Submit</button>

            <!-- <button type="submit" name="submit"  id="submit" onclick=" myFunction()" class="btn btn-info">Submit</button> -->
          </div>
        </form>
      </div> 
    </div>
  </div>
</div>

<!-- OKAY -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>         
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

  <!-- <script>
    $(document).on("click","#cust_btn",function(){
    $("#myModal").modal("toggle");
  })
  </script> -->
  
<!-- SEARCH -->
<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable a").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });


// ALERT AFTER SUBMIT FORM
var form = document.getElementById('f');
function myFunction() {
  if (form.checkValidity()) {
    alert("DIY Package Saved Successful!");
  }
  else{
    alert("Failed to Saved DIY Package!");
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


</body>
</html>