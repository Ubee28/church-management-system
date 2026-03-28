<?php 
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/utility.php");
    require_once("../classes/Pastor.php");

    $pastor = new Pastor;

    if(isset($_POST['btn_pst'])){
        $fullname = sanitize_input($_POST["fullname"]);
        $email    = sanitize_input($_POST["email"]);
        $address  = sanitize_input($_POST["address"]);
        $phone = sanitize_input($_POST["phone"]);
        $pass1 = sanitize_input($_POST["pwd1"]);
        $pass2 = sanitize_input($_POST["pwd2"]);

        $available = $pastor->check_email($email);
        if(($pass1 != $pass2) || empty($pass1)){
            $_SESSION['errormsg'] = 'The two passwords must match and must not be blank';
            header("location:../registerPastor.php");
            exit();
        }elseif($available){
            $_SESSION['errormsg'] = 'The email is taken';
            header("location:../registerPastor.php");
            exit();
        }elseif(empty($fullname) || empty($pass1) || empty($email)){
            $_SESSION['errormsg'] = 'Please ensure you supply your firstname, lastname and email.';
            header("location:../registerPastor.php");
        }else{
            $pastor->register($fullname,$email,$phone,$address,$pass1);
            $_SESSION['good_msg'] = "An account has been created for you, pls login";
            header("location:../pastor_login.php");
            exit();
        }

    }else{
        $_SESSION['errormsg'] = 'Please complete the form';
        header("location:../registerPastor.php");
        exit();
    }




?>