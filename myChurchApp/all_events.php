<?php
session_start();
require_once "classes/Event.php";
require_once "adminguard.php";

$event = new Event();
$all_events = $event->fetch_all_events(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
</head>
<body>

<div class="container mt-5">
    <h1>All Events</h1>
    
    <!-- Event Table with Edit/Delete Actions -->
     <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Event Time</th>
                <th>Location</th>
                <th>Description</th>
                <th>e-Flier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $sn = 1;
            foreach($all_events as $event){
                $date_format = strtotime($event["event_date"]);
                $date_format2 = strtotime($event["event_time"]);
        ?>
        <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $event["event_name"]; ?></td>
            <td><?php echo date("F, d, Y", $date_format); ?></td>
            <td><?php echo date("g:i:a", $date_format2); ?></td>
            <td><?php echo $event["event_location"]; ?></td>
            <td class="text-truncate" style="max-width: 150px;"><?php echo $event["event_desc"]; ?></td>
            <td class="text-truncate" style="max-width: 150px;"><?php echo $event["event_flier"]; ?></td>

            <td>
                <div class="d-inline-flex">
                    <a href="edit_event.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-warning btn-sm mx-1">Edit</a>
                    <a href="process/delete_event.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                </div>
            </td>

        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>

    <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
