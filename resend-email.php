<?php
session_start();
$page_title = "Resend Form";
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
                    <div class="crad-header bg-dark text-danger text-center shadow">
                        <h4>Resend Email Varification</h4>
                    </div>
                    <div class="card-body">
                        <form action="resend-code.php" method="POST">
                            <div class="form-group mb-3 text-center">
                                <label for="email" class="">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email here">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "include/footer.php"; ?>