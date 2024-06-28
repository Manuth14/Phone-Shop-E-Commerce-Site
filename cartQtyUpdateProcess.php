<?php

require "connection.php";

$cartId = $_POST["c"];
$newQty = $_POST["q"];

$rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON `cart`.`product_id` = `product`.`id` WHERE `cart`.`id`='".$cartId."' ");

$num = $rs->num_rows;

if($num > 0){
    $d = $rs->fetch_assoc();

    if($d["qty"] >= $newQty){
        Database::iud("UPDATE `cart` SET `qty` = '".$newQty."' WHERE `id`='".$cartId."'");
        echo ("success");
    }else {
        echo("Your product quantity exceeded");
    }
}else {
    echo("not found");
}

?>