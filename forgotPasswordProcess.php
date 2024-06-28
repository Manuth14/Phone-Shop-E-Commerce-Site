<?php

require "connection.php";

require "mailserver/SMTP.php";
require "mailserver/PHPMailer.php";
require "mailserver/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = mt_rand(100000,999999);

        Database::iud("UPDATE `user` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'manuththejaka811@gmail.com';
            $mail->Password = 'zbpkktyqpwkadxer';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('manuththejaka811@gmail.com', 'Reset Password');
            $mail->addReplyTo('manuththejaka811@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Phone-Shop Forgot Password Verification Code';
            $bodyContent = '<h1 style="color:green;">Your verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo ("Verification Code Sending Failed.");
            }else{
                echo ("Success");
            }

    }else{
        echo ("Invalid Email Address.");
    }

}else{
    echo ("Please enter your Email Address First.");
}

?>