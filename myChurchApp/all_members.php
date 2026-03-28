<?php 
session_start();
require_once "classes/Member.php";
require_once "adminguard.php";


$member = new Member();
$all_members = $member->fetch_all_members();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
</head>
<body>

<div class="container mt-5">
<?php 
    
    if (isset($_SESSION['success_msg'])) {
        echo "<div class='alert alert-success'>". $_SESSION['success_msg']. "</div>";
        unset($_SESSION['success_msg']);
    }
    ?>
    <h1>All Members</h1>

    <!-- Filter and Search Bar Section -->
    <!-- <div class="card mb-3"> -->
                <!-- <div class="card-header">Filter Members</div> -->
                    <!-- <div class="card-body">
                        <form id="filter-members-form" class="row"> -->
                            <!-- Month Picker -->
                            <!-- <div class="col-md-4">
                                <label for="month-picker" class="form-label">Select Month</label>
                                <input type="month" id="month-picker" name="month" class="form-control">
                            </div> -->

                            <!-- Search Bar -->
                            <!-- <div class="col-md-6">
                                <label for="search-members" class="form-label">Search</label>
                                <input type="text" id="search-members" name="search" class="form-control" placeholder="Search by first name, last name...">
                            </div> -->

                            <!-- Filter Button -->
                            <!-- <div class="col-md-2">
                                <label class="form-label d-block">&nbsp;</label>
                                <button type="button" id="filter-members-btn" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </form>
                    </div>
                </div> -->

    
    <!-- Event Table with Edit/Delete Actions -->
     <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Full Name</th>
                <th>Date Of Birth</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $sn = 1;
            foreach($all_members as $member){
                $date_format = strtotime($member["member_dob"]);
                $date_format2 = strtotime($member["date_added"]);
        ?>
        <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $member["member_fname"] . " " .  $member["member_lname"]; ?></td>
            <td><?php echo date("F, d, Y", $date_format); ?></td>
            <td><?php echo $member["member_email"]; ?></td>
            <td><?php echo $member["member_phone"]; ?></td>
            <td><?php echo $member["member_address"]; ?></td>
            <td><?php echo date("F, d, Y", $date_format2); ?></td>
            <td>
                <div class="d-inline-flex">
                    <a href="edit_member.php?member_id=<?php echo $member['member_id']; ?>" class="btn btn-warning btn-sm mx-1">Edit</a>
                    <a href="process/delete_member.php?member_id=<?php echo $member['member_id']; ?>" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure you want to delete this member?');">Delete</a>
                </div>
            </td>

        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>

    <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
