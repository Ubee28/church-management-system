<?php
session_start();
require_once "memberguard.php";
require_once "classes/Member.php";

$member = new Member;
$member_data = $member->get_member_by_id($_SESSION['member_id']);

include_once "partials/header.php";
?>


    <div class="row" style="margin: 70px 0px 295px 0px">
        <?php 
            require_once "partials/menu.php";
        
        ?>
            <div class="col-md-9 p-3 mb-0">
                <!-- For the Dashboard-->
                
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="my-3">Welcome <?php echo $member_data['member_fname']; ?></h5>
                        <p>You are logged in, please make use of the side menu to carry out tasks on this platform, you can log out when you are done.</p>
                    
                    </div>
                </div>
                <!-- End the Dashboard-->

            </div>
    </div>

     <!-- Footer -->
    <div style="position: fixed; bottom: 0; left: 0; right: 0; height: 60px; background-color: #343a40; color: white;">
        <div class="text-center my-auto" style="line-height: 60px;">&copy; 2024 Developed By Me</div>
    </div>

</div>
 

<!-- Announcements Modal -->
<!-- <div class="modal fade" id="announcementsModal" tabindex="-1" aria-labelledby="announcementsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementsModalLabel">Announcements</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>No announcements available.</p>
            </div>
        </div>
    </div>
</div> -->

<!-- <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script> -->
