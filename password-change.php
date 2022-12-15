<?php
session_start();
$page_title = "Password Change";
include "db.php";
include "include/header.php";
include "include/navbar.php";
?>


<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <?php if (isset($_SESSION['status'])) : ?>
                    <div class="alert alert-success">
                        <h5><?= $_SESSION['status']; ?></h5>
                    </div>
                <?php unset($_SESSION['status']);
                endif ?>

                <div class="card">
                    <div class="card-header bg-dark text-center text-info">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="reset-code.php" method="POST">

                            <input type="hidden" name="token" value="<?php if (isset($_GET['token'])) {
                                                                            echo $_GET['token'];
                                                                        } ?>">

                            <div class="form-group mb-3">
                                <label for="email"><b>Email Address</b></label>
                                <input type="email" name="email" id="email" value="<?php if (isset($_GET['email'])) {
                                                                                        echo $_GET['email'];
                                                                                    } ?>" placeholder="Enter email address" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="new-pass"><b>New Password</b></label>
                                <input type="text" name="new-pass" id="new-pass" placeholder="Enter new Password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="c-pass"><b>Confirm Password</b></label>
                                <input type="text" name="c-pass" id="c-pass" placeholder="Confirm new Password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="submit_2" id="submit" class="btn btn-warning w-100">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>