<?php 
session_start();
require_once "../classes/Member.php";
require_once "../classes/utility.php";

$member = new Member;

if(isset($_GET['member_id'])){
    $member_id = sanitize_input($_GET['member_id']);

    $delete_result = $member->delete_member($member_id);
    if ($delete_result) {
        $_SESSION['success_msg'] = "Member deleted successfully.";
    } else {
        $_SESSION['error_msg'] = "Error deleting event.";
    }
}

header("location: ../all_members.php"); // Redirect back 
exit();


?>