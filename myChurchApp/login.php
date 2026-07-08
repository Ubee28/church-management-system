<?php
  session_start();
  include_once "partials/header.php";
?>
 
<!-- about -->

<div class="container">

    <div class="row mt-5 pt-5">
        <div class="col-12">
            <h3 class="text-center heading-title mb-4">
                LOGIN
            </h3>
        </div>
    </div>

    <div class="row pb-5 justify-content-center">

        <div class="col-12 col-md-10 col-lg-6">

            <?php
            if(isset($_SESSION['errormsg'])){
                echo "<div class='alert alert-danger'>".$_SESSION['errormsg']."</div>";
                unset($_SESSION['errormsg']);
            }

            if(isset($_SESSION['good_msg'])){
                echo "<div class='alert alert-success'>".$_SESSION['good_msg']."</div>";
                unset($_SESSION['good_msg']);
            }
            ?>

            <form action="process/process_login.php" method="post" class="border rounded p-4 shadow-sm">

                <!-- Email -->

                <div class="mb-3">

                    <label for="email" class="form-label">
                        Email Address
                    </label>

                    <input
                        type="email"
                        class="form-control border-dark noround"
                        id="email"
                        name="email">

                </div>

                <!-- Password -->

                <div class="mb-3">

                    <label for="pass" class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        class="form-control border-dark noround"
                        id="pass"
                        name="pass">

                </div>

                <!-- User Type -->

                <div class="mb-4">

                    <label class="form-label d-block">
                        Login As
                    </label>

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="radio"
                            name="usertype"
                            value="1"
                            id="member">

                        <label class="form-check-label" for="member">
                            Member
                        </label>

                    </div>

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="radio"
                            name="usertype"
                            value="2"
                            id="pastor">

                        <label class="form-check-label" for="pastor">
                            Pastor
                        </label>

                    </div>

                </div>

                <!-- Button -->

                <div class="d-grid">

                    <button
                        type="submit"
                        name="btnlogin"
                        value="1"
                        class="btn btn-danger noround">

                        Login

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- end about -->




<!-- Footer -->
<div class="row bg-dark text-white" style="position:fixed; bottom: 0; left:0; right:0;">
  <div class="col">
    <p class="text-center my-3">&copy; 2024 Developed By Me</p>
 </div>
</div>


<?php
  include_once "partials/footer.php";
?>
