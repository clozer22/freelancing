<?php
include '../database.php';

// DELETE Product
$id = $_GET['id'];
$sql = "DELETE FROM `imagespack` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if($result){
    header("Location: ../product.php"); 
}
else{
    echo "Failed to Delete" . mysqli_error($conn);
}
?>