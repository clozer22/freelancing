<?php
session_start();
include('../database.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['not_login'] = true;
    header("Location: Login.php");
    exit(0);
}

if (isset($_POST['add_cart'])) {
    // Escaping user inputs for security
    $product =$_POST['product'];
    $product_price =$_POST['product_price'];
    $description =$_POST['description'];
    $image =$_POST['image'];
    $quantity =$_POST['quantity'];
    $user_id =$_POST['user_id'];
    $date = date('Y-m-d');

    $total_price = $product_price * $quantity;

    // Check if product already exists in the cart
    $check = mysqli_query($conn, "SELECT Quantity, Price FROM tbl_cart WHERE id = '$user_id' AND product_name = '$product'");
    $result = mysqli_fetch_assoc($check);

    $update_cart_query = false;
    $insert_cart_query = false;

    if ($result) {
        $existing_quantity = $result['Quantity'];
        $existing_price = $result['Price'];
        $new_quantity = $existing_quantity + $quantity;
        $new_price = $existing_price + $total_price;

        $update_cart_query = mysqli_query($conn, "UPDATE tbl_cart SET Quantity = '$new_quantity', Price = '$new_price', date = '$date' WHERE id = '$user_id' AND product_name = '$product'");
    } else {
        $insert_cart_query = mysqli_query($conn, "INSERT INTO tbl_cart (product_name, Price, Quantity, date, id, image_url, description) VALUES ('$product', '$total_price', '$quantity', '$date', '$user_id', '$image', '$description')");
    }

    if ($update_cart_query || $insert_cart_query) {
        $_SESSION['notif'] = [
            'type' => 'success',
            'message' => 'Item added to cart successfully!',
        ];
    } else {
        $_SESSION['notif'] = [
            'type' => 'error',
            'message' => 'Failed to add item to cart!',
        ];
    }

    header("Location: ../user/diy.php");
    exit(0);
}
