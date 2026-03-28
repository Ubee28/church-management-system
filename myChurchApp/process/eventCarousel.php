<?php
session_start();
require_once('../classes/utility.php');
require_once('../classes/Event.php');

if (isset($_POST['event_id']) && isset($_POST['action'])) {
    // Sanitize and validate input
    $eventId = intval(sanitize_input($_POST['event_id']));
    $action = sanitize_input($_POST['action']);

    error_log("Action: $action, Event ID: $eventId");

    // Instantiate the Event class
    $event = new Event();

    // Perform action based on 'add' or 'remove'
    if ($action === 'added') {
        if ($event->addToCarousel($eventId)) {
            echo json_encode(['status' => 'success', 'message' => 'Added to carousel']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add to carousel']);
        }
    } elseif ($action === 'removed') {
        if ($event->removeFromCarousel($eventId)) {
            echo json_encode(['status' => 'success', 'message' => 'Removed from carousel']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to remove from carousel']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
}
?>
