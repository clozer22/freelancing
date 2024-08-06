<?php
@include '../database.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
?>


<?php

if (isset($_POST['checkOutForm'])) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'] ?? null;
    $country = $_POST['country'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $pay_option = $_POST['paymentMethod'];
    $total_price = $_POST['total_price'];
    $item_name = $_POST['item_name'];
    $qty = $_POST['quantity'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $insert_form = mysqli_query($conn, "
        INSERT INTO tbl_orders (
            first_name, last_name, email, order_total, order_item_name, order_address1, 
            order_address2, order_country, order_state, order_zip, order_date, 
             order_paymentOption, order_status, order_qty
        ) VALUES (
            '$firstName', '$lastName', '$email', '$total_price', '$item_name', 
            '$address1', '$address2', '$country', '$state', '$zip', NOW(), 
            '$pay_option', 'Pending', '$qty'
        )
    ");

    if ($insert_form) {
        echo "Order successfully placed!";
        header("Location: ../user_dash.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout page</title>
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

        .details h4 {
            color: black;
            line-height: 35px;
            font-family: "Aleo", serif;
            color: #291947;
        }

        .details {
            margin: 120px;
            text-align: justify;
        }

        .head_container {
            display: flex;
            justify-content: space-between;
        }

        .head_container h1 {
            font-size: 53px;
            color: #291947;
            font-family: 'myFont';
            margin-bottom: 80px;
        }

        .bgpic {
            margin: 65px;
        }

        .image-container {
            position: relative;
            width: 30%;
            /* Ensures responsiveness */
        }

        .image-container img {
            width: 100%;
            /* Ensures image fills container */
            height: auto;
            /* Maintains image aspect ratio */
        }

        .text-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.9);
            /* Semi-transparent black background */
            color: white;
            /* Text color */
            padding: 10px;
            /* Padding for text */
            text-align: center;
            /* Center align text */
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

        .ad {
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
        .event-details {
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

            .heading>h1 {
                line-height: 45px;
            }

            .heading>p {
                line-height: 30px;
            }

        }
    </style>
</head>



<body>
    <nav class="navbar z-3 sticky-top navbar-expand-lg" style="background-color: #42b2cf;z-index:9999">
        <div class="logo">
            <img src="../img/logo.png" alt="" width="200px">
        </div>
        <div class="container z-3">
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
                        <a class="nav-link " href="#">Cart</a>
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

    <div class="container my-5">
        <div class="py-5 text-center">
            <h2>Checkout form</h2>
        </div>
        <div class="row">
            <div class=" col-md-4 order-md-2 mb-4" style="z-index:auto">

                <?php

                include('../database.php');

                $user_id = $_SESSION['user_id'];

                // Query to count the number of items in the cart for the given user
                $query = $conn->query("
                        SELECT COUNT(*) as cart_count FROM tbl_cart WHERE id = $user_id
                    ");

                $result = $query->fetch_assoc();
                $cart_count = $result['cart_count'];

                $total = mysqli_query($conn, "SELECT SUM(Price) as Total_Price, product_name, Quantity FROM tbl_cart WHERE id = $user_id");

                if ($total && mysqli_num_rows($total) > 0) {
                    $row = mysqli_fetch_assoc($total);
                    $total_price = $row['Total_Price'];
                    $itemName = $row['product_name'];
                    $qty = $row['Quantity'];
                } else {
                    $total_price = 0;
                }
                ?>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill"><?php echo $cart_count; ?></span>
                </h4>
                <ul class="list-group mb-3 sticky-top">
                    <?php
                    include('../database.php');

                    $user_id = $_SESSION['user_id'];

                    $query = $conn->query("
                                SELECT * FROM tbl_cart WHERE id = $user_id
                            ");

                    if ($query->num_rows > 0) {
                        while ($row = $query->fetch_assoc()) {
                            $imageURL = '../uploads/' . $row["image_url"];
                    ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?php echo $row['product_name'] ?></h6>
                                    <small class="text-muted"><?php echo $row['description'] ?></small>
                                </div>
                                <span class="text-muted">₱ <?php echo $row['Price'] ?></span>
                            </li>
                    <?php
                        }
                    }
                    ?>

                    <li class="list-group-item bg-dark text-white d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>₱ <?php echo $total_price ?></strong>
                    </li>
                </ul>
            </div>

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" method="POST" novalidate="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" name="firstname" value="<?php echo $_SESSION['firstname'] ?? '' ?>" class="form-control" id="firstName" placeholder="" value="">
                            <div class="invalid-feedback"> Valid first name is required. </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" name="lastname" value="<?php echo $_SESSION['lastname'] ?? '' ?>" class="form-control" id="lastName" placeholder="">
                            <div class="invalid-feedback"> Valid last name is required. </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="email" name="email" class="form-control" id="username" value="<?php echo $_SESSION['email'] ?? '' ?>" placeholder="Email" required="">
                            <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address1" class="form-control" id="address" placeholder="1234 Main St" required="">
                        <div class="invalid-feedback"> Please enter your shipping address. </div>
                    </div>
                    <div class="mb-3">
                        <label for="address2">Address 2 <?php echo $itemName ?> <span class="text-muted">(Optional) </span></label>
                        <input type="text" name="address2" class="form-control" id="address2" placeholder="Apartment or suite">
                        <input type="hidden" name="total_price" value="<?php echo $total_price ?>" class="form-control">
                        <input type="hidden" name="item_name" value="<?php echo $itemName ?>" class="form-control">
                        <input type="hidden" name="quantity" value="<?php echo $qty ?>" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select name="country" class="custom-select d-block w-100" id="state" required="">
                                <option value="">Choose...</option>
                                <option value="philippines" selected>Philippines</option>
                            </select>
                            <div class="invalid-feedback"> Please select a valid country. </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <input type="text" name="state" class="form-control" id="zip" placeholder="" required="">
                            <div class="invalid-feedback"> Please provide a valid state. </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" name="zip" inputmode="numeric" class="form-control" id="zip" placeholder="" required="">
                            <div class="invalid-feedback"> Zip code required. </div>
                        </div>
                    </div>
                    <hr class="mb-4">

                    <hr class="mb-4">
                    <h4 class="mb-3">Payment</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" disabled class="custom-control-input" checked="" value="GCASH" required="">
                            <label class="custom-control-label" for="credit">GCash</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" checked type="radio" class="custom-control-input" required="" value="COD">
                            <label class="custom-control-label" for="debit">Cash on Delivery</label>
                        </div>

                    </div>

                    <hr class="mb-4">
                    <button name="checkOutForm" class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017-2019 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>