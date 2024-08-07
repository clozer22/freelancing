<?php
@include '../database.php';
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
    exit();
}
?>
<?php

if (isset($_SESSION['grand_total'])) {
    $grand_total = $_SESSION['grand_total'];
} else {
    echo 'No total price available.';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Booking</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../cssproj/home.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style>
        .custom-form {
            line-height: 40px;
            font-size: 1.2em
        }

        .custom-form input {
            height: 50px;
        }

        .container {
            box-shadow: rgba(255, 255, 255, 0.1) 0px 1px 1px 0px inset, rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
        }

        .ellipsis-container {
            display: -webkit-box;
            -webkit-line-clamp: 7;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 15px;
        }

        .ellipsis-container p {
            margin: 0;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
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
                    <li class="nav-item active">
                        <a class="nav-link" style="color: #b5246f;" href="package.php">Packages</a>
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

    <div class="container mt-5 p-5 h  mb-5">
        <form class="custom-form" action="booking_form.php" method="POST">
            <div class="d-flex justify-content-between align-items-center border-bottom border-dark ">
                <h1 class="font-weight-bold ">Booking Form</h1>
                <h4 class="card-title">Total Price: ₱ <?php echo number_format($grand_total, 2); ?></h4>
            </div>

            <?php
            include('../database.php');


            $user_id = $_SESSION['user_id'];

            $select_cart = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE isSelected = 1 AND id = $user_id");

            $count_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM tbl_cart WHERE isSelected = 1 AND id = $user_id");
            $count_result = mysqli_fetch_assoc($count_query);
            $count = $count_result['count'];
            $_SESSION['count'] = $count;

            $grand_total = 0;

            ?>
            <h5 class="my-4">Your Items on Cart (<?php echo $count; ?>)</h5>

            <div class="row my-4">



                <?php
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($row = mysqli_fetch_assoc($select_cart)) {
                        $imageURL = '../uploads/' . $row["image_url"];
                        $price = (float)$row['Price'];
                        $grand_total += $price;
                        $_SESSION['grand_total'] = $grand_total;
                ?>

                        <div class="col-md-3">
                            <div class="card">
                                <img src="<?php echo $imageURL ?>" class="card-img-top" style="height: 200px;" alt="Image 1">
                                <div class="card-body" style="height: 300px;">
                                    <h5 class="card-title"><?php echo $row['product_name'] ?> </h5>
                                    <h6 class="mb-3"> Quantity: <?php echo $row['Quantity']?></h6>
                                    <h5>₱ <?php echo number_format($price, 2); ?></h5>
                                    <div style="border-bottom: 2px solid gainsboro;"></div>
                                    <h6 class="my-2">Description:</h6>
                                    <div class="pt-1 ellipsis-container" style="line-height:normal">
                                        <p style="font-size: 13px;"><?php echo $row['description']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>



            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="title" class="form-label" name="title">Title:</label>
                    <input type="text" placeholder="Input Title of event" class="form-control" id="title" name="title" required>
                </div>
                <div class="col-md-6">
                    <label for="celebrant_name" class="form-label">Celebrant Name</label>
                    <input type="text" placeholder="Input Celebrant Name" class="form-control" id="celebrant_name" name="celebrant_name" required>
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="start_datetime" class="form-label">Start Date/Time</label>
                    <input type="datetime-local" placeholder="Input starting event and time" class="form-control" id="start_datetime" name="start_datetime" required>
                </div>
                <div class="col-md-6">
                    <label for="end_datetime" class="form-label">End Date/Time</label>
                    <input type="datetime-local" placeholder="Input end event and time" class="form-control" id="end_datetime" name="end_datetime" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" placeholder="For more..." id="description" name="description" rows="3"></textarea>
            </div>

            <button type="submit" class="bg-primary border-0 text-light font-weight-bold w-100" style="height: 50px;">Submit</button>
        </form>
    </div>
</body>

</html>