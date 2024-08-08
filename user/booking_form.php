<?php
@include '../database.php';
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
    exit();
}

// Initialize variables for package name, price, and title
$package_name = '';
$package_price = '';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the 'package' query parameter is set and not empty
    if (!isset($_GET['package']) || empty($_GET['package'])) {
        // Redirect to package.php with an error message
        header('Location: package.php?error=invalid_package');
        exit();
    }

    // Sanitize the input
    $id = intval($_GET['package']); // Convert the id to an integer for safety

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT Product, Price FROM imagespack WHERE id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind the id parameter to the SQL statement
    $stmt->bind_param("i", $id);

    // Execute the statement
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $package_name = $row['Product'];
        $package_price = $row['Price'];
    } else {
        // No record found, redirect to package.php with an error message
        $stmt->close();
        header('Location: package.php?error=package_not_found');
        exit();
    }

    // Close the statement
    $stmt->close();
}

// Function to generate a random hex color
function generateRandomColor() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

// post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($conn)) {
        die('Database connection not established.');
    }

    // Retrieve and sanitize form inputs
    $package_name = isset($_POST['package_name']) ? mysqli_real_escape_string($conn, $_POST['package_name']) : $package_name;
    $package_price = isset($_POST['package_price']) ? mysqli_real_escape_string($conn, $_POST['package_price']) : $package_price;
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
    $celebrant_name = isset($_POST['celebrant_name']) ? mysqli_real_escape_string($conn, $_POST['celebrant_name']) : '';
    $start_datetime = isset($_POST['start_datetime']) ? mysqli_real_escape_string($conn, $_POST['start_datetime']) : '';
    $end_datetime = isset($_POST['end_datetime']) ? mysqli_real_escape_string($conn, $_POST['end_datetime']) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';
    $status = 'pending';
    $color = generateRandomColor();
    $text_color = '#000000'; // Default text color
    $user_id = $_SESSION['user_id']; // Get user_id from session

    // Prepare and execute the insert query
    $stmt = $conn->prepare("INSERT INTO tbl_events_list (package_name, package_price, title, celebrant_name, start_datetime, end_datetime, status, color, text_color, description, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt = $conn->prepare("INSERT INTO tbl_events_list (title, celebrant_name, start_datetime, end_datetime, status, color, text_color, description, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }

    // Bind parameters and execute the statement
    $stmt->bind_param("sdsssssssss", $package_name, $package_price, $title, $celebrant_name, $start_datetime, $end_datetime, $status, $color, $text_color, $description, $user_id);
    $stmt->execute();

    // Check if the record was inserted successfully
    if ($stmt->affected_rows > 0) {
        // Get the ID of the newly inserted row
        $event_id = $conn->insert_id;
        // Store the event_id in the session
        $_SESSION['event_id'] = $event_id;
        // Redirect to the checkout page
        header('Location: test_checkout.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
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


    <!-- FORM -->
    <div class="container mt-5 p-5 h  mb-5">
        <form class="custom-form" action="booking_form.php" method="POST">
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

            <button type="submit" class="bg-primary border-0 text-light font-weight-bold w-100" style="height: 50px;">Submit</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>