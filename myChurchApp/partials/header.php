<?php

    // Define the base path dynamically
    $basePath = str_repeat('../', substr_count($_SERVER['PHP_SELF'], '/') - 2);
   


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo $basePath; ?>assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $basePath; ?>assets/Fa/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $basePath; ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="Admin/assets/css/admin_d.css">
    <link rel="stylesheet" type="text/css" href="assets/css/m_dash.css">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $basePath; ?>favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $basePath; ?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $basePath; ?>favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $basePath; ?>favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo $basePath; ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Remnant Christian Centre</title>
    
</head>
<body>
<div class="container-fluid">
<!-- Navbar -->
 <div class="row">
    <div class="col">

            <nav class="navbar navbar-expand-lg navbar-light sticky-navbar">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?php echo $basePath; ?>index.php">
                        <img src="<?php echo $basePath; ?>assets/images/Rcm(4).png" alt="RCM Logo">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $basePath; ?>index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $basePath; ?>about_us.php">About Us</a>
                            </li>
                            
                            <?php
                            if (!isset($_SESSION['member_id']) && !isset($_SESSION['admin_id']) && !isset($_SESSION['pastor_id'])) {
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="memberDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Register
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="memberDropdown" style="border-radius: 12px;background-color: #13357B;"> 
                                        <li class="dropdown-item"><a class="nav-link" href="<?php echo $basePath; ?>registerMember.php">As a Member</a></li>
                                        <li class="dropdown-item"><a class="nav-link" href="<?php echo $basePath; ?>registerPastor.php">As a Pastor</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo $basePath; ?>login.php">Login</a>
                                </li>
                            <?php
                            } elseif (isset($_SESSION['member_id'])) {
                            ?>
                                <li class="nav-item dropdown" style="margin-right: 25px;">
                                    <a class="nav-link dropdown-toggle" href="#" id="memberDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo $basePath; ?>assets/images/guide-1.jpg" width="30" style="border-radius: 50%;"> Hi <?php echo isset($member_data['member_fname']) ? $member_data['member_fname'] : "Member"; ?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="memberDropdown" style="border-radius: 12px;background-color: #13357B;">
                                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>member_dashboard.php">My Dashboard</a></li>
                                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>change_password.php">Change Password</a></li>
                                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            <?php
                            } elseif (isset($_SESSION['admin_id'])) {
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo $basePath; ?>assets/images/guide-1.jpg" width="30" style="border-radius: 50%;"> Hi Admin
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="adminDropdown" style="border-radius: 12px;background-color: #13357B;">
                                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>admin_dashboard.php">Admin Dashboard</a></li>
                                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>change_password.php">Change Password</a></li>
                                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>admin_logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            <?php
                            }elseif(isset($_SESSION['pastor_id'])){
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="pastorDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo $basePath; ?>assets/images/guide-1.jpg" width="30" style="border-radius: 50%;"> Hello Pastor
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="pastorDropdown" style="border-radius: 12px;background-color: #13357B;">
                                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>pastor_dashboard.php">Pastor Dashboard</a></li>
                                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>change_password.php">Change Password</a></li>
                                        <li><a class="dropdown-item" href="<?php echo $basePath; ?>pastor_logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>

    </div>
 </div>

<!-- end of Navbar -->
