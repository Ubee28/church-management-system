<?php
session_start();
require_once "memberguard.php";
require_once "classes/Member.php";

$member = new Member;
$member_data = $member->get_member_by_id($_SESSION['member_id']);

include_once "partials/header.php";
?>


    <div class="row" style="margin: 70px 0px 295px 0px">
        <?php 
            require_once "partials/menu.php";
        
        ?>
<div class="col-md-9 p-3">
    
    <!-- Profile-->
   <div class="row">
       <div class="col-md-12 my-3">
           <h5 class="my-3">Profile Update </h5>
     <form>
       <div class="row mb-3">
           
         <label for="fname" class="col-sm-2 col-form-label">First Name</label>
         <div class="col-sm-4">
           <input type="text" name="fname" class="form-control noround border-dark" id="fname">
         </div>
         <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
         <div class="col-sm-4">
           <input type="text" name="lname" class="form-control noround border-dark" id="lname">
         </div>
       </div>
       <div class="row mb-3">
         <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
         <div class="col-sm-4">
           <input type="text" name="phone" class="form-control noround border-dark" id="phone">
         </div>
         <label for="gender" class="col-sm-2 col-form-label">Gender</label>
         <div class="col-sm-4">
             <select class="form-select noround border-dark" aria-label="Default select example" name="gender" id="gender">
                 <option selected>Please Select</option>
                 <option value="1">Female</option>
                 <option value="2">Male</option> 
               </select>
         </div>
          
         </div>
      
         <div class="row mb-3">
          
           <label for="intro" class="col-sm-2 col-form-label">Your Intro</label>
           <div class="col-sm-10">
               <textarea id="intro" name="intro" class="form-control border-dark noround"></textarea>
           </div>
         </div>
      
    
       <div class="row mb-3">
           
           <div class="col-sm-12 text-center">
               <button type="submit" class="btn btn-danger col-6 noround">Update Account</button>
           </div>
         </div>
      
      
      </form>


       </div>
   </div>
   <!-- End profile-->

</div>
    </div>

    <!-- Footer -->
    <div class="row bg-dark text-white" style="position:fixed; bottom: 1px; left:0; right:0;">
            <div class="col">
                <p class="text-center my-3 "> &copy; 2024 Developed By Me</p>
            </div>
    </div>

</div>
 