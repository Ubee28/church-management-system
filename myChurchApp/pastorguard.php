<?php
if (!isset($_SESSION['pastor_id'])) {
    $_SESSION['errormsg'] = "You must be logged in to access the page";
    header("location: pastor_login.php");
    exit();
}
?>
