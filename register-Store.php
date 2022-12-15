<?php
session_start();
include "db.php";
$table = "information";
require 'vendor/autoload.php';

function clearInput($input)
{
    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendemail_varify($name, $email, $varify_token)
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
    $mail->Subject = 'Email varify';

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

    if (empty($_POST['userName']) || empty($_POST['phone']) || empty($_POST['email']) || empty($_POST['pass'])) {
        $_SESSION['status'] = "All fields are required!";
        header("location:register.php");
        exit();
    } else {

        $user          = clearInput($_POST['userName']);
        $phone         = clearInput($_POST['phone']);
        $email         = clearInput($_POST['email']);
        $pass          = clearInput(md5($_POST['pass']));
        $varify_token  = md5(rand());

        if (!preg_match('/^[a-zA-Z\s]/', $user)) {
            $_SESSION['status'] = "Name can cotain letters only";
            header("location:register.php");
            exit();
        }

        if (strlen($phone < 11)) {
            $_SESSION['status'] = '<font color="red">This is not a phone number, Please enter a valid phone number</font>';
            header("location:register.php");
            exit();
        }

        if (strlen($pass) < 6) {
            $_SESSION['status'] = "Password should contain atleast 6 characters";
            header("location:register.php");
            exit();
        } else {
            if (!preg_match('/^[a-zA-Z0-9\s]/', $pass)) {
                $_SESSION['status'] = "Password can contain letters and numbers only";
                header("location:register.php");
                exit();
            }
        }


        $sql = "SELECT email FROM {$table} WHERE email = '$email' LIMIT 1 ";

        $email_V = $conn->query($sql);

        if ($email_V->num_rows > 0) {
            $_SESSION['status'] = "Email already exists";
            header("location: register.php");
            exit();
        } else {
            $insert = "INSERT INTO {$table} (name,phone,email,pass,varify_token) VALUES ('$user','$phone','$email','$pass','$varify_token') ";

            $data = $conn->query($insert);

            if ($data == true) {
                sendemail_varify("$user", "$email", "$varify_token");
                $_SESSION['status'] = "Registration Successfull! Please varify your Email Address.";
                header("location: register.php");
            } else {
                $_SESSION['status'] = "Registration Failed!";
                header("location: register.php");
                exit();
            }
        }
    }
}
