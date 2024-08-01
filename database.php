<?php

$conn = mysqli_connect("localhost", "root", "", "db_diyevent");

if (!$conn) {
    echo "Connection Failed";
}

$list_acc= mysqli_query($conn, "SELECT * FROM tbl_users");
$tbl_message = mysqli_query($conn, "SELECT * FROM tbl_message ");