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
    $selected_products = $_POST['selected_prod'] ?? array();

    if (empty($selected_products)) {
        $_SESSION['notif'] = [
            'type' => 'error',
            'message' => 'Please Select an item first!',
        ];
        header("Location: diy_cart.php");
        exit();
    }

    // Set all items to unselected
    $update_all_query = "UPDATE tbl_cart SET isSelected = 0";
    if (!mysqli_query($conn, $update_all_query)) {
        echo "Error updating cart: " . mysqli_error($conn);
        exit();
    }

    $selected_ids = array_map('intval', $selected_products);
    $placeholders = implode(',', array_fill(0, count($selected_ids), '?'));

    $update_query = "UPDATE tbl_cart SET isSelected = 1 WHERE cart_id IN ($placeholders)";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, str_repeat('i', count($selected_ids)), ...$selected_ids);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to checkout page without error message
        header("Location: checkout_cart.php");
        exit();
    } else {
        echo "Error updating cart: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <?php

    if (isset($_SESSION['notif'])) {
        $notif = $_SESSION['notif'];
        echo "<script>
            Swal.fire({
                position: 'top',
                icon: '{$notif['type']}',
                title: '{$notif['message']}',
                showConfirmButton: false,
                width: '70%',
                timer: 1500,
                toast: true,
            });
          </script>";
        unset($_SESSION['notif']);
    }
    ?>
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

    <div class="container table-responsive">
        <div class="border-bottom w-100">
            <h1 class="mtoptitle">DIY Package Lists</h1>
        </div>
        <input class="form-control my-4" id="myInput" type="text" placeholder="Search..">
    </div>

    <section class="my-5">
        <div class="container h-100">
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
                        $user_id = $_SESSION['user_id'];

                        $query = $conn->query("SELECT * FROM tbl_cart WHERE id = $user_id");

                        if ($query->num_rows > 0) {
                            while ($row = $query->fetch_assoc()) {
                                $imageURL = '../uploads/' . $row["image_url"];
                        ?>
                                <div class="card rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2 d-flex align-items-center">
                                                <input type="checkbox" name="selected_prod[]" value="<?php echo $row['cart_id']; ?>" id="checkbox_<?php echo $row['cart_id']; ?>" class="form-check-label mx-2">

                                                <img src="<?php echo $imageURL; ?>" class="img-fluid rounded-3" style="height: 150px; width: 300px; border-radius:10px;" alt="<?php echo $row['product_name']; ?>">
                                            </div>
                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                <p class="lead fw-normal mb-2" style="font-size: 30px; font-weight: 700; color: #FFC106;"><?php echo $row['product_name']; ?></p>
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
                                            <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1">
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
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                        } else {
                            ?>
                            <div class="parent-container">
                                <div class="mx-auto items-center flex justify-center align-items-center text-center" style="display: flex; justify-content: center; align-items: center;">
                                    <img src="../img/logo.png" alt="Empty Cart" class="img-fluid" style="height: 400px;">
                                </div>
                                <h3 class="text-center my-3 mb-3">No DIY Package items are available on your cart!</h3>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="d-flex justify-content-between mb-5">
                            <?php
                            include('../database.php');
                            $user_id = $_SESSION['user_id'];

                            $select = mysqli_query($conn, "SELECT * FROM imagespack");
                            if (mysqli_num_rows($select) > 0) {
                                while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                    <input type="hidden" name="package_id" value="<?php echo $row['id'] ?>">
                                    <input type="submit" name="btn_check_out" class="btn btn-success w-100" value="Checkout">
                            <?php
                                }
                            } else {
                                echo "No records found.";
                            }
                            ?>

                    </form>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>

    <script src="../js/jquery-3.6.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable .card").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>