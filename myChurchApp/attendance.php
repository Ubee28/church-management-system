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
    
                <!-- Attendance Section -->
                        <div id="attendance" class="row mt-4">
                            <h2>Attendance</h2>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Attendance Records</h5>
                                        <button class="btn btn-success mb-3">Add Attendance</button>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Attendance ID</th>
                                                <th>Member ID</th>
                                                <th>Event ID</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            Example Row 
                                            <tr>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>5</td>
                                                <td>2024-09-01</td>
                                                <td>Present</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm">Edit</button>
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
