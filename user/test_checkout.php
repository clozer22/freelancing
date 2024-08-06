<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>,
    <h1>Event ID: 
        <?php
        // Check if 'event_id' is set in the session
        if (isset($_SESSION['event_id'])) {
            // Display the event_id
            echo htmlspecialchars($_SESSION['event_id']);
        } else {
            // Display a message if 'event_id' is not set
            echo "No event ID found.";
        }
        ?>
    </h1>
</body>
</html>
