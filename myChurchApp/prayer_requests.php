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
            
            <!-- Notes/Journal Section -->
            <div class="card my-1">
                <div class="card-header">
                    <h2>Notes/Journal</h2>
                </div>
                <div class="card-body">
                    <form action="save_note.php" method="POST">
                        <div class="mb-3">
                            <label for="note" class="form-label">New Note</label>
                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Note</button>
                    </form>
                    <!-- List of saved notes -->
                    <h5 class="mt-4">Previous Notes</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Reflection on Sermon A</li>
                        <li class="list-group-item">Plan for Upcoming Meeting</li>
                        <!-- Repeat for other notes -->
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
