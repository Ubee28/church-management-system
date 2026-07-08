<?php
session_start();

require_once "classes/Donation.php";
require_once "adminguard.php";

$donation = new Donation();

$all_donations = $donation->fetch_all_donations();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>All Donations</title>

    <link href="assets/bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">
        All Donations
    </h1>

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>S/N</th>
                    <th>Donor</th>
                    <th>Email</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

            <?php

            if(!empty($all_donations)){

                $sn = 1;

                foreach($all_donations as $d){

            ?>

                <tr>

                    <td><?php echo $sn++; ?></td>

                    <td>

                        <?php

                        echo $d['is_anonymous']
                        ? "Anonymous"
                        : htmlspecialchars($d['donor_name']);

                        ?>

                    </td>

                    <td>

                        <?php

                        echo htmlspecialchars($d['donor_email']);

                        ?>

                    </td>

                    <td>

                        <?php

                        echo htmlspecialchars($d['purpose']);

                        ?>

                    </td>

                    <td>

                        ₦<?php

                        echo number_format($d['amount'],2);

                        ?>

                    </td>

                    <td>

                        <?php

                        echo ucfirst($d['payment_method']);

                        ?>

                    </td>

                    <td>

                        <?php

                        if($d['status']=="successful"){

                            echo "<span class='badge bg-success'>Successful</span>";

                        }elseif($d['status']=="pending"){

                            echo "<span class='badge bg-warning text-dark'>Pending</span>";

                        }else{

                            echo "<span class='badge bg-danger'>Failed</span>";

                        }

                        ?>

                    </td>

                    <td>

                        <?php

                        echo date(
                            "F d, Y",
                            strtotime($d['created_at'])
                        );

                        ?>

                    </td>

                    <td>

                        <a
                            href="view_donation.php?donation_id=<?php echo $d['donation_id']; ?>"
                            class="btn btn-primary btn-sm">

                            View

                        </a>

                    </td>

                </tr>

            <?php

                }

            }else{

            ?>

                <tr>

                    <td colspan="9"
                        class="text-center">

                        No donations found.

                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>

    <a
        href="admin_dashboard.php"
        class="btn btn-secondary mb-3">

        Back to Dashboard

    </a>

</div>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>