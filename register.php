<?php
session_start();
$page_title = "Register Form";
include("include/header.php");
include("include/navbar.php");
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="alert">
                    <?php
                    if (isset($_SESSION['status'])) {
                        echo "<h4>" . $_SESSION['status'] . "</h4>";
                        unset($_SESSION['status']);
                    }
                    ?>
                </div>
                <div class="card">
                    <div class="card-header bg-dark text-light text-center shadow">
                        <h4>Registration Form</h4>
                    </div>
                    <div class="card-body">

                        <form action="register-Store.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="userName">Name</label>
                                <input type="text" id="userName" name="userName" required class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="number" id="phone" name="phone" required class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" required class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="pass">Password</label>
                                <input type="password" id="pass" name="pass" required class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" required class="btn btn-primary">Register Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("include/footer.php"); ?>