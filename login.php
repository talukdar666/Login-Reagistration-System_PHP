<?php
session_start();

if (isset($_SESSION["authenticated"])) {
    $_SESSION['status'] = "You are already signed in";
    header("location: dashboard.php");
    exit();
}


$page_title = "Login Form";
include("include/header.php");
include("include/navbar.php");
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-6">

                <?php if (isset($_SESSION['status'])) : ?>
                    <div class="alert alert-success">
                        <h5><?= $_SESSION['status']; ?></h5>
                    </div>
                <?php unset($_SESSION['status']);
                endif ?>

                <div class="card">
                    <div class="card-header bg-dark text-light text-center shadow">
                        <h4>Login Form</h4>
                    </div>
                    <div class="card-body">

                        <form action="login-store.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="pass">Password</label>
                                <input type="password" id="pass" name="pass" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Sign in</button>

                                <a href="password-reset.php" class="float-end">Forgot Password?</a>
                            </div>
                        </form>
                        <hr>
                        <h5>
                            Did not recieve your Varification Email?
                            <a href="resend-email.php">Resend</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("include/footer.php"); ?>