<?php
session_start();
require_once "memberguard.php";
require_once "classes/Member.php";

$member = new Member;
$member_data = $member->get_member_by_id($_SESSION['member_id']);

include_once "partials/header.php";
?>

<div class="row" style="margin: 70px 0px 295px 0px">
    <?php require_once "partials/menu.php"; ?>
    <div class="col-md-9 p-3">
        <!-- Dashboard Section -->
        <div class="row">
            <div class="col-md-12">

                <!-- Filter and Search Bar Section -->
                <div class="card mb-3">
                    <div class="card-header">Filter Sermons</div>
                    <div class="card-body">
                        <form id="filter-sermons-form" class="row">
                            <!-- Month Picker -->
                            <div class="col-md-4">
                                <label for="month-picker" class="form-label">Select Month</label>
                                <input type="month" id="month-picker" name="month" class="form-control">
                            </div>

                            <!-- Search Bar -->
                            <div class="col-md-6">
                                <label for="search-sermons" class="form-label">Search</label>
                                <input type="text" id="search-sermons" name="search" class="form-control" placeholder="Search by title, preacher...">
                            </div>

                            <!-- Filter Button -->
                            <div class="col-md-2">
                                <label class="form-label d-block">&nbsp;</label>
                                <button type="button" id="filter-sermons-btn" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sermons Section -->
                <div class="card mb-3">
                    <div class="card-header">Available Sermons</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Preacher</th>
                                        <th>Date</th>
                                        <th>Audio</th>
                                        <th>Video</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody id="sermon-table-body">
                                <?php
                                    // Fetch Sermons from the Database
                                    require_once("classes/Sermon.php");
                                    $sermon = new Sermon;
                                    $sermons = $sermon->fetch_sermons_with_audio_id(); 

                                    
                                    // Updated Member Sermons Table
                                    foreach ($sermons as $ser) {
                                        // Generate the direct download link for the audio file
                                        $audioDownloadLink = "https://drive.google.com/uc?export=download&id={$ser['audio_file_id']}";
                                    
                                        echo "<tr>";
                                        echo "<td>{$ser['sermon_title']}</td>";
                                        echo "<td>{$ser['pastor_fullname']}</td>";
                                        echo "<td>{$ser['sermon_date']}</td>";
                                        echo "<td><a href='https://drive.google.com/file/d/{$ser['audio_file_id']}/view' target='_blank' class='btn btn-info'>Listen</a></td>";
                                        

                                        

                                        echo "<td><a href='{$ser['sermon_video']}' target='_blank' class='btn btn-success'>Watch</a></td>";
                                    
                                        // Use the audio file ID for the download link
                                        if (!empty($ser['audio_file_id'])) {
                                            echo "<td><a href='{$audioDownloadLink}' class='btn btn-primary' download>Download</a></td>";
                                        } else {
                                            echo "<td><span class='text-danger'>Unavailable</span></td>";
                                        }
                                    
                                        echo "</tr>";
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="row bg-dark text-white" style="position:fixed; bottom: 1px; left:0; right:0;">
    <div class="col">
        <p class="text-center my-3 "> &copy; 2024 Developed By Me</p>
    </div>
</div>

<script src="assets/js/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#filter-sermons-btn").on("click", function () {
            const month = $("#month-picker").val();
            const search = $("#search-sermons").val();
            
            $.ajax({
                url: "process/fetch_sermons.php", // Create this file to handle filtering logic
                type: "GET",
                data: { month, search },
                success: function (response) {
                    $("#sermon-table-body").html(response);
                },
                error: function () {
                    alert("An error occurred while filtering sermons.");
                },
            });
        });
    });
</script>
