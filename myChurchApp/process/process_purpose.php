<?php

session_start();

require_once "../classes/DonationPurpose.php";

$purpose = new DonationPurpose();


// ADD PURPOSE
if(isset($_POST['btnAddPurpose'])){

    $purpose_name = trim($_POST['purpose_name']);
    $description = trim($_POST['description']);

    $result = $purpose->add_purpose(
    $purpose_name,
    $description
    );

    if(!$result){

        $_SESSION['errormsg'] =
            "Donation purpose already exists.";

    }else{

        $_SESSION['good_msg'] =
            "Donation purpose added successfully.";

    }

    header("Location: ../admin_dashboard.php#donationPurposes");
    exit();
}


// UPDATE PURPOSE
if(isset($_POST['btnUpdatePurpose'])){

    $purpose_id = $_POST['purpose_id'];

    $purpose_name = trim($_POST['purpose_name']);

    $description = trim($_POST['description']);

    $purpose->update_purpose(

        $purpose_id,

        $purpose_name,

        $description

    );

    $_SESSION['good_msg'] = "Donation purpose updated.";

    header("Location: ../admin_dashboard.php#donationPurposes");

    exit();

}


// ACTIVATE

if(isset($_GET['action']) && $_GET['action']=="activate"){

    $purpose->activate($_GET['id']);

    $_SESSION['good_msg']="Donation purpose activated.";

    header("Location: ../admin_dashboard.php#donationPurposes");

    exit();

}


// DEACTIVATE

if(isset($_GET['action']) && $_GET['action']=="deactivate"){

    $purpose->deactivate($_GET['id']);

    $_SESSION['good_msg']="Donation purpose deactivated.";

    header("Location: ../admin_dashboard.php#donationPurposes");

    exit();

}