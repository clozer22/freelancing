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
  <title>Document</title>
  <link rel="stylesheet" href="../cssproj/home.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap");

    section {
      /* padding-block: min(20vh, 2rem); */
      width: calc(min(76.5rem, 90%));
      margin-inline: auto;
      color: #111;
    }

    section h2 {
      text-transform: capitalize;
      letter-spacing: 0.025em;
      font-size: clamp(2rem, 1.8125rem + 0.75vw, 2.6rem);
    }

    section a {
      display: inline-block;
      text-decoration: none;
    }

    section .container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 2rem;
      margin-bottom: 2rem;

    }

    section .container .card ul {
      margin: 0;
      padding: 0;
      list-style-type: none;
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 0.625rem;

    }

    section .container .card .butt {
      text-transform: uppercase;
      background: var(--clr-tag);
      color: #282828;
      font-weight: 700;
      font-size: 0.8rem;
      padding: 0.375rem 0.625rem;
      border-radius: 0.188rem;

    }

    section .container .card ul .branding {
      color: #704a31;
    }

    section .container .card .content {
      padding: 0.938rem 0.625rem;

    }


    section .container .card .content h3 {
      text-transform: capitalize;
      font-size: clamp(1.5rem, 1.3909rem + 0.4364vw, 1.8rem);
    }

    section .container .card .content p {
      margin: 0.625rem 0 1.25rem;
      color: #565656;

    }

    section .container .card-inner {
      position: relative;
      width: inherit;
      height: 10.75rem;
      background: var(--clr);
      border-bottom-right-radius: 0;
      overflow: hidden;
    }

    section .container .card-inner .box {
      width: 100%;
      height: 100%;
      background: #fff;
      border-radius: 1.25rem;


      overflow: hidden;
    }

    section .container .card-inner .box .imgBox {
      position: absolute;
      inset: 0;
    }

    section .container .card-inner .box .imgBox img {
      width: 100%;
      height: 100%;
      object-fit: fit;
    }

    .box_shadow {
      box-shadow: 0px 10px 24px -14px rgba(0, 0, 0, 0.75);
      -webkit-box-shadow: 0px 10px 24px -14px rgba(0, 0, 0, 0.75);
      -moz-box-shadow: 0px 10px 24px -14px rgba(0, 0, 0, 0.75);
    }

    .ellipsis-container {
      display: -webkit-box;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 15px;
    }

    .ellipsis-container p {
      margin: 0;
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
          <li class="nav-item ">
            <a class="nav-link " href="package.php">Packages</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" style="color: #b5246f;" href="diy.php">DIY Package</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="#">Cart</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="user_history.php">History</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="diy_cart.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1" />
                <circle cx="20" cy="21" r="1" />
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
              </svg>
            </a>
          </li>

          <li class="nav-item">
            <a href="../logout.php" class="nav-link">Logout</a>
          </li>


        </ul>
      </div>
    </div>
  </nav>

  <div class="container table-responsive">
    <div class="border-bottom w-100">
      <h1 class=" mtoptitle ">DIY Package Lists</h1>

    </div>
    <input class="form-control my-4" id="myInput" type="text" placeholder="Search..">
  </div>

  <section>
    <div class="container" id="myTable">
      <?php
      include '../database.php';
      $query = $conn->query("SELECT * FROM images ORDER BY uploaded_on");

      if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
          $imageURL = '../uploads/' . $row["file_name"];
      ?>

          <div class="card box_shadow" id="divs">
            <div class="card-inner" style="--clr:#fff;">
              <div class="box">
                <div class="imgBox">
                  <img class="imgR" src="<?php echo $imageURL; ?>">
                </div>
              </div>
            </div>
            <div class="content">
              <div class="border-bottom">
                <h3><?php echo $row['Product']; ?></h3>
              </div>
              <div class="ellipsis-container" style="height: 110px;">
                <p><?php echo $row['Description']; ?></p>
              </div>
              <div style="display:flex; justify-content:space-between; margin-top: -20px;">
                <form method="post" action="../action/add_cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                  <input type="hidden" name="product" value="<?php echo $row['Product']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $row['Price']; ?>">
                  <input type="hidden" name="quantity" value="1">
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                  <input type="hidden" name="description" value="<?php echo $row['Description']; ?>">
                  <input type="hidden" name="image" value="<?php echo $row['file_name']; ?>">



                  <button type="submit" name="add_cart" class="btn btn-primary flex my-3 " style="font-size: .8rem; font-weight: 700;">
                    Add to Cart
                  </button>
                </form>

                <p style="font-weight:700; font-size:18px; margin-top:20px; color: #D0622F">₱ <?php echo $row['Price']; ?></p>
              </div>
            </div>
          </div>
      <?php }
      } ?>
    </div>
  </section>


  <div class="my-5 text-white">
    q
  </div>

  <!-- OKAY -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable #divs").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
</body>

</html>