<?php
session_start();
include "db.php";
$table = "information";

if (isset($_POST['submit'])) {
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass  = mysqli_real_escape_string($conn, md5($_POST['pass']));

        $sql    = "SELECT * FROM {$table} WHERE email = '$email' AND pass = '$pass' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row['varify_status'] == 1) {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth-user'] = [
                    'name' =>  $row['name'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                ];

                $_SESSION['status'] = $row['name'] . " You are logged in successfully";
                header("location: dashboard.php");
                exit();
            } else {
                $_SESSION['status'] = "Please varify your Email address to sign in.";
                header("location: login.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Invalid email or password";
            header("location: login.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "All fields are required";
        header("location: login.php");
        exit();
    }
}
