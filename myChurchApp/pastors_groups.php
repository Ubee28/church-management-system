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
                 <!-- Teams/Groups Section -->
                <div class="card my-4">
                    <div class="card-header">
                        <h2>Teams/Groups</h2>
                    </div>
                    <div class="card-body">
                        <p>Overview of groups led by the pastor, member lists, and recent activities.</p>
                        <ul class="list-group">
                            <li class="list-group-item">Group 1 - <a href="#">View Details</a></li>
                            <li class="list-group-item">Group 2 - <a href="#">View Details</a></li>
                            <!-- Repeat for other groups -->
                        </ul>
                    </div>
                </div>

            </div>
    </div>

    <!-- Footer -->
    <div class="row bg-dark text-white" style="position:fixed; bottom: 0; left:0; right:0;">
            <div class="col">
                <p class="text-center my-3 "> &copy; 2024 Developed By Me</p>
            </div>
    </div>

</div>
