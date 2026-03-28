<?php
session_start();

require_once "classes/Sermon.php";
require_once "adminguard.php";

$sermon = new Sermon();
$all_sermons = $sermon->fetch_all_sermons(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Sermons</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container mt-5">
    <h1>All Sermons</h1>
    
    <!-- Sermon Table with Edit/Delete Actions -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Sermon Title</th>
                    <th>Preacher</th>
                    <th>Date</th>
                    <th>Audio File</th>
                    <th>Video File</th>
                    <th>Transcript</th>
                    <th>Outline</th>
                    <th>Sermon Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sn = 1;
                foreach ($all_sermons as $sermon) {
                    $date_format = strtotime($sermon["sermon_date"]);
                ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo htmlspecialchars($sermon["sermon_title"]); ?></td>
                    <td><?php echo htmlspecialchars($sermon["pastor_fullname"]); ?></td>
                    <td><?php echo date("F, d, Y", $date_format); ?></td>
                    <td class="text-truncate" style="max-width: 150px;">
                        <?php echo $sermon["sermon_audio"] ? htmlspecialchars($sermon["sermon_audio"]) : 'N/A'; ?>
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">
                        <?php echo $sermon["sermon_video"] ? htmlspecialchars($sermon["sermon_video"]) : 'N/A'; ?>
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">
                        <?php echo $sermon["transcript"] ? htmlspecialchars($sermon["transcript"]) : 'N/A'; ?>
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">
                        <?php echo $sermon["sermon_outline"] ? htmlspecialchars($sermon["sermon_outline"]) : 'N/A'; ?>
                    </td>
                    <td><?php echo ucfirst($sermon["sermon_type"]); ?></td>
                    <td>
                        <div class="d-inline-flex">
                            <a href="edit_sermon.php?sermon_id=<?php echo $sermon['sermon_id']; ?>" class="btn btn-warning btn-sm mx-1">Edit</a>
                            <a href="process/delete_sermon.php?sermon_id=<?php echo $sermon['sermon_id']; ?>" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure you want to delete this sermon?');">Delete</a>
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
