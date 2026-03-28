<?php
    error_reporting(E_ALL);
    session_start();
    require_once("../classes/utility.php");
    require_once("../classes/Member.php");

    $member = new Member;

    if(isset($_POST['btnregister'])){
        $fname = sanitize_input($_POST["fname"]);
        $lname = sanitize_input($_POST["lname"]);
        $email = sanitize_input($_POST["email"]);
        $phone = sanitize_input($_POST["phone"]);
        $dob = sanitize_input($_POST["dob"]);
        $address = sanitize_input($_POST["address"]);
        $pass1 = sanitize_input($_POST["pass1"]);
        $pass2 = sanitize_input($_POST["pass2"]);

        $available = $member->check_email($email);
        // process
        if(($pass1 != $pass2) || empty($pass1)){
            $_SESSION['errormsg'] = 'The two passwords must match and must not be blank';
        header("location:../registerMember.php");
        exit();
        }elseif($available){
            $_SESSION['errormsg'] = 'The email is taken';
            header("location:../registerMember.php");
            exit();
        }elseif(empty($fname) || empty($lname) ||  empty($pass1) || empty($email)){
            $_SESSION['errormsg'] = 'Please ensure you supply your firstname, lastname and email.';
            header("location:../registerMember.php");
            exit();
        }else{//everything is okay proceed to register
            //send welcome email
            $member->register($fname,$lname,$email,$phone,$dob,$address,$pass1);
            $_SESSION['good_msg'] = "An account has been created for you, pls login";
            header("location:../login.php");
            exit();
        }



    }else{
        $_SESSION['errormsg'] = 'Please complete the form';
        header("location:../registerMember.php");
        exit();
    }
    


?>