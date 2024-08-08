<?php
@include '../database.php';
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
    exit();
}

// Initialize variables

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $type = isset($_GET['type']) ? $_GET['type'] : 'booking'; // Default type to 'booking'

    if ($type === 'booking') {
        if (!isset($_GET['package']) || empty($_GET['package'])) {
            header('Location: package.php?error=invalid_package');
            exit();
        }
        $package_id = intval($_GET['package']);
    }
}

function generateRandomColor()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

// post
if (isset($_POST['book_button'])) {
    if (!isset($conn)) {
        die('Database connection not established.');
    }

    $type = isset($_GET['type']) ? $_GET['type'] : 'booking';
    // Check if type is set in GET request, otherwise default to 'booking'

    if ($type === 'booking') {

        // Get package_id from POST data
        $package_id = isset($_POST['package_id']) ? mysqli_real_escape_string($conn, $_POST['package_id']) : '';

        $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
        $celebrant_name = isset($_POST['celebrant_name']) ? mysqli_real_escape_string($conn, $_POST['celebrant_name']) : '';
        $start_datetime = isset($_POST['start_datetime']) ? mysqli_real_escape_string($conn, $_POST['start_datetime']) : '';
        $end_datetime = isset($_POST['end_datetime']) ? mysqli_real_escape_string($conn, $_POST['end_datetime']) : '';
        $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';
        $status = 'pending';
        $color = generateRandomColor();
        $text_color = '#000000';
        $user_id = $_SESSION['user_id'];



        $stmt = $conn->prepare("INSERT INTO tbl_events_list (title, celebrant_name, start_datetime, end_datetime, status, color, text_color, description, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }

        $stmt->bind_param("sssssssss", $title, $celebrant_name, $start_datetime, $end_datetime, $status, $color, $text_color, $description, $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $event_id = $conn->insert_id;
            $_SESSION['event_id'] = $event_id;

            // Fetch Product, Price, and file_name from imagespack based on package_id
            $getimagepackinfo = $conn->prepare("SELECT Product, Price, file_name FROM imagespack WHERE id = ?");
            if ($getimagepackinfo === false) {
                die('Prepare failed: ' . $conn->error);
            }
            $getimagepackinfo->bind_param("i", $package_id);
            $getimagepackinfo->execute();
            $getimagepackinfo->bind_result($package_name, $package_price, $file_name);
            $getimagepackinfo->fetch();
            $getimagepackinfo->close();

            $image_url = $file_name; // Use file_name as image_url

            // Insert into tbl_cart
            $product_name = $package_name;
            $price = $package_price;
            $quantity = 1;
            $date = date('Y-m-d');
            $isSelected = 1;

            $cart_stmt = $conn->prepare("INSERT INTO tbl_cart (product_name, Price, Quantity, Date, image_url, id, description, isSelected) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($cart_stmt === false) {
                die('Prepare failed: ' . $conn->error);
            }

            $cart_stmt->bind_param("sdissssi", $product_name, $price, $quantity, $date, $image_url, $user_id, $description, $isSelected);
            $cart_stmt->execute();

            if ($cart_stmt->affected_rows > 0) {
                $cart_stmt->close();
                header('Location: checkout_form.php');
                exit();
            } else {
                echo "Error inserting into cart: " . $cart_stmt->error;
            }
            $cart_stmt->close();
        } else {
            echo "Error inserting event: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
        exit();
    } else {
        // Sanitize inputs and set defaults if not provided
        $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
        $celebrant_name = isset($_POST['celebrant_name']) ? mysqli_real_escape_string($conn, $_POST['celebrant_name']) : '';
        $start_datetime = isset($_POST['start_datetime']) ? mysqli_real_escape_string($conn, $_POST['start_datetime']) : '';
        $end_datetime = isset($_POST['end_datetime']) ? mysqli_real_escape_string($conn, $_POST['end_datetime']) : '';
        $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';
        $status = 'pending';
        $color = generateRandomColor();
        $text_color = '#000000';
        $user_id = $_SESSION['user_id'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO tbl_events_list (title, celebrant_name, start_datetime, end_datetime, status, color, text_color, description, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("sssssssss", $title, $celebrant_name, $start_datetime, $end_datetime, $status, $color, $text_color, $description, $user_id);
        $stmt->execute();

        // Check if the event was inserted successfully
        if ($stmt->affected_rows > 0) {
            $event_id = $conn->insert_id;
            $_SESSION['event_id'] = $event_id;
            $_SESSION['type'] = $type;
            // Redirect to the checkout form
            header("Location: checkout_form.php");
            exit();
        } else {
            echo "Failed to insert event.";
        }
    }
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
                    <li class="nav-item active">
                        <a class="nav-link active" href="package.php">Packages</a>
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


    <!-- FORM -->
    <div class="container mt-5 p-5 h  mb-5">
        <form class="custom-form" method="POST">
            <h1 class="font-weight-bold border-bottom border-dark pb-3">Booking Form</h1>


            <input type="text" hidden class="form-control" id="package_id" name="package_id" value="<?php echo htmlspecialchars($package_id); ?>">




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

            <button name="book_button" type="submit" class="bg-primary border-0 text-light font-weight-bold w-100" style="height: 50px;">Submit</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>