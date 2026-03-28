<?php
require_once("../classes/Event.php");
require_once "../classes/utility.php";

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $month = sanitize_input($data['month']) ?? null;
    $search = sanitize_input($data['search']) ?? '';

    $event = new Event();
    $events = $event->fetchFilteredEvents($month, $search);

    echo json_encode([
        'status' => 'success',
        'events' => $events
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
