<?php 
session_start();

include_once "partials/header.php";

require_once "classes/DonationPurpose.php";

$donationPurpose = new DonationPurpose();
?>





<div class="row mx-lg-5 mx-3 border rounded-3 align-items-center" style="margin-top:70px">
    
    <div class="col-12  col-lg-4 py-5 px-4 px-lg-5">
            
                <h6 class="">Support Our Ministry </h6>
                <h2 class="">Give with Purpose</h2>
                <h2 class="">Impact Eternally</h2>
                <p>Your generosity helps us reach more people,
                    serve the community, and build God's Kingdom. 
                </p>

                <button class="btn" style="background-color: #5A44E0; color: white;" onclick="makeDonation()">
                    Make a donation
                </button>
             
            
            
    </div>
    <div class="col-12 col-lg-8 "  style="border-radius: 20px;">
            <img src="assets/images/worship2.png" class="hero-img" alt="worship image">
    </div>

</div>

<h5 class="# mt-4" style="text-align: center;">Your Donation Makes a Difference</h5>

<!-- IMPACT CARDS SECTION -->

<div class="row mx-lg-5 mx-3 mt-3 g-4">

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex flex-column align-items-center">

              <button class="rounded-circle p-3" type="button" style="background-color: #8475E6; border: none;">
                    <img src="assets/images/Icons/community.svg" class="img-fluid dPageIcons" alt="" >
              </button> 

              <h5 class="card-title mt-3 text-center">Community Outreach</h5>
              <p class="card-text text-center">Helping families and individuals in need</p> 
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex flex-column align-items-center">

              <button class="rounded-circle p-3" type="button" style="background-color: #14B481; border: none;">
                    <img class="" src="assets/images/Icons/church2.svg" class="img-fluid dPageIcons" alt="">
              </button> 

              <h5 class="card-title mt-3 text-center">Building Projects</h5>
              <p class="card-text text-center">Constructing facilities for worship and ministry</p> 
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex flex-column align-items-center">

              <button class="rounded-circle p-3" type="button" style="background-color: #F9BE0A; border: none;">
                    <img src="assets/images/Icons/wellbeing.svg" class="img-fluid dPageIcons" alt="">
              </button> 

              <h5 class="card-title mt-3 text-center">Welfare Support</h5>
              <p class="card-text text-center">Supporting widows, orphans and the less privledged</p> 
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex flex-column align-items-center">

              <button class="rounded-circle p-3" type="button" style="background-color: #4E88EF; border:none;">
                    <img src="assets/images/Icons/globe.svg" class="img-fluid dPageIcons" alt="">
              </button> 

              <h5 class="card-title mt-3 text-center">Missions & Evangelism</h5>
              <p class="card-text text-center">Spreading the gospel locally and globally</p> 
            </div>
        </div>
        
    </div>

</div>

