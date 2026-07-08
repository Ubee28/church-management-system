
<?php 

    session_start();

    include_once "partials/header.php";

    


?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-sm text-center rounded-4">

                <div class="card-body p-5">

                    <div
                        class="mx-auto mb-4 d-flex align-items-center justify-content-center rounded-circle"
                        style="
                        width:100px;
                        height:100px;
                        background:#e8f7ee;
                        font-size:50px;">

                        ✓

                    </div>

                    <h2 class="fw-bold mb-3">
                        Donation Successful
                    </h2>

                    <p class="text-muted mb-4">

                        Thank you for your generosity.

                        Your contribution helps support
                        ministry work and community outreach.

                    </p>

                    <div class="border rounded-4 p-4 text-start">

                        <p>
                            <strong>Reference:</strong>
                            <?php echo $_SESSION['donation']['reference'] ?>
                        </p>

                        <p>
                            <strong>Amount:</strong>
                            ₦<?php echo number_format($_SESSION['donation']['amount']); ?>
                        </p>

                        <p>
                            <strong>Purpose:</strong>
                            <?php echo $_SESSION['donation']['purpose'] ?>
                        </p>

                    </div>

                    <div class="d-flex gap-3 justify-content-center mt-4">

                        <a
                            href="#"
                            class="btn btn-outline-primary">

                            Download Receipt

                        </a>

                        <a
                            href="index.php"
                            class="btn text-white"
                            style="background:#5A44E0;">

                            Return Home

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>