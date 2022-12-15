<?php
include "authentication.php";
$page_title = "Dashboard";
include("include/header.php");
include("include/navbar.php");

?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <?php if (isset($_SESSION['status'])) : ?>
                    <div class="alert alert-success">
                        <h5><?= $_SESSION['status']; ?></h5>
                    </div>
                <?php unset($_SESSION['status']);
                endif ?>

                <div class="card">
                    <div class="card-header bg-dark shadow text-light text-center">
                        <h4>Dashboard</h4>
                    </div>
                    <div class="card-body text-center pd-4">
                        <h3>hi, <span class="text-light bg-danger rounded-3">user</span></h3>
                        <h1>Welcome <span class="text-danger "><?= $_SESSION['auth-user']['name']; ?></span></h1>
                        <p>Below is your data:</p>
                        <p>Email : <?= $_SESSION['auth-user']['email'] ?></p>
                        <p>Phone : <?= $_SESSION['auth-user']['phone'] ?></p>
                        <a class="btn btn-dark" href="url.php/index.php">Short-URL</a>
                        <a class="btn btn-dark" href="task.php/index.php">Add Task</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>