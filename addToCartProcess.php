<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];
        $qty = $_GET["qty"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "' AND 
                                        `user_email`='" . $email . "'");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 1) {
            echo ("This Product Already Exists In The Cart");
        } else {
            Database::iud("INSERT INTO `cart`(`cart_qty`,`product_id`,`user_email`) 
            VALUES ('" . $qty . "','" . $pid . "','" . $email . "')");

            echo ("Success");
        }
    }
} else {
    if (isset($_GET["id"])) {

        $pid = $_GET["id"];
        $qty = $_GET["qty"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "'");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 1) {
            echo ("This Product Already Exists In The Cart.");
        } else {

            echo ("Success");
        }
    }
}
