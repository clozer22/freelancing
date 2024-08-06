<?php

@include '../database.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
?>


<?php
include('../database.php');

if (isset($_POST['btn_check_out'])) {
    // Use the correct name for the array of selected items
    $selected_products = $_POST['selected_prod'] ?? array();

    // Start by setting all items to unselected
    $update_all_query = "UPDATE tbl_cart SET isSelected = 0";
    if (!mysqli_query($conn, $update_all_query)) {
        echo "Error updating cart: " . mysqli_error($conn);
        exit();
    }

    if (!empty($selected_products)) {
        // Convert the array of selected IDs to an array of integers
        $selected_ids = array_map('intval', $selected_products);

        // Construct placeholders for the IN clause of the query
        $placeholders = implode(',', array_fill(0, count($selected_ids), '?'));

        // Create a parameterized query to update selected rows
        $update_query = "UPDATE tbl_cart SET isSelected = 1 WHERE cart_id IN ($placeholders)";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $update_query);

        // Bind the selected IDs as parameters
        mysqli_stmt_bind_param($stmt, str_repeat('i', count($selected_ids)), ...$selected_ids);

        // Execute the update
        if (mysqli_stmt_execute($stmt)) {
            header("Location: checkout_form.php");
            exit();
        } else {
            echo "Error updating cart: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Redirect if no items were selected, after setting all to unselected
        header("Location: checkout_form.php");
    }
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
    <nav class="navbar sticky-top navbar-expand-lg bg-dark">
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
                    <li class="nav-item ">
                        <a class="nav-link " href="diy.php">DIY Package</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link active" href="diy.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

    <section class="my-5">
        <div class="container h-100 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">
                    <form method="POST">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-normal mb-0">Shopping Cart</h3>
                            <div>
                                <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                            </div>
                        </div>



                        <?php
                        include('../database.php');
                        $user_id = $_SESSION['user_id'];

                        $query = $conn->query("SELECT * FROM tbl_cart WHERE id = $user_id");

                        if ($query->num_rows > 0) {
                            $items = [];
                            while ($row = $query->fetch_assoc()) {
                                $imageURL = '../uploads/' . $row["image_url"];
                                $items[] = $row;
                        ?>
                                <div class="card rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2 d-flex align-items-center">
                                                <input type="checkbox" name="selected_prod[]" value="<?php echo $row['cart_id']; ?>" id="checkbox_<?php echo $row['cart_id']; ?>" class="form-check-label">

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                    if ($query->num_rows > 0) {
                        while ($row = $query->fetch_assoc()) {
                            $imageURL = '../uploads/' . $row["image_url"];
                    ?>
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="<?php echo $imageURL; ?>" class="img-fluid rounded-3" alt="<?php echo $row['product_name']; ?>">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2 " style=""><span style="font-size: 30px; font-weight:700; color:#FFC106 "><?php echo $row['product_name']; ?></span></p>
                                            <p><span class="text-muted" style="font-weight: 800;">Description: <br></span><span class="" style="font-size: 13px;"><?php echo $row['description']; ?></span></p>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form1" min="1" name="quantity" value="<?php echo $row['Quantity']; ?>" type="number" class="form-control form-control-sm" />

                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3 flex col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0">₱<?php echo number_format($row['Price'], 2); ?></h5>
                                        </div>

                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="../action/remove_from_cart.php?cart_id=<?php echo $row['cart_id']; ?>" class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6l-2 14H7L5 6h14z"></path>
                                                    <path d="M10 11v6"></path>
                                                    <path d="M14 11v6"></path>
                                                </svg>
                                            </a>
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                                                <img src="<?php echo $imageURL; ?>" class="img-fluid rounded-3" style="height: 150px; width:400px; border-radius: 10px" alt="<?php echo $row['product_name']; ?>">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <p class="lead fw-normal mb-2"><span style="font-size: 30px; font-weight:700; color:#FFC106;"><?php echo $row['product_name']; ?></span></p>
                                                <p class="ellipsis-container"><span class="text-muted" style="font-weight: 800;">Description: <br></span><span style="font-size: 13px;"><?php echo $row['description']; ?></span></p>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input id="form1" min="1" name="quantity[<?php echo $row['cart_id']; ?>]" value="<?php echo $row['Quantity']; ?>" type="number" class="form-control form-control-sm" />
                                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-3 flex col-lg-2 col-xl-2 offset-lg-1">
                                                <h5 class="mb-0">₱<?php echo number_format($row['Price'], 2); ?></h5>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <a href="../action/remove_from_cart.php?cart_id=<?php echo $row['cart_id']; ?>" class="text-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6l-2 14H7L5 6h14z"></path>
                                                        <path d="M10 11v6"></path>
                                                        <path d="M14 11v6"></path>
                                                    </svg>
                                                </a>
                                            </div>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="parent-container">
                                <div class="mx-auto items-center flex justify-center" style="margin: auto; display: flex; align-items: center; justify-content: center; height: 100%;">
                                    <img src="../img/logo.png" height="500" style="object-fit: cover;">
                                </div>
                                <h1 class="text-center">No items selected in your cart!</h1>
                            </div>
                        <?php
                        }
                        ?>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                        <div class="parent-container">
                            <div class="mx-auto items-center flex justify-center" style="margin: auto; display: flex; align-items: center; justify-content: center; height: 100%;">
                                <img src="../img/logo.png" height="500" style="object-fit: cover;">
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes



                        <div class="card">
                            <div class="card-body">
                                <button type="submit" name="btn_check_out" data-mdb-button-init data-mdb-ripple-init class="btn btn-warning btn-block btn-lg">Checkout</button>

<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                            </div>
                        </div>
                    </form>

                </div>
            </div>
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