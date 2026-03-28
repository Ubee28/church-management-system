<?php
session_start();
// require_once "guest_guard.php";

include_once "partials/header.php";


?>

  <!-- about-->
  <div class="row" style="margin-top: 100px">
    <div class="col-md-10 offset-md-1">
      <h3 style="margin-bottom:30px;" class="text-center heading-title"> CREATE ACCOUNT</h3>
     
  </div>
</div>
<div class="row" style="padding-bottom: 25px">

<div class="col-md-8 offset-md-2">
<?php 
  if(isset($_SESSION['errormsg'])){
    echo "<div class='alert alert-danger'>". $_SESSION['errormsg']. "</div>";
    unset($_SESSION['errormsg']);

  };
?>
    <form action="process/process_regM.php" method="post">
        <div class="row mb-3">
          <label for="fname" class="col-sm-2 col-form-label">Firstname</label>
          <div class="col-sm-4">
            <input type="text" name="fname" class="form-control noround border-dark" id="fname">
          </div>
          <label for="lname" class="col-sm-2 col-form-label">Lastname</label>
          <div class="col-sm-4">
            <input type="text" name="lname" class="form-control noround border-dark" id="lname">
          </div>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-4">
              <input type="text" name="email" class="form-control noround border-dark" id="email">
              <span id="email_feedback"></span>
            </div>
            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-4">
              <input type="text" name="phone" class="form-control noround border-dark" id="phone">
            </div>
          </div>

            <div class="row mb-3">

                <label for="date of birth" class="col-sm-2 col-form-label">Date of Birth</label>
                <div class="col-sm-4">
                <input type="date" name="dob" class="form-control noround border-dark" id="dob">
                </div>


                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-4">
                <input type="text" name="address" class="form-control noround border-dark" id="address">
                </div>
            </div>

        <div class="row mb-3">
            <label for="pass1" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-4">
              <input type="password" name="pass1" class="form-control noround border-dark" id="password">
            </div>
            <label for="pass2" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-4">
              <input type="password" name="pass2" class="form-control noround border-dark" id="pass2">
            </div>
          </div>
       
     
        <div class="row mb-3">
            
            <div class="col-sm-12 text-center">
                <button type="submit" name="btnregister" id="btnregister" value="1" class="btn btn-success col-6 noround">Sign Up</button>
            </div>
          </div>
       
       
      </form>

 
</div>
</div>
  <!-- end about-->
   
 
 
 
<div class="row bg-dark text-white">
  <div class="col">
    <p class="text-center my-3"> &copy; 2024 Developed By Me</p>
  </div>
</div>

<?php
     include_once "partials/footer.php";
     ?>