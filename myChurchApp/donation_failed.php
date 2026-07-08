<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Failed</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body text-center p-5">

                    <div class="display-1 mb-3">
                        ❌
                    </div>

                    <h2 class="fw-bold mb-3">
                        Donation Unsuccessful
                    </h2>

                    <p class="text-muted mb-4">
                        We were unable to confirm your donation payment.
                        No worries—you can try again.
                    </p>

                    <?php if(isset($_SESSION['reference'])){ ?>
                        <p class="small text-muted">
                            Reference:
                            <strong>
                                <?php echo htmlspecialchars($_SESSION['reference']); ?>
                            </strong>
                        </p>
                    <?php } ?>

                    <div class="d-grid gap-3 mt-4">

                        <a href="payment.php"
                           class="btn btn-primary btn-lg">
                            Try Again
                        </a>

                        <a href="donate.php"
                           class="btn btn-outline-secondary">
                            Back to Donation Page
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>