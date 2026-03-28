<?php
session_start();
require_once "classes/Event.php";
require_once "adminguard.php";
require_once "classes/utility.php";

$event = new Event();

if (isset($_GET['event_id'])) {
    $event_id = sanitize_input($_GET['event_id']);
    
    // Fetch event details
    $event_data = $event->get_event_by_id($event_id);
    
    if (!$event_data) {
        $_SESSION['error_msg'] = "Event not found.";
        header("Location: all_events.php");
        exit;
    }} else {
        $_SESSION['error_msg'] = "No event ID provided.";
        header("Location: all_events.php");
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Edit Event</h1>

    <!-- Edit Event Form -->
    <form method="POST" action="process/pro_edit_event.php">
        <div class="mb-3">
            <label for="event_name" class="form-label">Event Name</label>
            <input type="text" class="form-control" id="event_name" name="event_name" value="<?php echo htmlspecialchars($event_data['event_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="event_date" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="event_date" name="event_date" value="<?php echo htmlspecialchars($event_data['event_date']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="event_time" class="form-label">Event Time</label>
            <input type="time" class="form-control" id="event_time" name="event_time" value="<?php echo htmlspecialchars($event_data['event_time']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="event_location" class="form-label">Location</label>
            <input type="text" class="form-control" id="event_location" name="event_location" value="<?php echo htmlspecialchars($event_data['event_location']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="event_desc" class="form-label">Description</label>
            <textarea class="form-control" id="event_desc" name="event_desc"><?php echo htmlspecialchars($event_data['event_desc']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="event_flier" class="form-label">Event Flier</label>
            <input type="text" class="form-control" id="event_flier" name="event_flier"value="<?php echo htmlspecialchars($event_data['event_flier']); ?>">
        </div>

        <input type="hidden" name="event_id" value="<?php echo isset($event_data['event_id']) ? htmlspecialchars($event_data['event_id']) : ''; ?>">

        <button type="submit" class="btn btn-success">Update Event</button>
        <a href="all_events.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
