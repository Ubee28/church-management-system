<?php
require_once("../classes/Notification.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $notificationId = $data['id'] ?? null;

    if ($notificationId) {
        $notification = new Notification;

        try {
            $result = $notification->delete_notification($notificationId);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Notification deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete notification.']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Notification ID is required.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
