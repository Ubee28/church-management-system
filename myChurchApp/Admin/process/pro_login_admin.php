<?php 

session_start();
// if (isset($_SESSION['admin_id'])) {
//     var_dump($_SESSION['admin_id']);
// } else {
//     echo "No session set";
//     exit;
// }
require_once("../../classes/utility.php");
require_once("../class/Admin.php");
error_reporting(E_ALL);

$admin = new Admin;

if(isset($_POST['btnlogin'])){
$email = sanitize_input($_POST["email"]);
$password = sanitize_input($_POST["password"]);

    if(empty($email) || empty($password)){
        $_SESSION['errormsg'] = 'Please ensure you supply your email and password.';
        header("location: ../../admin_login.php");
        exit();
    }else{

    $success = $admin->login($email,$password);

        if($success > 0){
            $_SESSION['admin_id']= $success;
            header("location:../../admin_dashboard.php");
            exit();
        }else{
            header("location:../../admin_login.php");
            exit();
        }

    }
}else{
    $_SESSION['errormsg']="Please complete the form";
    header("location:../../admin_login.php");
    exit();

}




?>