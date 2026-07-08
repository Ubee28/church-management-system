
<?php 
    session_start();
    require_once "classes/Config.php";
    include_once "partials/header.php";

    $donation = $_SESSION['donation'];

    $amount = $donation['amount'];
    $email = $donation['donor_email'];
    $name = $donation['donor_name'];
    $reference = $donation['reference'];




  




?>


<div class="container py-5">

    <div class="row g-4">

        <!-- LEFT SECTION -->

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4 p-lg-5">

                    <h2 class="fw-bold">
                        Complete Your Donation
                    </h2>

                    <p class="text-muted mb-5">
                        Review your donation details and choose a payment method.
                    </p>

                    <!-- PAYMENT METHODS -->

                    <h5 class="fw-semibold mb-3">
                        Select Payment Method
                    </h5>

                    <div class="row g-3 mb-5">

                        <div class="col-md-4">
                            <input
                                class="btn-check"
                                type="radio"
                                name="paymentMethod"
                                id="card"
                                checked>

                            <label
                                class="btn btn-outline-primary w-100 py-3"
                                for="card">

                                💳 Card Payment

                            </label>
                        </div>

                        <div class="col-md-4">
                            <input
                                class="btn-check"
                                type="radio"
                                name="paymentMethod"
                                id="transfer">

                            <label
                                class="btn btn-outline-primary w-100 py-3"
                                for="transfer">

                                🏦 Bank Transfer

                            </label>
                        </div>

                        <div class="col-md-4">
                            <input
                                class="btn-check"
                                type="radio"
                                name="paymentMethod"
                                id="ussd">

                            <label
                                class="btn btn-outline-primary w-100 py-3"
                                for="ussd">

                                📱 USSD

                            </label>
                        </div>

                    </div>

                    <!-- DONATION DETAILS -->

                    <div class="card border rounded-4">

                        <div class="card-body">

                            <h5 class="mb-4">
                                Donation Details
                            </h5>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">
                                        Full Name
                                    </label>

                                    <p class="fw-semibold">
                                      <?php echo $_SESSION['donation']['donor_name']; ?> 
                                    </p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">
                                        Email
                                    </label>

                                    <p class="fw-semibold">
                                     <?php echo $_SESSION['donation']['donor_email']; ?> 
                                    </p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">
                                        Donation Purpose
                                    </label>

                                    <p class="fw-semibold">
                                       <?php echo $_SESSION['donation']['purpose']; ?> 
                                    </p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">
                                        Anonymous
                                    </label>

                                    <p class="fw-semibold">
                                        <?php echo $_SESSION['donation']['is_anonymous'] ? 'Yes' : 'No' ?> 
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div id="cardSection">

                        <div class="alert border rounded-4 mt-4">

                            <h5>Card Payment</h5>

                            <p class="mb-2">
                                You will be redirected to Paystack to complete your donation securely.
                            </p>

                            
                        
                                <button type="button"
                                    id="payButton"
                                    class="btn w-100 text-white fw-semibold py-3"
                                    style="background-color:#5A44E0;">

                                    Pay ₦<?php echo number_format($_SESSION['donation']['amount']); ?> Securely

                                </button>

                            

                        </div>

                    </div>



                <div id="bankSection" class="d-none">

                    <div class="card border rounded-4 mt-4">

                        <div class="card-body">

                            <h5>Bank Transfer Details</h5>

                            <div class="mb-3">
                                <strong>Bank Name:</strong><br>
                                Access Bank
                            </div>

                            <div class="mb-3">
                                <strong>Account Name:</strong><br>
                                Remnant Christian Centre
                            </div>

                            <div class="mb-3">
                                <strong>Account Number:</strong><br>
                                0123456789
                            </div>

                            <div class="mb-3">
                                <strong>Amount:</strong><br>

                                ₦<?php echo number_format($_SESSION['donation']['amount']); ?>
                            </div>

                            <div class="mb-3">
                                <strong>Reference:</strong><br>

                                DON-<?php echo date("Ymd"); ?>-001
                            </div>

                            <button
                                class="btn btn-outline-primary">

                                Copy Account Number

                            </button>

                        </div>

                    </div>

                </div>



                <div id="ussdSection" class="d-none">

                    <div class="card border rounded-4 mt-4">

                        <div class="card-body">

                            <h5>USSD Payment</h5>

                            <p>

                                Transfer

                                <strong>
                                    ₦<?php echo number_format($_SESSION['donation']['amount']); ?>
                                </strong>

                                using your bank's USSD code.

                            </p>

                            <div class="mb-3">

                                <strong>Reference:</strong><br>

                                DON-<?php echo date("Ymd"); ?>-001

                            </div>

                            <div class="alert alert-light">

                                Example:

                                <br>

                                *901*1*0123456789*<?php echo $_SESSION['donation']['amount']; ?>#

                            </div>

                        </div>

                    </div>

                </div>

                    <!-- SECURITY -->

                    <!-- <div class="alert mt-4 border rounded-4">

                        <div class="d-flex align-items-center">

                            <div class="me-3 fs-3">
                                🔒
                            </div>

                            <div>

                                <h6 class="mb-1">
                                    Secure Payment
                                </h6>

                                <small>
                                    Payments are processed securely through Paystack.
                                </small>

                            </div>

                        </div>

                    </div> -->

                    <!-- PAYSTACK BUTTON -->
