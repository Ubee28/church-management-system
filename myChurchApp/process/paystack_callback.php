<?php

session_start();

require_once "../classes/Paystack.php";
require_once "../classes/Donation.php";

if(!isset($_GET['reference'])){
    die("Invalid Request");
}

$reference = $_GET['reference'];

$paystack = new Paystack();

$donation = new Donation();

$result = $paystack->verifyPayment($reference);

if(
    $result['status'] &&
    $result['data']['status'] === 'success'
){

    $donation->updateDonationStatus(
        $reference,
        'successful'
    );

    header("Location: ../donation_success.php");
    exit();

}else{

    $donation->updateDonationStatus(
        $reference,
        'failed'
    );

    header("Location: ../donation_failed.php");
    exit();
}