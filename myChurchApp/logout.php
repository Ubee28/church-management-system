<?php
    session_start();
    require_once("classes/Member.php");
    $member = new Member;
    $member->signout();
    $_SESSION['good_msg'] = "You have successfully logged out...";
    header("location:login.php");

?>