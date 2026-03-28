<?php
require_once("../classes/Notification.php");

$notification = new Notification();

try {
    $audience = 'all_members'; 
    $notifications = $notification->get_notifications($audience);
    $unread_count = $notification->get_unread_count($audience);

    echo json_encode(['status' => 'success', 'data' => $notifications, 'unread_count' => $unread_count]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch notifications.']);
}
