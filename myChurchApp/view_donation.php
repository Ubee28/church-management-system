<?php

session_start();

require_once "classes/Donation.php";
require_once "adminguard.php";

if(!isset($_GET['donation_id'])){

    header("Location: all_donations.php");
    exit();

}

$donation = new Donation();

$details = $donation->fetch_donation_by_id($_GET['donation_id']);

if(!$details){

    $_SESSION['errormsg']="Donation not found.";

    header("Location: all_donations.php");

    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Donation Details</title>

    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card{

    border:none;
    border-radius:15px;

    }

    .display-4{

        font-weight:bold;

    }

 @media print {

    body {
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;
        max-width: 100%;
    }

    .card {
        border: none;
        box-shadow: none !important;
    }

    .no-print {
        display: none !important;
    }

    h1, h2, h3 {
        margin-bottom: 10px;
    }

    .row {
        margin-bottom: 8px !important;
    }

    hr {
        margin: 8px 0 !important;
    }

    .page-break {
        page-break-inside: avoid;
    }

}
    </style>

</head>

<body>

    <div class="container mt-4">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <div class="card shadow">

            <!-- Card Header -->
            <div class="card-header bg-primary text-white">

                <h3>Donation Details</h3>

            </div>

            <!-- Card Body -->
            <div class="card-body">

                <!-- Receipt Header -->
                <div class="text-center mb-4">

                    <h2 class="text-success">
                        ✓ Donation Details
                    </h2>

                    <p class="text-muted">
                        Remnant Christian Centre
                    </p>

                </div>

                <hr class="my-2">

                <!-- Donation Amount -->
                <div class="text-center mb-4">

                    <h2 class="fw-bold text-primary">
                        ₦<?php echo number_format($details['amount'], 2); ?>
                    </h2>

                    <?php if ($details['status'] == "successful") { ?>

                        <span class="badge bg-success fs-6">
                            Payment Successful
                        </span>

                    <?php } elseif ($details['status'] == "pending") { ?>

                        <span class="badge bg-warning text-dark fs-6">
                            Payment Pending
                        </span>

                    <?php } else { ?>

                        <span class="badge bg-danger fs-6">
                            Payment Failed
                        </span>

                    <?php } ?>

                </div>

                <hr class="my-2">

                <!-- Donor Information -->
                <div class="row mb-2">

                    <div class="col-md-4 fw-bold">
                        Donor
                    </div>

                    <div class="col-md-8">

                        <?php
                        echo $details['is_anonymous']
                            ? "Anonymous"
                            : htmlspecialchars($details['donor_name']);
                        ?>

                    </div>

                </div>

                <div class="row mb-2">

                    <div class="col-md-4 fw-bold">
                        Email
                    </div>

                    <div class="col-md-8">
                        <?php echo htmlspecialchars($details['donor_email']); ?>
                    </div>

                </div>

                <div class="row mb-2">

                    <div class="col-md-4 fw-bold">
                        Phone Number
                    </div>

                    <div class="col-md-8">
                        <?php echo htmlspecialchars($details['donor_phone']); ?>
                    </div>

                </div>

                <div class="row mb-2">

                    <div class="col-md-4 fw-bold">
                        Donation Purpose
                    </div>

                    <div class="col-md-8">
                        <?php echo htmlspecialchars($details['purpose']); ?>
                    </div>

                </div>

                <div class="row mb-2">

                    <div class="col-md-4 fw-bold">
                        Payment Method
                    </div>

                    <div class="col-md-8">
                        <?php echo ucfirst($details['payment_method']); ?>
                    </div>

                </div>

                <!-- Transaction Reference -->
                <div class="row mb-2">

                    <div class="col-md-4 fw-bold">
                        Transaction Reference
                    </div>

                    <div class="col-md-8">

                        <div class="input-group">

                            <input
                                type="text"
                                class="form-control"
                                id="reference"
                                value="<?php echo htmlspecialchars($details['reference']); ?>"
                                readonly>

                            <button
                                type="button"
                                class="btn btn-outline-primary"
                                onclick="copyReference()">

                                Copy

                            </button>

                        </div>

                    </div>

                </div>

                <!-- Donation Date -->
                <div class="row mb-2">

                    <div class="col-md-4 fw-bold">
                        Date
                    </div>

                    <div class="col-md-8">

                        <?php
                        echo date(
                            "F d, Y h:i A",
                            strtotime($details['created_at'])
                        );
                        ?>

                    </div>

                </div>

                <hr class="my-2">

                <!-- Prayer Request -->
                <h5 class="mb-3">
                    Prayer Request
                </h5>

                <div class="border rounded p-2 bg-light small mb-4">

                    <?php

                    if (!empty($details['prayer_request'])) {

                        echo nl2br(htmlspecialchars($details['prayer_request']));

                    } else {

                        echo "<span class='text-muted'>No prayer request.</span>";

                    }

                    ?>

                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4 no-print">

                    <button
                        type="button"
                        class="btn btn-success me-2"
                        onclick="printReceipt()">

                        Print Receipt

                    </button>

                    <a
                        href="all_donations.php"
                        class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </div> <!-- End Card Body -->

          </div> <!-- End Card -->
        </div> <!-- col-lg-8 div -->
      </div>  <!-- justify-content-center-div -->
    </div> <!-- End Container -->

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>

function copyReference(){

    const reference = document.getElementById("reference");

    navigator.clipboard.writeText(reference.value);

    alert("Reference copied successfully.");

}

function printReceipt(){

    window.print();

}

</script>

</body>

</html>