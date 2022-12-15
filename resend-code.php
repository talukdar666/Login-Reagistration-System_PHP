<?php
session_start();
include "db.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function resend_email_varify($name, $email, $varify_token)
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
    $mail->setFrom('luciferboi6617@gmail.com', $name);
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Resend Email varify';

    $email_template = '
    <h2>You have been registerd</h2>
    <h5>Varify your email address with the below given link</h5>
    <br/><br/>
    <a href="http://localhost/projects/LRSWEV/varify-email.php?token=' . $varify_token . '">Click Me</a>
    ';
    $mail->Body = $email_template;
    $mail->send();
}

if (isset($_POST['submit'])) {
    if (!empty(trim($_POST['email']))) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $check_email_query = "SELECT * FROM information WHERE email = '$email' LIMIT 1";
        $check_run = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($check_run) > 0) {
            $row = mysqli_fetch_array($check_run);
            if ($row['varify_status'] == "0") {
                $name = $row['name'];
                $email = $row['email'];
                $varify_token = $row['varify_token'];

                resend_email_varify($name, $email, $varify_token);
                $_SESSION['status'] = "Varification link has been sent to your Email, Please check";
                header("location:login.php");
                exit();
            } else {
                $_SESSION['status'] = "Email already varified, Please login";
                header("location:login.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Email is not registered, Please register now";
            header("location:register.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Please Enter an email";
        header("location:resend-email.php");
        exit();
    }
}

// if (isset($_POST['submit'])) {
//     if (!empty($_POST['email'])) 
//     {
//         $email = mysqli_real_escape_string($conn, $_POST['email']);
//         $sql   = "SELECT * FROM information WHERE email = '$email' LIMIT 1";

//         $query = $conn->query($sql);

//         if ($query->num_rows > 0)
//         {
//             $row = $query->fetch_assoc();
//             if ($row['varify_status'] == "0") 
//             {
//                 $name = $row['name'];
//                 $email_2 = $row['email'];
//                 $varify_token = $row['varify_token'];

//                 resend_email_varify($name, $email, $varify_token);
//                 $_SESSION['status'] = "Varification link has been sent to your Email, Please check";
//                  header("location:login.php");
//                 exit();
//             }
//             else 
//             {
//                 $_SESSION['status'] = "Email already varified, Please login";
//                 header("location:login.php");
//                 exit();
//             }
//         } 
//     } 
//     else 
//     {
//         $_SESSION['status'] = "Please enter an email to varify";
//         header("location:resend-email.php");
//         exit();
//     }
// }
