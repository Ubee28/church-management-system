<?php 
session_start();
require_once "../classes/Member.php";
require_once "../classes/utility.php";

$member = new Member();

// Handle for submission for editing
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $member_fname = sanitize_input($_POST['member_fname']);
            $member_lname = sanitize_input($_POST['member_lname']);
            $member_email = sanitize_input($_POST['member_email']);
            $member_phone = sanitize_input($_POST['member_phone']);
            $member_dob = sanitize_input($_POST['member_dob']);
            $member_address = sanitize_input($_POST['member_address']);
            $member_id = sanitize_input($_POST['member_id']);

            // Update event details

            $update_result = $member->update_member($member_fname, $member_lname, $member_email, $member_phone, $member_dob, $member_address, $member_id);

            if ($update_result) {
                $_SESSION['success_msg'] = "<strong>Member Record Updated Successfully.</strong>";
                header("Location: ../all_members.php");
            } else {
                $_SESSION['error_msg'] = "Error Updating Member.";
                header("location: ../edit_member.php?member_id=" . $member_id);
                exit();
            }


        }else {
            $_SESSION['error_msg'] = "Invalid request method.";
            header("Location: ../all_members.php");
            exit();
        }



?>