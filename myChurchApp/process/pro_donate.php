<?php 

    session_start();
    require_once "../classes/utility.php";
    require_once "../classes/Paystack.php";
    require_once "../classes/Donation.php";
    require_once "../classes/DonationPurpose.php";


    $paystack = new Paystack();
    

    $donation = new Donation();
    $payment_method = "card";
    $status         = "pending";

    $donationPurpose = new DonationPurpose();

    

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    // Retrieve form data
    $member_id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : null;
    $donor_name = sanitize_input($_POST['fullname']);
    $donor_email    = sanitize_input($_POST['email']);
    $donor_phone = sanitize_input($_POST['phoneNumber']);
    $purpose = isset ($_POST['donatePurpose']) ? sanitize_input($_POST['donatePurpose']) : ""; 
    $amount = sanitize_input($_POST['donationAmount']);
    $textAreaMsg = sanitize_input($_POST['textAreaMsg']);
    $is_anonymous = isset($_POST['anonymousDonor']) ? 1 : 0;

    //check for empty email
    if(empty($donor_name) || empty($donor_email) || empty($donor_phone) || empty($purpose) || empty($amount)){
        $_SESSION['errormsg'] = 'Please confirm you supplied your fullname, email, phone number, donation purpose and amount';
        header("location:../donate.php");
        exit();
    }

    if(!$donationPurpose->is_valid_purpose($purpose)){

        $_SESSION['errormsg'] = "Please select a valid donation purpose.";

        header("Location: ../donate.php");
        exit();
    }else{

        
        $reference = $paystack->generateReference();

        $result = $donation->create_donations(
            $member_id,
            $donor_name,
            $donor_email,
            $donor_phone,
            $purpose,
            $amount,
            $is_anonymous,
            $payment_method,
            $status,
            $textAreaMsg,
            $reference
        );

        if(!$result){
            $_SESSION['errormsg'] = "Unable to create donation recors.";
            header("location: ../donate.php");
            exit();
        }

        $_SESSION['reference'] = $reference;

        $_SESSION['donation'] = [
            'member_id'     =>  $member_id,
            'donor_name'     => $donor_name,
            'donor_email'    => $donor_email,
            'donor_phone'    => $donor_phone,
            'purpose'        => $purpose,
            'amount'         => $amount,
            'textAreaMsg'    => $textAreaMsg,
            'payment_method' => $payment_method,
            'status'        => $status,
            'is_anonymous'   => $is_anonymous,
            'reference'      => $reference
        ];

        header("location: ../payment.php");
        exit();
    }

}else {
    $_SESSION['errormsg'] = "Please fill the form to proceed.";
    header("location:../donate.php");
    exit();
}






?>