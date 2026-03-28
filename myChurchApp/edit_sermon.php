<?php
session_start();
require_once "classes/Sermon.php";
require_once "classes/Pastor.php";
require_once "adminguard.php";
require_once "classes/utility.php";

$sermon = new Sermon();
$pastor = new Pastor();

if (isset($_GET['sermon_id'])) {
    $sermon_id = sanitize_input($_GET['sermon_id']);

    // Fetch sermon details
    $sermon_data = $sermon->get_sermon_by_id($sermon_id);

    if (!$sermon_data) {
        $_SESSION['error_msg'] = "Sermon not found.";
        header("location: all_sermons.php");
        exit();
    }

    // Fetch all pastors for the dropdown
    $pastors = $pastor->fetch_all_pastors();
} else {
    $_SESSION['error_msg'] = "No sermon ID provided.";
    header("location: all_sermons.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sermon</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <?php 
    if (isset($_SESSION['error_msg'])) {
        echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['error_msg']) . "</div>";
        unset($_SESSION['error_msg']);
    }

    if (isset($_SESSION['success_msg'])) {
        echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success_msg']) . "</div>";
        unset($_SESSION['success_msg']);
    }
    ?>
    <h1>Edit Sermon</h1>

    <!-- Edit Sermon Form -->
    <form method="POST" action="process/pro_edit_sermon.php">
        <!-- Sermon Title -->
        <div class="mb-3">
            <label for="sermon_title" class="form-label">Sermon Title</label>
            <input type="text" class="form-control" id="sermon_title" name="sermon_title" 
                   value="<?php echo isset($sermon_data['sermon_title']) ? htmlspecialchars($sermon_data['sermon_title']) : ''; ?>" required>
        </div>
        
        <!-- Preacher Dropdown -->
        <div class="mb-3">
            <label for="pastor_id" class="form-label">Preacher</label>
            <select class="form-select" id="pastor_id" name="pastor_id" required>
                <option value="">Select a Preacher</option>
                <?php foreach ($pastors as $pastor): ?>
                    <option value="<?php echo $pastor['pastor_id']; ?>" 
                            <?php echo (isset($sermon_data['pastor_id']) && $sermon_data['pastor_id'] == $pastor['pastor_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($pastor['pastor_fullname']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Sermon Date -->
        <div class="mb-3">
            <label for="sermon_date" class="form-label">Date</label>
            <input type="date" class="form-control" id="sermon_date" name="sermon_date" 
                   value="<?php echo isset($sermon_data['sermon_date']) ? htmlspecialchars($sermon_data['sermon_date']) : ''; ?>" required>
        </div>
        
        <!-- Audio URL -->
        <div class="mb-3">
            <label for="sermon_audio" class="form-label">Audio URL</label>
            <input type="text" class="form-control" id="sermon_audio" name="sermon_audio" 
                   value="<?php echo isset($sermon_data['sermon_audio']) ? htmlspecialchars($sermon_data['sermon_audio']) : ''; ?>">
        </div>
        
        <!-- Video URL -->
        <div class="mb-3">
            <label for="sermon_video" class="form-label">Video URL</label>
            <input type="text" class="form-control" id="sermon_video" name="sermon_video" 
                   value="<?php echo isset($sermon_data['sermon_video']) ? htmlspecialchars($sermon_data['sermon_video']) : ''; ?>">
        </div>
        
        <!-- Transcript -->
        <div class="mb-3">
            <label for="transcript" class="form-label">Transcript</label>
            <input type="text" class="form-control" id="transcript" name="transcript" 
                   value="<?php echo isset($sermon_data['transcript']) ? htmlspecialchars($sermon_data['transcript']) : ''; ?>">
        </div>
        
        <!-- Sermon Outline -->
        <div class="mb-3">
            <label for="sermon_outline" class="form-label">Sermon Outline</label>
            <input type="text" class="form-control" id="sermon_outline" name="sermon_outline" 
                   value="<?php echo isset($sermon_data['sermon_outline']) ? htmlspecialchars($sermon_data['sermon_outline']) : ''; ?>">
        </div>
        
        <!-- Sermon Type -->
        <div class="mb-3">
            <label for="sermon_type" class="form-label">Sermon Type</label>
            <select class="form-select" id="sermon_type" name="sermon_type" required>
                <option value="full" <?php echo (isset($sermon_data['sermon_type']) && $sermon_data['sermon_type'] === 'full') ? 'selected' : ''; ?>>Full</option>
                <option value="audio" <?php echo (isset($sermon_data['sermon_type']) && $sermon_data['sermon_type'] === 'audio') ? 'selected' : ''; ?>>Audio Only</option>
                <option value="outline" <?php echo (isset($sermon_data['sermon_type']) && $sermon_data['sermon_type'] === 'outline') ? 'selected' : ''; ?>>Outline Only</option>
            </select>
        </div>

        <!-- Hidden Sermon ID -->
        <input type="hidden" name="sermon_id" value="<?php echo isset($sermon_data['sermon_id']) ? htmlspecialchars($sermon_data['sermon_id']) : ''; ?>">

        <!-- Submit and Cancel Buttons -->
        <button type="submit" class="btn btn-success">Update Sermon</button>
        <a href="all_sermons.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
