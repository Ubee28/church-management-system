<?php
require_once("../classes/Admin.php");

$admin = new Admin;

if (isset($_GET['email'])) {
   
// $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    $email = $_GET['email'];
    $available = $admin->check_email($email);

    if ($available) {
        echo "Email has been taken";
    } else {
        echo "Email is available";
    }
} else {
    echo "No email provided";
}
