<?php
@include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $color = $_POST['color'];
    $textColor = $_POST['textColor'];

    $sql = "INSERT INTO tbl_events_list (title, start_datetime, end_datetime, color, text_color) VALUES ('$title', '$start', '$end', '$color', '$textColor')";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error"));
    }
}
?>