<!-- 
                    <form  action="payment_success.php" method="post">
                        
                        <button type="submit"
                            id=""
                            class="btn w-100 mt-4 text-white fw-semibold py-3"
                            style="background-color:#5A44E0;">

                            Pay ₦<?php  echo $_SESSION['donation']['amount'] ?> Securely

                        </button>

                    </form> -->
                        

                </div>

            </div>

        </div>

        <!-- RIGHT SECTION -->

        <div class="col-lg-4 mt-5">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <h4 class="fw-bold mb-4">
                        Donation Summary
                    </h4>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Purpose</span>
                         <strong> <?php echo $_SESSION['donation']['purpose'] ?>  </strong> 
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Amount</span>
                        ₦<?php echo number_format($_SESSION['donation']['amount']); ?>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <h5>Total</h5>

                        <h4
                            class="fw-bold"
                            style="color:#5A44E0;">

                            ₦<?php echo number_format($_SESSION['donation']['amount']); ?>

                        </h4>

                    </div>

                </div>

            </div>

            <!-- SECURITY CARD -->

            <div class="card border-0 shadow-sm rounded-4 mt-4">

                <div class="card-body">

                    <h5>
                        Trust & Security
                    </h5>

                    <ul class="list-unstyled mt-3">

                        <li class="mb-3">
                            ✓ SSL Secured Transactions
                        </li>

                        <li class="mb-3">
                            ✓ Powered by Paystack
                        </li>

                        <li class="mb-3">
                            ✓ Instant Donation Confirmation
                        </li>

                        <li>
                            ✓ Receipt Sent By Email
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

            const cardRadio = document.getElementById('card');
            const transferRadio = document.getElementById('transfer');
            const ussdRadio = document.getElementById('ussd');

            const cardSection = document.getElementById('cardSection');
            const bankSection = document.getElementById('bankSection');
            const ussdSection = document.getElementById('ussdSection');

            function switchPaymentUI(){

                cardSection.classList.add('d-none');
                bankSection.classList.add('d-none');
                ussdSection.classList.add('d-none');

                if(cardRadio.checked){

                    cardSection.classList.remove('d-none');

                }else if(transferRadio.checked){

                    bankSection.classList.remove('d-none');

                }else if(ussdRadio.checked){

                    ussdSection.classList.remove('d-none');

                }

            }

            cardRadio.addEventListener('change', switchPaymentUI);
            transferRadio.addEventListener('change', switchPaymentUI);
            ussdRadio.addEventListener('change', switchPaymentUI);

            switchPaymentUI();

</script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    

document
.getElementById('payButton')
.addEventListener('click', payWithPaystack);

function payWithPaystack(){

    let handler = PaystackPop.setup({

        key: '<?php echo PAYSTACK_PUBLIC_KEY; ?>',

        email: '<?php echo $email; ?>',

        amount: <?php echo $amount * 100; ?>,

        currency: 'NGN',

        ref: '<?php echo $reference; ?>',

        metadata: {

            custom_fields: [

                {
                    display_name: "Donor Name",
                    variable_name: "donor_name",
                    value: "<?php echo addslashes($name); ?>"
                }

            ]

        },

        callback: function(response){

            window.location.href =
                "process/paystack_callback.php?reference=" +
                response.reference;

        },

        onClose: function(){

            alert(
                'Transaction was not completed.'
            );

        }

    });

    handler.openIframe();

}

</script>


<?php 


  include_once "partials/footer.php";

 

    

?>