<div class="row mx-lg-5 mx-3 mt-5 g-4">
    <div class="col-12 col-lg-6">
        <h5>Make a Donation</h5>
         <?php 
        if (isset($_SESSION['errormsg'])) {
          echo "<div class='alert alert-danger'>". $_SESSION['errormsg']. "</div>";
          unset($_SESSION['errormsg']);
        }

      ?>
        <form action="process/pro_donate.php" method="post" id="donationForm" class="border rounded-3 p-3 p-md-5 needs-validation" novalidate>
             <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your fullname" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                    Please enter your fullname 
                </div>
            
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                    Please enter your email address 
                </div>

                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="phoneNumber" placeholder="Enter your phone number" id="phoneNumber" required>
                <div class="invalid-feedback">
                    Please enter your phone number 
                </div>
            </div>

            <div class="mb-3">
                <label for="Donation" class="form-label">Donation purpose</label>
                <select
                class="form-select"
                name="donatePurpose"
                aria-label="Default select example"
                id="Donation"
                required>

                    <option value="">
                        Select Donation Purpose
                    </option>

                    <?php

                    $purposes = $donationPurpose->fetch_active_purposes();

                    foreach($purposes as $purpose){

                    ?>

                        <option
                            value="<?php echo htmlspecialchars($purpose['purpose_name']); ?>">

                            <?php echo htmlspecialchars($purpose['purpose_name']); ?>

                        </option>

                    <?php

                    }

                    ?>

                </select>
                <div class="invalid-feedback">
                   Please select a donation purpose.
                </div>
            </div>
           
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <div class="input-group">
                    <span class="input-group-text">&#8358;</span>
                    <input type="number" class="form-control" id="amount" name="donationAmount" placeholder="Enter amount" required>
                    <div class="invalid-feedback">
                       Please enter a donation amount.
                    </div>
                </div>
                
            </div>
           

            <div class="mb-3">
                <label for="Textarea" class="form-label">Message/ Prayer Request (Optional)</label>
                <textarea class="form-control" name="textAreaMsg" id="Textarea" rows="3" placeholder="write your message.."></textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="anonymousDonor" value="1" id="CheckBox" style="border: 2px solid #5A44E0;">
                <label class="form-check-label" for="CheckBox">Make this donation anonymous</label>
            </div>

            <div class="d-grid">
                <button type="submit" id="donateBtn" name="btnDonate" class="btn" style="background-color: #5A44E0; color: white;">proceed to secure payment  <img src="assets/images/Icons/unlock.svg" style="width: 18px;" alt="secure lock icon"></button>
            </div>
        </form>
    </div>
            <!-- Quick Amounts Section -->
    <div class="col-12 col-lg-6">
            <h5>Quick Amount Options</h5>
            <h6>Choose an amount or enter a custom value</h6>


            <div class="row g-3">

                <div class="col-6 col-md-4">
                    <button type="button"
                        class="btn btn-outline-secondary fs-4 quickAmtBtns" 
                        style=" --bs-btn-hover-bg:#5A44E0; --bs-btn-hover-border-color:#5A44E0; --bs-btn-hover-color:#fff;"
                        onclick="setAmount(1000)">
                        ₦1,000
                    </button>
                </div>

                <div class="col-6 col-md-4">
                    <button type="button"
                        class="btn btn-outline-secondary fs-4 quickAmtBtns" 
                        style=" --bs-btn-hover-bg:#5A44E0; --bs-btn-hover-border-color:#5A44E0; --bs-btn-hover-color:#fff;"
                        onclick="setAmount(2000)">
                        ₦2,000
                    </button>
                </div>

                <div class="col-6 col-md-4">
                    <button type="button"
                        class="btn btn-outline-secondary fs-4 quickAmtBtns"
                        style=" --bs-btn-hover-bg:#5A44E0; --bs-btn-hover-border-color:#5A44E0; --bs-btn-hover-color:#fff;"
                        onclick="setAmount(5000)">
                        ₦5,000
                    </button>
                </div>

                <div class="col-6 col-md-4">
                    <button type="button"
                        class="btn btn-outline-secondary fs-4 quickAmtBtns"
                        style=" --bs-btn-hover-bg:#5A44E0; --bs-btn-hover-border-color:#5A44E0; --bs-btn-hover-color:#fff;"
                        onclick="setAmount(10000)">
                        ₦10,000
                    </button>
                </div>

                <div class="col-6 col-md-4">
                    <button type="button"
                        class="btn btn-outline-secondary fs-4 quickAmtBtns"
                        style=" --bs-btn-hover-bg:#5A44E0; --bs-btn-hover-border-color:#5A44E0; --bs-btn-hover-color:#fff;"
                        onclick="setAmount(20000)">
                        ₦20,000
                    </button>
                </div>

                <div class="col-6 col-md-4">
                    <button type="button"
                        class="btn btn-outline-secondary fs-4 quickAmtBtns"
                        style=" --bs-btn-hover-bg:#5A44E0; --bs-btn-hover-border-color:#5A44E0; --bs-btn-hover-color:#fff;"
                        onclick="customAmount()">
                        Custom
                    </button>
                </div>

            </div>

            
            <div class="row border rounded-3 p-3 mt-4 align-items-center">
                <h5 class="pt-3">Trust & Security</h5>
                <div class="col-12 col-md-8">
                    <ul class="list-unstyled">
                        <li class="mb-4"><img src="assets/images/Icons/paystack.svg" style="width: 30px;" alt="paystack icon"> Secure Payments Powered by Paystack</li>
                        <li class="mb-4"><img src="assets/images/Icons/ssl.svg" style="width: 35px;" alt="SSL icon"> SSL Secured Transactions</li>
                        <li class="mb-4"><img src="assets/images/Icons/insurance.svg" style="width: 35px" alt="insurance icon"> Instant Donation Confirmation</li>
                        <li><img src="assets/images/Icons/email.svg" style="width: 35px" alt="email icon"> Donation Receipt via Email</li>
                    </ul>
                </div>

                <div class="col-12 col-md-4 text-center mt-3 mt-md-0">
                     <img src="assets/images/Icons/paystack-2.svg" class="img-fluid" style="max-width:150px" alt="paystack logo">
                </div>
            </div>
            

    </div>
    
