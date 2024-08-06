<?php
include('../database.php');


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

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $insert_form = mysqli_query($conn, "
        INSERT INTO tbl_orders (
            first_name, last_name, email, order_total, order_item_name, order_address1, 
            order_address2, order_country, order_state, order_zip, order_date, 
             order_paymentOption, order_status
        ) VALUES (
            '$firstName', '$lastName', '$email', '$total_price', 'Item Name', 
            '$address1', '$address2', '$country', '$state', '$zip', NOW(), 
            '$pay_option', 'Pending'
        )
    ");

    if ($insert_form) {
        echo "Order successfully placed!";
        header("Location: ../user_dash.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
