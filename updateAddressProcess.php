<?php
session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$province = $_POST["p"];
$district = $_POST["d"];
$city = $_POST["c"];
$pcode = $_POST["pc"];

if (empty($line1)) {
    echo ("Please enter your Address Line 01.");
} else if (strlen($line1) > 150) {
    echo ("Address Line 01 must have less than 150 characters.");
} else if (empty($line2)) {
    echo ("Please enter your Address Line 02.");
} else if (strlen($line2) > 150) {
    echo ("Address Line 02 must have less than 150 characters.");
} else if ($province == 0) {
    echo ("Please select your Province.");
} else if ($district == 0) {
    echo ("Please select your District.");
} else if (empty($city)) {
    echo ("Please enter your City.");
} else if (strlen($city) > 45) {
    echo ("City must have less than 45 characters.");
} else if (empty($pcode)) {
    echo ("Please enter your Postal Code.");
} else if (strlen($pcode) > 5) {
    echo ("Postal Code must have less than 5 characters.");
} else {

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'");

    if ($address_rs->num_rows == 1) {
        Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "',`line2`='" . $line2 . "',
        `line2`='" . $line2 . "',`city`='" . $city . "',`postal_code`='" . $pcode . "',`district_id`='" . $district . "' WHERE `user_email`='" . $email . "'");

        echo ("Updated");
    } else {

        Database::iud("INSERT INTO `user_has_address`(`line1`,`line2`,`city`,`postal_code`,`district_id`,`user_email`) 
        VALUES ('" . $line1 . "','" . $line2 . "','" . $city . "','" . $pcode . "','" . $district . "','" . $email . "')");

        echo ("Saved");
    }
}
