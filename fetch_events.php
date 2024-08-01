<?php
@include 'database.php';

// Fetch future events from the database
$sql = "SELECT * FROM tbl_events_list";
$result = mysqli_query($conn, $sql);

$events = array();

while ($row = mysqli_fetch_assoc($result)) {
    $event = array(
        'title' => $row['title'],
        'start' => $row['start_datetime'],
        'end' => $row['end_datetime'],
        'color' => $row['color'],
        'textColor' => $row['text_color']
    );
    array_push($events, $event);
}

echo json_encode($events);
?>
