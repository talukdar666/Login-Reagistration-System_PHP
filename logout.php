<?php
session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth-user']);
$_SESSION['status'] = "You have been logged out Successfully";
header("location:login.php");
