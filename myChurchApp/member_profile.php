<?php
session_start();
require_once "memberguard.php";
require_once "classes/Member.php";

$member = new Member;
$member_data = $member->get_member_by_id($_SESSION['member_id']);

include_once "partials/header.php";
?>


<div class="container">

    <div class="row mt-5 pt-5">

        <?php require_once "partials/menu.php"; ?>

        <div class="col-md-9">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <h3 class="text-center heading-title mb-4">
                        MY PROFILE
                    </h3>

                    <form class="border rounded shadow-sm p-4">

                        <!-- First & Last Name -->

                        <div class="row mb-3">

                            <div class="col-md-6">

                                <label for="fname" class="form-label">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    id="fname"
                                    name="fname"
                                    class="form-control border-dark noround">

                            </div>

                            <div class="col-md-6">

                                <label for="lname" class="form-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    id="lname"
                                    name="lname"
                                    class="form-control border-dark noround">

                            </div>

                        </div>

                        <!-- Phone & Gender -->

                        <div class="row mb-3">

                            <div class="col-md-6">

                                <label for="phone" class="form-label">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control border-dark noround">

                            </div>

                            <div class="col-md-6">

                                <label for="gender" class="form-label">
                                    Gender
                                </label>

                                <select
                                    id="gender"
                                    name="gender"
                                    class="form-select border-dark noround">

                                    <option selected>
                                        Please Select
                                    </option>

                                    <option value="Male">
                                        Male
                                    </option>

                                    <option value="Female">
                                        Female
                                    </option>

                                </select>

                            </div>

                        </div>

                        <!-- Intro -->

                        <div class="mb-4">

                            <label for="intro" class="form-label">
                                Your Introduction
                            </label>

                            <textarea
                                id="intro"
                                name="intro"
                                rows="5"
                                class="form-control border-dark noround"></textarea>

                        </div>

                        <!-- Button -->

                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-danger noround">

                                Update Profile

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Footer -->

<div class="row bg-dark text-white mt-5">

    <div class="col">

        <p class="text-center my-4">
            &copy; 2026 Developed By Me
        </p>

    </div>

</div>
 