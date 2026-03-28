<?php
session_start();

include_once "partials/header.php";

?>



        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5 shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mt-3">Create Account</h3>
                    </div>
                    <div class="card-body p-4">

                    <?php 
                        if(isset($_SESSION['errormsg'])){
                            echo "<div class='alert alert-danger'>". $_SESSION['errormsg']. "</div>";
                            unset($_SESSION['errormsg']);

                        };
                    ?>
                        <form action="process/process_regP.php" method="post">
                            
                            <div class="row">
                                <!-- Full Name input -->
                                <div class="mb-3 col-md-6">
                                    <label for="fullname" class="form-label">Fullname</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name">
                                </div>
                            

                                <!-- Email input -->
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                                    <span id="email_response"></span>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Phone number input -->
                                <div class="mb-3 col-md-6">
                                    <label for="Phone number" class="form-label">Phone number</label>
                                    <input type="text" class="form-control" id="Phone number" name="Phone number " placeholder="Enter Phone number">
                                </div>
                            

                                <!-- Address input -->
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                                    <span id="email_response"></span>
                                </div>

                            </div>

                            
                            <div class="row">
                                <!-- Password input -->
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="pwd1" name="pwd1" placeholder="Enter password">
                                </div>
                            
                                <!--Confirm Password input -->
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="Enter password">
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="d-grid">
                                <button type="submit" id="btn_pst" name="btn_pst" class="btn btn-primary">Submit</button>
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
   