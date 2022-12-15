<?php
session_start();
$page_title = "Password Reset";
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
                    <div class="card-header bg-dark text-center text-danger">
                        <h4>Password Reset</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="reset-code.php" method="POST">
                            <div class="form-group mb-3 text-center">
                                <label for="email"><b>Email Address</b></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your registered Email here...">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary ">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>