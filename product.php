<?php
include_once 'uploadpack.php';
?>
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
    <title>Package Management</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="cssproj/home.css">
    <link rel="stylesheet" href="cssproj/services.css">
   
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
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
        .dt-length{
          display: none;opacity: 0;
        }
        .dt-search{
          opacity: 0;
        }
        .dt-info{
          margin-top: 15px;
        }
        .dt-paging{
          margin-top: 15px;
        }
        .dt-container{
          padding-bottom:35px ;
        }
        .lbl{
          margin-top: 15px;
        }
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
        <li class="nav-item  float-left">
            <a class="nav-link" href="./admin_dash.php">Admin - <?php echo $_SESSION['admin_name'] ?><span class="sr-only"></span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link active" href="product.php">Package</a>
          </li>
          <!-- <li class="nav-item ">
          <a class="nav-link " href="admin/service.php">Services</a>

          </li> -->
          <li class="nav-item ">
          <a class="nav-link " href="admin/account.php">Accounts</a>
          </li>
          </li>
          <li class="nav-item ">
          <a class="nav-link " href="diypackage.php">DIY Package</a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">Logout</a>
          </li>  
        </ul>
      </div>
    </div>
  </nav>
  <!-- TABLE LIST -->
<div class="container table-responsive table">  
    <h1 class="float-left mtoptitle" >Package Lists</h1>
    
    <a type="button" class="button btn-primary activeadd float-right" href="#" data-toggle="modal" data-target="#myModal">Add</a>
    <input class="form-control" id="myInput" type="text" placeholder="Search Package Name / Price..">
   
        <table id="example" class="table table-bordered box" style="width:100%">
        <thead style="background:#8ac3ff; color:black;">
            <tr>
                <th>Image</th>
                <th>Package</th>
                <th>Price</th>
                <th>Edit </th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="myTable">
           
        <?php
        include 'database.php';
        $query = $conn->query("SELECT * FROM imagespack ORDER BY uploaded_on DESC");

        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $imageURL = 'uploadpack/'.$row["file_name"];
        ?>
          <tr>
              <td >
              <img src="<?php echo $imageURL; ?>" alt="" width="100px" height="50px" />
              </td>
              <td width="850px"><?php echo $row['Product']; ?></td>   
              <td ><?php echo $row['Price']; ?></td>   
              <td><a style="color: green;" class="link" href="action/edit_pack.php?id=<?php echo $row['id'];?>">EDIT</a></td>        
              <td><a style="color: red;" class="link" href="action/del_pack.php?id=<?php echo $row['id'];?>">DELETE</a></td>        
 
          </tr>
          <?php }
              }?> 
     
          
        </tbody>
        <!-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> -->
    </table>
</div>



 <!-- ADDING MODAL  -->
<div class="container">
<!-- <button id="cust_btn" type="button"  class="btn btn-info btn-lg">Click func</button> -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Add Package</h2>
        </div>

        <form action="" method="POST" id="f" enctype="multipart/form-data">
          <div class="modal-body">
            <label for="" class="formbold-form-labellbl"> Package Image: </label><br>
            <input type="file" name="file" id="" required><br>
            <label for="" class="formbold-form-label lbl"> Package Name: </label><br>
            <input type="text" name="svname" id="svname" placeholder="Enter Package Name" class="formbold-form-input" required/>
            <label for="" class="formbold-form-label lbl"> Package Price: </label><br>
            <input type="text" name="svprice" onkeypress="return isNumber(event)" id="svprice" placeholder="Enter Package Price" class="formbold-form-input" required/>          
            <!-- <label for="svdesc" class="formbold-form-label lbl" > Package Description: </label><br>
            <textarea name="svdesc" id="" cols="93" rows="5" required></textarea> -->
          </div>
        
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            <button type="submit" name="submit"  id="submit" onclick=" myFunction()" class="btn btn-info">Submit</button>
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
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });


// ALERT AFTER SUBMIT FORM
var form = document.getElementById('f');
function myFunction() {
  if (form.checkValidity()) {
    alert("Package Saved Successful!");
  }
}

$(document).ready(function() {
    $('#example').DataTable();
} );

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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap4.js"></script>
</html>