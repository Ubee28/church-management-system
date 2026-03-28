<?php
session_start();
require_once("../classes/utility.php");
require_once("../classes/Event.php");
require_once("../classes/Notification.php"); // Include the Notification class

$event = new Event;
$notification = new Notification; // Instantiate the Notification class

// Check if the AJAX request is received and the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = sanitize_input($_POST["eventName"]);
    $event_date = sanitize_input($_POST["eventDate"]);
    $event_time = sanitize_input($_POST["eventTime"]);
    $event_loc = sanitize_input($_POST["event_loc"]);
    $event_desc = sanitize_input($_POST["event_desc"]);

    // Handle file upload for the flier
    if (isset($_FILES['event_flier']) && $_FILES['event_flier']['error'] == 0) {
        $file_name = $_FILES['event_flier']['name'];
        $file_tmp = $_FILES['event_flier']['tmp_name'];
        $upload_dir = "../uploads/";
        $upload_file = $upload_dir . basename($file_name);

        // Additional file checks can be added here
        if (move_uploaded_file($file_tmp, $upload_file)) {
            $event_flier = $upload_file; // Save the path of the uploaded file
        } else {
            echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please upload a valid flier.']);
        exit();
    }

    // Validate form fields
    if (empty($event_name) || empty($event_date) || empty($event_time) || empty($event_loc) || empty($event_desc)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit();
    }

    // Save the event to the database and add a notification
    try {
        // Create the event
        $event->create_event($event_name, $event_date, $event_time, $event_loc, $event_desc, $event_flier);
    
        // Add a notification via the Notification class
        $notificationMessage = "A new event, \"$event_name\", has been added!";
        $notificationId = $notification->create_notification('new_event', $notificationMessage, $event_flier, 'all_members');
    
        echo json_encode(['status' => 'success', 'message' => 'Event created successfully!', 'notification_id' => $notificationId]);
        exit();
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create event. Please try again later.']);
        exit();
    }
    
} else {
    // If the request is not POST, return an error response
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit();
}
