<?php
session_start();
include "db.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_pass_reset($data_name, $data_email, $token)
{
    $mail = new PHPMailer(true);
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'luciferboi6617@gmail.com';                     //SMTP username
    $mail->Password   = 'txxsixwmrpsoidvs';                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('luciferboi6617@gmail.com', $data_name);
    $mail->addAddress($data_email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Varification';

    $email_template = '
    <h2>Hello</h2>
    <h5>You are recieving this email beacause we revieved a Password Reset request from your account</h5>
    <br/><br/>
    <a href="http://localhost/projects/LRSWEV/password-change.php?token=' . $token . '&&email=' . $data_email . '">Click Me</a>
    ';
    $mail->Body = $email_template;
    $mail->send();
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = md5(rand());

    $sql   = "SELECT email FROM information WHERE email = '$email' LIMIT 1";
    $query = $conn->query($sql);

    if ($query->num_rows > 0) {
        $data       = $query->fetch_assoc();
        $data_name  = $data['name'];
        $data_email = $data['email'];

        $update_token = "UPDATE information SET varify_token = '$token' WHERE email = '$data_email' LIMIT 1";
        $update_run   = $conn->query($update_token);

        if ($update_run == true) {
            send_pass_reset($data_name, $data_email, $token);
            $_SESSION['status'] = "We have sent a varification link to your Email address, Please check";
            header("location:password-reset.php");
            exit();
        } else {
            $_SESSION['status'] = "Smething went wrong. #1";
            header("location:password-reset.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Email not found, Please enter a registered Email";
        header("location:password-reset.php");
        exit();
    }
}


if (isset($_POST['submit_2'])) {
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $pass   = mysqli_real_escape_string($conn, md5($_POST['new-pass']));
    $c_pass = mysqli_real_escape_string($conn, md5($_POST['c-pass']));

    $token  = mysqli_real_escape_string($conn, $_POST['token']);

    if (!empty($token)) {
        if (!empty($email) && !empty($pass) && !empty($c_pass)) {
            $check_token = "SELECT varify_token FROM information WHERE varify_token = '$token' LIMIT 1";
            $run_token   = $conn->query($check_token);

            if ($run_token->num_rows > 0) {
                if ($pass == $c_pass) {
                    $update_pass = "UPDATE information SET pass = '$pass' WHERE varify_token = '$token' LIMIT 1";
                    $u_p_run     = $conn->query($update_pass);

                    if ($u_p_run == true) {
                        $new_token    = md5(rand());
                        $update_token = "UPDATE information SET varify_token = '$new_token' WHERE varify_token = '$token' LIMIT 1";
                        $u_t_run      = $conn->query($update_token);
                        $_SESSION['status'] = "Password Reset successfully";
                        header("location:login.php");
                        exit();
                    } else {
                        $_SESSION['status'] = "Something went wrong, Please try again";
                        header("location:password-change.php?token=$token&&email=$email");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Password and Confirm Password does not match";
                    header("location:password-change.php?token=$token&&email=$email");
                    exit();
                }
            } else {
                $_SESSION['status'] = "Invalid Token";
                header("location:password-change.php?token='.$token.&&email=$email");
                exit();
            }
        } else {
            $_SESSION['status'] = "All fields are required";
            header("location:password-change.php?token=$token&&email=$email");
            exit();
        }
    } else {
        $_SESSION['status'] = "Token is invalid";
        header("location:password-change.php");
        exit();
    }
}
