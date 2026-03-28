<?php
session_start();
require_once "../classes/Sermon.php";
require_once "../classes/utility.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # Required fields
    $sermon_id = $_POST['sermon_id']?? null;
    $pastor_id = $_POST['pastor_id']?? null;
    $sermon_date = sanitize_input($_POST['sermon_date']) ?? "";
    $sermon_type = sanitize_input($_POST['sermon_type'] ) ?? "";

    # Optional fields
    $sermon_title = sanitize_input($_POST['sermon_title']) ?? "";
    $sermon_audio = sanitize_input($_POST['sermon_audio']) ?? "";
    $sermon_video = sanitize_input($_POST['sermon_video']) ?? "";
    $transcript = sanitize_input($_POST['transcript']) ?? "";
    $sermon_outline = sanitize_input($_POST['sermon_outline']) ?? "";
    

    // Validate required fields
    if (empty($sermon_id) || empty($sermon_title) || empty($pastor_id) || empty($sermon_date) || empty($sermon_type)) {
        $_SESSION['error_msg'] = "Please fill in all required fields.";
        header("Location: ../edit_sermon.php?sermon_id=$sermon_id");
        exit();
    }

    // Instantiate Sermon class and update record
    $sermon = new Sermon();
    $result = $sermon->update_sermon(
        $sermon_id,
        $sermon_title,
        $pastor_id,
        $sermon_date,
        $sermon_audio,
        $sermon_video,
        $transcript,
        $sermon_outline,
        $sermon_type
    );

    if ($result) {
        $_SESSION['success_msg'] = "Sermon updated successfully!";
        header("Location: ../all_sermons.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Failed to update sermon. Please try again.";
        header("Location: ../edit_sermon.php?sermon_id=$sermon_id");
        exit();
    }
} else {
    $_SESSION['error_msg'] = "Invalid request method.";
    header("Location: ../all_sermons.php");
    exit();
}
