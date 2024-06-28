<?php

require "connection.php";

require "mailserver/SMTP.php";
require "mailserver/PHPMailer.php";
require "mailserver/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["email"];

    if (empty($email)) {
        echo ("Please enter your Email Address.");
    } else if (strlen($email) > 100) {
        echo ("Incorrect Email Address.");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ("Not a valid Email Address.");
    } else{

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num > 0){

        $code = mt_rand(100000,999999);

        Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'manuththejaka811@gmail.com';
            $mail->Password = 'zbpkktyqpwkadxer';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('manuththejaka811@gmail.com', 'Admin Verification');
            $mail->addReplyTo('manuththejaka811@gmail.com', 'Admin Verification');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Phone-Shop Admin Login Verification Code';
            $bodyContent = '<h1 style="color:#000079;">Your verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

    }else{
        echo ("You are not a valid user");
    }

}

?>