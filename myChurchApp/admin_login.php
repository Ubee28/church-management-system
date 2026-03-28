<?php   
session_start();

include_once "partials/header.php";

?>



        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow" style="margin-top: 80px;">
                    <div class="card-header bg-dark text-white text-center">
                        <h3 class="mt-5">Admin Login</h3>
                    </div>
                    <div class="card-body p-4">

                    <?php 
                        if (isset($_SESSION['errormsg'])) {
                        echo "<div class='alert alert-danger'>". $_SESSION['errormsg']. "</div>";
                        unset($_SESSION['errormsg']);
                        }

                        if (isset($_SESSION['good_msg'])) {
                        echo "<div class='alert alert-success'>". $_SESSION['good_msg']. "</div>";
                        unset($_SESSION['good_msg']);
                        }
                    ?>
                        <form action="Admin/process/pro_login_admin.php" method="post">
                            <!-- Email input -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                            </div>

                            <!-- Password input -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                            </div>

                            <!-- Submit button -->
                            <div class="d-grid">
                                <button type="submit" name="btnlogin" class="btn btn-dark">Login</button>
                            </div>
                        </form>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-center">
                        <small>&copy; 2024 Developed by Me</small>
                    </div>
                </div>
            </div>
        </div>
   <?php 
   
   include_once "Admin/partials/admin_footer.php";
   
   ?>
