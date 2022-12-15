<?php
session_start();
include "db.php";
$table = "information";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql    = "SELECT varify_token,varify_status FROM {$table} WHERE varify_token = '$token' LIMIT 1 ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['varify_status'] == "0") {
            $clicked = $row['varify_token'];
            $update  = "UPDATE {$table} SET varify_status='1' WHERE varify_token = '$clicked' LIMIT 1 ";
            $check_Clicked = $conn->query($update);

            if ($check_Clicked == true) {
                $_SESSION['status'] = "Your Account has been varified successfully..!";
                header("location:login.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Varification failed..!";
                header("location:login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Email already varified, Please sign in";
            header("location:login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "This token does not exist";
        header("location:login.php");
        exit();
    }
} else {
    $_SESSION['status'] = "Not allowed";
    header("location:login.php");
    exit();
}
