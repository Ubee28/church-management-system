<?php
session_start();
require_once "pastorguard.php"; 
require_once "classes/Pastor.php";

$pastor = new Pastor;
$pastor_data = $pastor->get_pastor_by_id($_SESSION['pastor_id']);

require_once "partials/header.php";

?>

<div class="row" style="margin: 70px 0px 295px 0px">
        <?php 
            require_once "partials/pastor_menu.php";
        
        ?>
            <div class="col-md-9 p-3 mb-0">
                <!-- For the Dashboard-->
                
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="my-3">Welcome <?php echo $pastor_data['pastor_fullname']; ?></h5>
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
