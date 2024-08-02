<?php

include '../database.php';
session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
    exit(); // Ensure the script stops after redirection
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// UPDATE PRODUCTS
if(isset($_POST['UpdateProd'])){

    $ProdName = $conn->real_escape_string($_POST['ProdName']);
    $ProdPrice = $conn->real_escape_string($_POST['ProdPrice']);
    $ProdDesc = $conn->real_escape_string($_POST['ProdDesc']);

    // Prepared statement for security
    $stmt = $conn->prepare("UPDATE `images` SET `Product`=?, `Price`=?, `Description`=? WHERE id=?");
    $stmt->bind_param("sssi", $ProdName, $ProdPrice, $ProdDesc, $id);

    if($stmt->execute()){
        header("Location: ../diypackage.php"); 
        exit(); // Ensure the script stops after redirection
    } else {
        echo "Failed: " . $stmt->error;
    }
    $stmt->close();
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
    padding: 64px;
  }

  .formbold-form-wrapper {
    margin: -29px auto;
    max-width: 564px;
    width: 100%;
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
    margin-bottom: 10px;
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
    color: black;
    resize: none;
  }

  .formbold-btn {
    text-align: center;
    font-size: 16px;
    border-radius: 6px;
    padding: 12px 15px;
    border: none;
    font-weight: 600;
    background-color: #17a2b8;
    color: white;
    width: 40%;
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
            <a class="nav-link" href="../admin/message.php"><i class="fas fa-mail-bulk"></i></a>
          </li>
        <li class="nav-item  float-left">
            <a class="nav-link" href="../admin_dash.php">Admin - <?php echo $_SESSION['admin_name'] ?><span class="sr-only"></span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link active" href="../product.php">Package</a>
          </li>
          <!-- <li class="nav-item ">
          <a class="nav-link " href="../admin/service.php">Services</a> -->

          </li>
          <li class="nav-item ">
          <a class="nav-link " href="../admin/account.php">Accounts</a>
          </li>
          </li> 
          <li class="nav-item ">
          <a class="nav-link " href="../diypackage.php">DIY Package</a>
          </li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">Logout</a>
          </li>  
        </ul>
      </div>
    </div>
  </nav>
  <?php
      $sql = "SELECT * FROM `images` WHERE id = $id LIMIT 1";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
    ?>
<div class="formbold-main-wrapper">
  
    <form action="" method="POST" id="f" enctype="multipart/form-data">
      <h2 >Edit Package</h2>

      
      <div class="formbold-mb-5">
        <label for="address" class="formbold-form-label"> Package Name: </label>
        <input type="text" value="<?php echo $row['Product']; ?>" name="ProdName" id="" placeholder="Enter Product Name" class="formbold-form-input" required/>
      </div><br>

      <div class="formbold-mb-5">
          <label for="req" class="formbold-form-label"> Package Price: </label>
          <input type="text" value="<?php echo $row['Price']; ?>" onkeypress="return isNumber(event)" name="ProdPrice" id="" placeholder="Enter Product Price" class="formbold-form-input" required/>
        </div><br>
    
      <div class="formbold-mb-5">
        <label for="" class="formbold-form-label"> Package Description: </label>
        <textarea name="ProdDesc" id="" cols="54" rows="3" style="padding:15px;"><?php echo $row['Description']; ?></textarea>      
      </div>
        <div class="formbold-mb-5">
          <button type="submit" name="UpdateProd" onclick="myFunction()" id="UpdateProd" class="formbold-btn">Update Product</button>
        </div>
   
    </form>
  </div>
</div>
 

<!-- OKAY -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>         
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>

// ALERT AFTER SUBMIT FORM
var form = document.getElementById('f');
function myFunction() {
  if (form.checkValidity()) {
    alert("Update Successfully!");
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