<?php
session_start();
require_once('../classes/utility.php');
require_once('../classes/Sermon.php');

if (isset($_POST['sermon_id']) && isset($_POST['action'])) {
    // Sanitize and validate input
    $sermonId = intval(sanitize_input($_POST['sermon_id']));
    $action = sanitize_input($_POST['action']);

    error_log("Action: $action, Sermon ID: $sermonId");

    // Instantiate the Sermon class
    $sermon = new Sermon();

    // Perform action based on 'add' or 'remove'
    if ($action === 'add') {
        if ($sermon->addToCarousel($sermonId)) {
            echo json_encode(['status' => 'success', 'message' => 'Added to carousel']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add to carousel']);
        }
    } elseif ($action === 'remove') {
        if ($sermon->removeFromCarousel($sermonId)) {
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
