<?php
session_start();
require_once("../classes/Member.php");
require_once("../classes/Pastor.php");
require_once "../classes/utility.php";

$member = new Member;
$pastor = new Pastor;

// Check if form was submitted
if (isset($_POST['btnlogin'])) {
    // Retrieve form data
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['pass']);
    $usertype = isset($_POST['usertype']) ? $_POST['usertype'] : "";

    // Check for empty email or password
    if (empty($email) || empty($password) || empty($usertype)) {
        $_SESSION['errormsg'] = 'Please ensure you choose user-type and supply your email and password.';
        header("location:../login.php");
        exit();
    } elseif($usertype == 1){//Member
        // Attempt to log in the user
        $login_result = $member->login($email, $password);

        // If login is successful, store member_id in session
        if ($login_result > 0) {
            $_SESSION['member_id'] = $login_result; // Store member_id in session
            $_SESSION['success_msg'] = "Login successful! Welcome, member.";
            header("location: ../member_dashboard.php");
            exit();
        } else {
            // Login failed, redirect to login page
            header("location: ../login.php");
            exit();
        }
    }elseif($usertype == 2){//Pastor
        $result = $pastor->login($email, $password);
        if ($result > 0) {
            $_SESSION['pastor_id'] = $result; // Store member_id in session
            $_SESSION['success_msg'] = "Login successful! Welcome, pastor.";
            header("location: ../pastor_dashboard.php");
            exit();
        } else {
            // Login failed, redirect to login page
            header("location: ../login.php");
            exit();
        }

    }
} else {
    $_SESSION['errormsg'] = "Please complete the form.";
    header("location: ../login.php");
    exit();
}
?>
