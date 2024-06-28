<?php

include "connection.php";
session_start();
$user = $_SESSION["u"];
$umail =$_SESSION["u"]["email"];

$convenience = 3500;

$city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'");

$city_data = $city_rs->fetch_assoc();
$address = $city_data["line1"].",".$city_data["line2"];

$city_id = $city_data["district_id"];
$district_rs = Database::search("SELECT * FROM `district` WHERE `id`='".$city_id."'");
$district_data = $district_rs->fetch_assoc();

$stockList = array();
$qtyList = array();

if(isset($_POST["cart"]) && $_POST["cart"] == "true"){

   $rs =  Database::search("SELECT * FROM `cart` WHERE `user_email` = '".$user["email"]."'");
   $num = $rs->num_rows;
   

   for($i = 0; $i < $num; $i++){
       $d =  $rs->fetch_assoc();

       $stockList[] = $d["product_id"];
       $qtyList[] = $d["cart_qty"];

   }
}

$merchantId = "1222686";
$merchantSecret = "MTQxMTEyMDAwODI2MDEwMzc1OTg3ODAxNjk2MTAzNDQyNDc1MTgy";
$items = "";
$netTotal = 0;
$currency = "LKR";
$orderId = uniqid();

for ($i=0; $i < sizeof($stockList) ; $i++) { 
   $rs2 =  Database::search("SELECT * FROM `product` WHERE `id` = '".$stockList[$i]."'");

   $d2 = $rs2->fetch_assoc();
   $stockQty = $d2["qty"];

   if ($stockQty >= $qtyList[$i]) {

    $items .= $d2["title"];

    if($i != sizeof($stockList) - 1){
         $items .= ", ";
    }

    $netTotal += (intval($d2["price"] * intval($qtyList[$i])) + $convenience);
       
   } else {
    echo("product has not available in stock");
   } 
   
}

// delevary fee
$netTotal += 500;

$hash = strtoupper(
    md5(
        $merchantId . 
        $orderId . 
        number_format($netTotal, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchantSecret)) 
    ) 
);

$payment = array();
$payment["sandbox"] = true;
$payment["merchant_id"] = $merchantId;
$payment["first_name"] = $user["fname"];
$payment["last_name"] = $user["lname"];
$payment["email"] = $user["email"];
$payment["phone"] = $user["mobile"];
$payment["address"] = $address;
$payment["city"] = $district_data["district_name"];
$payment["country"] = "Sri Lanka";
$payment["order_id"] = $orderId;
$payment["items"] = $items;
$payment["currency"] = $currency;
$payment["amount"] = number_format($netTotal, 2, '.', '');
$payment["hash"] = $hash;
$payment["return_url"] = "";
$payment["cancel_url"] = "";
$payment["notify_url"] = "";

echo json_encode($payment);




?>

