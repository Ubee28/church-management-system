<?php
    session_start();
    require_once("../../classes/utility.php");
    require_once("../class/Admin.php");
    error_reporting(E_ALL);

    $admin = new Admin;
   

    if(isset($_POST["btn_admin"])){
        $fullname = sanitize_input($_POST["fullname"]);
        $email = sanitize_input($_POST["email"]);
        $pwd1 = sanitize_input($_POST["pwd1"]);
        $pwd2 = sanitize_input($_POST["pwd2"]);
    
        $available = $admin->check_email($email);
        
        // we will process
        if(($pwd1 != $pwd2) || empty($pwd1) || empty($pwd2)){
            $_SESSION['errormsg'] = 'The two passwords must match and must not be blank';
        header("location:../../create_admin.php");
        exit();
        }elseif($available){
            $_SESSION['errormsg'] = 'The email is taken';
            header("location:../../create_admin.php");
            exit();
        }elseif(empty($fullname) || empty($email)){
            $_SESSION['errormsg'] = 'Please ensure to fill your fullname and email.';
            header("location:../../create_admin.php");
            exit();
        }else{//everything is okay proceed to register
            //send welcome email
            $admin->register($fullname,$email,$pwd1);
            $_SESSION['good_msg'] = "An account has been created for you, pls login";
            header("location:../../admin_login.php");
            exit();
        }



    }else{
        $_SESSION['errormsg'] = 'Please complete the form';
        header("location:../create_admin.php");
        exit();
    }
    


?>