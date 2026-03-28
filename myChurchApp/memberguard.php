<?php
if (!isset($_SESSION['member_id'])) {
    $_SESSION['errormsg'] = "You must be logged in to access the page";
    header("location: login.php");
    exit();
}
?>
