<?php
session_start();
require_once "memberguard.php";
require_once "classes/Member.php";
require_once "classes/Donation.php";

$member = new Member;
$member_data = $member->get_member_by_id($_SESSION['member_id']);
$donation = new Donation();
$donations = $donation->getMemberDonations($_SESSION['member_id']);
$summary = $donation->getMemberDonationSummary($_SESSION['member_id']);

include_once "partials/header.php";
?>


    <div class="row" style="margin: 70px 0px 295px 0px">
        <?php 
            require_once "partials/menu.php";
        
        ?>
            <div class="col-md-9 p-3">
                <!-- For the Dashboard-->
                
                <div class="row">
                    <div class="col-md-12">
                      
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5>My Donations</h5>
                            </div>

                            <div class="card-body table-responsive">

                                <table class="table table-hover">

                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Purpose</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php foreach($donations as $d){ ?>

                                        <tr>

                                            <td>
                                                <?php echo date(
                                                    "d M Y",
                                                    strtotime($d['created_at'])
                                                ); ?>
                                            </td>

                                            <td>
                                                <?php echo $d['purpose']; ?>
                                            </td>

                                            <td>
                                                ₦<?php echo number_format($d['amount']); ?>
                                            </td>

                                            <td>

                                                <?php

                                                if($d['status'] == 'successful'){
                                                    echo '<span class="badge bg-success">Successful</span>';
                                                }
                                                elseif($d['status'] == 'pending'){
                                                    echo '<span class="badge bg-warning">Pending</span>';
                                                }
                                                else{
                                                    echo '<span class="badge bg-danger">Failed</span>';
                                                }

                                                ?>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <h6>Total Donations</h6>

                        <h3>
                            ₦<?php echo number_format(
                                $summary['total_amount']
                            ); ?>
                        </h3>

                        <small>
                            <?php echo $summary['total_donations']; ?>
                            successful donations
                        </small>

                    </div>
                </div>
                <!-- End the Dashboard-->

            </div>
    </div>

    <!-- Footer -->
    <div class="row bg-dark text-white" style="position:fixed; bottom: 0; left:0; right:0;">
            <div class="col">
                <p class="text-center my-3 "> &copy; 2024 Developed By Me</p>
            </div>
    </div>

</div>
 