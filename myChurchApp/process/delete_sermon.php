<?php
session_start();
require_once "../classes/Sermon.php"; 
require_once "../classes/utility.php";

$sermon = new Sermon();

if (isset($_GET['sermon_id'])) {
    $sermon_id = sanitize_input($_GET['sermon_id']);

    // Call the delete method
    $delete_result = $sermon->delete_sermon($sermon_id);

    if ($delete_result) {
        $_SESSION['success_msg'] = "Sermon deleted successfully.";
    } else {
        $_SESSION['error_msg'] = "Error deleting sermon.";
    }
} else {
    $_SESSION['error_msg'] = "No sermon ID provided.";
}

header("location: ../all_sermons.php"); // Redirect back to the all sermons page
exit();
