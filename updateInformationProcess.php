<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$dob = $_POST["dob"];
$gender = $_POST["g"];

if (empty($fname)) {
    echo ("Please enter your First Name.");
} else if (strlen($fname) > 45) {
    echo ("First Name must have less than 45 characters.");
} else if (empty($lname)) {
    echo ("Please enter your Last Name.");
} else if (strlen($lname) > 45) {
    echo ("Last Name must have less than 45 characters.");
} else if (empty($dob)) {
    echo ("Please enter your Birthday.");
} else if (empty($mobile)) {
    echo ("Please Enter Your Mobile Number.");
} else if (strlen($mobile) != 10) {
    echo ("Mobile Number Must Contain 10 characters.");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
    echo ("Invalid Mobile Number.");
} else if ($gender == 0) {
    echo ("Please Select Your Gender.");
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `date_of_birth`='" . $dob . "' AND
    `gender_id`='" . $gender . "'");

    $n = $rs->num_rows;

    if ($n == 1) {
        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',
        `date_of_birth`='" . $dob . "',`mobile`='" . $mobile . "',`gender_id`='" . $gender . "' WHERE `email`='" . $email . "'");

        echo ("Updated");
    } else {
        Database::iud("UPDATE `user` SET `date_of_birth`='" . $dob . "',`gender_id`='" . $gender . "' WHERE `email`='" . $email . "'");

        echo ("Updated");
    }

    if (sizeof($_FILES) == 1) {

        $image = $_FILES["i"];
        $image_extension = $image["type"];

        $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

        if (in_array($image_extension, $allowed_image_extensions)) {
            $new_img_extension;

            if ($image_extension == "image/jpeg") {
                $new_img_extension = ".jpeg";
            } else if ($image_extension == "image/png") {
                $new_img_extension = ".png";
            } else if ($image_extension == "image/svg+xml") {
                $new_img_extension = ".svg";
            }

            $file_name = "resources//profile_images//" . $fname . "_" . uniqid() . $new_img_extension;
            move_uploaded_file($image["tmp_name"], $file_name);

            $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

            if ($profile_img_rs->num_rows == 1) {

                Database::iud("UPDATE `profile_img` SET `path`='" . $file_name . "' WHERE `user_email`='" . $email . "'");
                echo ("Updated");
            } else {

                Database::iud("INSERT INTO `profile_img`(`path`,`user_email`) VALUES ('" . $file_name . "','" . $email . "')");
                echo ("Saved");
            }
        }
    } else if (sizeof($_FILES) == 0) {

        echo ("You have not selected any image.");
    } else {
        echo ("You must select only 01 profile image.");
    }
}
