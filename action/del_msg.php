<?php
include '../database.php';

// DELETE Product
$id = $_GET['id'];
$sql = "DELETE FROM `tbl_message` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if($result){
    header("Location: ../admin/message.php"); 
}
else{
    echo "Failed to Delete" . mysqli_error($conn);
}
?>