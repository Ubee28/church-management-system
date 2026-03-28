<?php
session_start();

include_once "partials/header.php";

?>



        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow" style="margin-top: 100px;">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mt-3" style="font-family: verdana;">Create Admin Account</h3>
                    </div>
                    <div class="card-body p-4">

                    <?php 
                        if(isset($_SESSION['errormsg'])){
                            echo "<div class='alert alert-danger'>". $_SESSION['errormsg']. "</div>";
                            unset($_SESSION['errormsg']);

                        };
                    ?>
                        <form action="Admin/process/pro_create_admin.php" method="post">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Full Name input -->
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Fullname</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Email input -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                                        <span id="email_response"></span>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Password input -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="pwd1" name="pwd1" placeholder="Enter password">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Password input -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="Enter password">
                                    </div>
                                </div>

                            </div>
                            
                            <!-- Submit button -->
                            <div class="d-grid">
                                <button type="submit" id="btn_admin" name="btn_admin" class="btn btn-primary">Create Admin</button>
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
   