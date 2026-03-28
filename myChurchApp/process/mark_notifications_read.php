<?php
require_once("../classes/Notification.php");

$notification = new Notification();

try {
    $audience = 'all_members'; 
    $notification->mark_notifications_as_read($audience);

    echo json_encode(['status' => 'success', 'message' => 'Notifications marked as read.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update notifications.']);
}