</div>

<!-- footer -->
    <footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="widget">
								<h3 class="widget-title">Our address</h3>
                                <p>Remnant Christian Centre is conveniently located at the heart of the city, making it easily accessible for everyone. Situated near major roads and public transport, our church is just a short distance from key neighborhoods and community hubs. Whether you're driving or using public transport, you’ll find our location both welcoming and convenient, ensuring that you can join us for worship, events, and community activities with ease.</p>
								<ul class="address">
									<li><i class="fa fa-map-marker"></i> 329 Church St, Garland, TX 75042</li>
									<li><i class="fa fa-phone"></i> (425) 853 442 552</li>
									<li><i class="fa fa-envelope"></i> info@yourchurch.com</li>
								</ul>
							</div>
						</div>
						<div class="col-md-4">
							<div class="widget">
								<h3 class="widget-title">Topics from last meeting</h3>
								<ul class="bullet">
									<li><a href="#">Faith in Uncertainty: Exploring how to trust God during challenging and uncertain times.</a></li>
									<li><a href="#">The Power of Forgiveness: Understanding the importance of forgiving others and ourselves in our spiritual journey</a></li>
									<li><a href="#">Living with Purpose: Discovering God's purpose for our lives and how to align our actions with that calling.</a></li> 
									<li><a href="#">Joy in Service: The blessings of serving others and how acts of kindness reflect God's love.</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-4">
							<div class="widget">
								<h3 class="widget-title">Contact form</h3>
								<form action="#" class="contact-form">
									<div class="row">
										<div class="col-md-6"><input type="text" placeholder="Your name..."></div>
										<div class="col-md-6"><input type="text" placeholder="Email..."></div>
									</div>
									
									<textarea name="" placeholder="Your message..."></textarea>
									<div class="text-right"><input type="submit" value="Send message"></div>
									
								</form>
							</div>
						</div>
					</div> <!-- .row -->

					<p class="colophon">Copyright 2014 RCM Church. All rights reserved.</p>
				</div><!-- .container -->
			</footer> <!-- .site-footer -->

<?php 

include_once "partials/footer.php";


?>

<script>
    function setAmount(amount) {
    document.getElementById('amount').value = amount;
}

function customAmount() {
    document.getElementById('amount').focus();
}

function makeDonation() {
        document.getElementById('amount').focus();    
}
</script>

<script>
    document.querySelectorAll(".quickAmtBtns, .quickPayBtns").forEach(function(btn){

    btn.addEventListener("click", function(){

        document.querySelectorAll(".quickAmtBtns, .quickPayBtns").forEach(function(button){

            button.classList.remove("btn-primary");
            button.classList.add("btn-outline-secondary");

        });

        this.classList.remove("btn-outline-secondary");
        this.classList.add("btn-primary");

    });

});
</script>

<script>

(() => {

    'use strict';

    const forms =
        document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {

        form.addEventListener('submit', event => {

            if(!form.checkValidity()){

                event.preventDefault();
                event.stopPropagation();

            }

            form.classList.add('was-validated');

        });

    });

})();

</script>

<script>
    const donationForm = document.getElementById("donationForm");

    if(donationForm){

        donationForm.addEventListener("submit", function(){

            const btn = document.getElementById("donateBtn");

            btn.disabled = true;

            btn.innerHTML = `
                <span class="spinner-border spinner-border-sm"></span>
                Redirecting...
            `;

        });

    }
</script>
