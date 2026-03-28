<?php
  session_start();
  include_once "partials/header.php";
?>
 
<!-- about -->

  <div class="row" style="margin-top: 120px">
    <div class="col-md-10 offset-md-1">
      <h3 style="margin-bottom:30px;" class="text-center heading-title"> LOGIN</h3>
    </div>
  </div>

  <div class="row" style="padding-bottom: 50px;">
    <div class="col-md-8 offset-md-2">
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
      <form action="process/process_login.php" method="post">
        
        <div class="row mb-3">
          <label for="email" class="form-label">Email address</label>
          <div class="col-sm-12">
          <input type="email" class="form-control border-dark noround" name="email" id="email" aria-describedby="emailHelp">
          </div>
        </div>

        <div class="row mb-3">
          <label for="pass" class="form-label">Password</label>
          <div class="col-sm-12">
          <input type="password" class="form-control border-dark noround" id="pass" name="pass">
          </div>
        </div>

        <div class="mb-3 form-check">
          <input type="radio" class="form-check-input" value="1" id="member" name="usertype">
          <label class="form-check-label" for="tourist">Member</label>          
        </div>
        <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" value="2" id="pastor" name="usertype">
            <label class="form-check-label" for="center">Pastor</label>          
          </div>

        <div class="row mb-3 text-center">
          <div class="col-sm-12">
          <button type="submit" name="btnlogin" value="1" class="btn btn-danger col-6 noround">Login</button>
          </div>
        </div>

      </form>

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
