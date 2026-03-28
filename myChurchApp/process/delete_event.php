<?php
session_start();
require_once "../classes/Event.php";
require_once "../classes/utility.php";

$event = new Event();

if (isset($_GET['event_id'])) {
    $event_id = sanitize_input($_GET['event_id']);
   
    
    $delete_result = $event->delete_event($event_id); 
    
    if ($delete_result) {
        $_SESSION['success_msg'] = "Event deleted successfully.";
    } else {
        $_SESSION['error_msg'] = "Error deleting event.";
    }
} else {
    $_SESSION['error_msg'] = "No event ID provided.";
}

header("location: ../all_events.php"); // Redirect back 
exit();
?>
