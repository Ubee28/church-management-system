<?php
 require_once("../classes/Member.php");
 require_once "../classes/utility.php";
 $u = new Member;
 
 // Retrieve the email
 if (isset($_GET['email'])) {
    
     $email = sanitize_input($_GET['email']);
     $check = $u->check_email($email);
 
     if ($check) {
         echo "Email has been taken";
     } else {
         echo "Email is available";
     }
 }else{
     echo "No email provided.";
 }

    


?>