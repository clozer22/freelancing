<?php
session_start();
include('../database.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['not_login'] = true;
    header("Location: Login.php");
    exit(0);
}

if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];

    $delete_query = "DELETE FROM tbl_cart WHERE cart_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param('i', $cart_id);
    
    if ($stmt->execute()) {
        $_SESSION['item_removed'] = true;
        header("Location: ../user/diy_cart.php");
        exit(0);
    } else {
        $_SESSION['remove_failed'] = true;
        header("Location: ../user/diy_cart.php");
        exit(0);
    }
} else {
    $_SESSION['invalid_cart_id'] = true;
    header("Location: ../user/diy_cart.php");
    exit(0);
}
?>
