<?php
session_start();
include "connection.php";

require "mailserver/SMTP.php";
require "mailserver/PHPMailer.php";
require "mailserver/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["email"]) && isset($_POST["name"])) {
    if ($_SESSION["au"]["email"] == $_POST["email"]) {

        $cname = $_POST["name"];
        $umail = $_POST["email"];

        $category_rs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%" . $cname . "%'");
        $category_num = $category_rs->num_rows;

        if ($category_num == 0) {
            $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $umail . "'");
            $admin_num = $admin_rs->num_rows;

            if ($admin_num == 1) {
                Database::iud("INSERT INTO `category`(`name`) VALUES ('" . $cname . "')");
                echo ("Success");
            } else {
                echo ("Invalid User.");
            }
        } else {
            echo ("This category already exists.");
        }
    } else {
        echo ("Invalid user.");
    }
} else {
    echo ("Something is missing.");
}
