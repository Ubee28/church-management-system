<?php 

session_start();
require_once "../classes/Event.php";
require_once "../classes/utility.php";

$event = new Event();

// Handle form submission for editing
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $event_name = sanitize_input($_POST['event_name']);
        $event_date = sanitize_input($_POST['event_date']);
        $event_time = sanitize_input($_POST['event_time']);
        $event_location = sanitize_input($_POST['event_location']);
        $event_desc = sanitize_input($_POST['event_desc']);
        $event_flier = sanitize_input($_POST['event_flier']);
        $event_id = sanitize_input($_POST['event_id']);
        
        // Update event details
        $update_result = $event->update_event($event_name, $event_date, $event_time, $event_location, $event_desc, $event_flier, $event_id);
        
        if ($update_result) {
            $_SESSION['success_msg'] = "Event updated successfully.";
            header("Location: ../all_events.php");
        } else {
            $_SESSION['error_msg'] = "Error updating event.";
            header("location: ../edit_event.php?event_id=" . $event_id);
            exit();
        }
    }else {
        $_SESSION['error_msg'] = "Invalid request method.";
        header("location: ../all_events.php");
        exit();
    }

?>
