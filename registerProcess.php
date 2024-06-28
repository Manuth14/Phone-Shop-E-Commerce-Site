<?php

require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["remail"];
$password = $_POST["rpassword"];
$mobile = $_POST["mobile"];
$terms = $_POST["terms"];

if (empty($fname)) {
    echo ("Please enter your First Name.");
} else if (strlen($fname) > 45) {
    echo ("First Name must have less than 45 characters.");
} else if (empty($lname)) {
    echo ("Please enter your Last Name.");
} else if (strlen($lname) > 45) {
    echo ("Last Name must have less than 45 characters.");
} else if (empty($email)) {
    echo ("Please enter your Email Address.");
} else if (strlen($email) > 100) {
    echo ("Email must have less than 100 characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address");
} else if (empty($password)) {
    echo ("Please enter your Password.");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("password length must be between 5 - 20 characters.");
} else if (empty($mobile)) {
    echo ("Please Enter Your Mobile Number.");
} else if (strlen($mobile) != 10) {
    echo ("Mobile Number Must Contain 10 characters.");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
    echo ("Invalid Mobile Number.");
} else if ($terms == "false") {
    echo ("Please accept the terms and conditions.");
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n > 0) {
        echo ("User with the same Email already exists.");
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO 
        `user`(`fname`,`lname`,`email`,`password`,`mobile`,`register_date`,`status`)
        VALUES ('" . $fname . "','" . $lname . "','" . $email . "','" . $password . "','" . $mobile . "','" . $date . "','1') ");

        echo ("Success");
    }
}
