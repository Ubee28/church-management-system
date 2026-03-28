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
            <div class="col-md-9 p-3">
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
    <div class="row bg-dark text-white" style="position:fixed; bottom: 0; left:0; right:0;">
            <div class="col">
                <p class="text-center my-3 "> &copy; 2024 Developed By Me</p>
            </div>
    </div>

</div>
 