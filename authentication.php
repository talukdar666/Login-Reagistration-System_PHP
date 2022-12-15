<?php
session_start();

if (!isset($_SESSION["authenticated"]))
{
    $_SESSION['status'] = "Please Sign in to access Dashboard";
    header("location: login.php");
    exit();
}
