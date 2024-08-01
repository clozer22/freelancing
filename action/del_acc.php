<?php
include '../database.php';

// DELETE Account
$id = $_GET['id'];
$sql = "DELETE FROM `tbl_users` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if($result){
    header("Location: ../admin/account.php"); 
}
else{
    echo "Failed to Delete" . mysqli_error($conn);
}
?>