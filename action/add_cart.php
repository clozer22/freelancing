<?php
session_start();
include('../database.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['not_login'] = true;
    header("Location: Login.php");
    exit(0);
}

if (isset($_POST['add_cart'])) {
    $product = $_POST['product'];
    $product_price = $_POST['product_price'];


    $description = $_POST['description'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];
    $user_id = $_POST['user_id'];
    $date = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO tbl_cart ( product_name, Price, Quantity, date, id, image_url, description ) VALUES ( ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sssssss", $product, $product_price, $quantity, $date, $user_id, $image, $description);

    if ($stmt->execute()) {
        $_SESSION['added_to_cart'] = true;
        header("Location: ../user/diy_cart.php");
        exit(0);
    } else {
        $_SESSION['failed_to_cart'] = true;
        header("Location: ../user/diy_cart.php");
        exit(0);
    }

    $stmt->close();
}
