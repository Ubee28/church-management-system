<?php session_start();
require_once "classes/Member.php";
require_once "adminguard.php";
require_once "classes/utility.php";

$member = new Member();

if(isset($_GET['member_id'])){
    $member_id = sanitize_input($_GET['member_id']);

    // Fetch member details
    $member_data = $member->get_member_by_id($member_id);

    if(!$member_data){
        $_SESSION['error_msg'] = "Member not found.";
        header("Location: all_members.php");
        exit;
    }} else {
        $_SESSION['error_msg'] = "No member ID provided.";
        header("Location: all_members.php");
        exit;
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<?php
    if (isset($_SESSION['error_msg'])) {
        echo "<div class='alert alert-danger'>". $_SESSION['error_msg']. "</div>";
        unset($_SESSION['error_msg']);
    }
?>
    <h1>Edit Member</h1>

    <!-- Edit Member Form -->
    <form method="POST" action="process/pro_edit_member.php">
        <div class="mb-3">
            <label for="member_fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="member_fname" name="member_fname" value="<?php echo htmlspecialchars($member_data['member_fname']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="member_lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="member_lname" name="member_lname" value="<?php echo htmlspecialchars($member_data['member_lname']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="member_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="member_email" name="member_email" value="<?php echo htmlspecialchars($member_data['member_email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="member_phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="member_phone" name="member_phone" value="<?php echo htmlspecialchars($member_data['member_phone']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="member_dob" class="form-label">Date Of Birth</label>
            <input type="date" class="form-control" id="member_dob" name="member_dob" value="<?php echo htmlspecialchars($member_data['member_dob']); ?>"required>
        </div>

        <div class="mb-3">
            <label for="member_address" class="form-label">Address</label>
            <input type="text" class="form-control" id="member_address" name="member_address" value="<?php echo htmlspecialchars($member_data['member_address']); ?>">
        </div>

        <input type="hidden" name="member_id" value="<?php echo isset($member_data['member_id']) ? htmlspecialchars($member_data['member_id']) : ''; ?>">

        <button type="submit" class="btn btn-success">Update Record</button>
        <a href="all_members.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
