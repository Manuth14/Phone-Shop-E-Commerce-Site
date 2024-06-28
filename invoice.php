<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];
    $oid = $_GET["id"];

    $sub_total = 0;
    $convenience = 3500;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="Manuth Thejaka" />
        <meta name="description" content="E-Commerce Web Application" />
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Invoice | Phone Shop</title>
        <link rel="icon" href="resources/icon.jpg" />

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    </head>

    <body>
        <?php
        include "header.php";
        ?>

         <!-- basic Search -->
    <div class="container-fluid mt-lg-6">
        <div class="row">
            <div id="basicSearchResult"></div>
        </div>
    </div>
    <!-- basic Search -->

        <div class="container px-5 mb-5">
            <div class="row">

                <?php

                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $user . "'");
                $address_data = $address_rs->fetch_assoc();

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                $invoice_data = $invoice_rs->fetch_assoc();

                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                ?>

                <div class="col-12 mt-5 btn-toolbar justify-content-end">
                    <button class="btn btn-outline-warning col-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                </div>

                <div id="page">

                    <div class="col-12 mt-3 mb-5 invoice">
                        <div class="row">
                            <div style="border-bottom: solid 1px;" class="col-12">
                                <div class="row mb-2">
                                    <div class="col-5">
                                        <h1 class="fw-bold">Phone Shop.</h1>
                                        <h4 class="mt-5">Order Id : <?php echo $oid; ?></h4>
                                        <h4>Date & Time : <?php echo $invoice_data["date_time"]; ?></h4>
                                    </div>

                                    <div class="col-4 offset-3">
                                        <div class="row mt-5">
                                            <h1 class="text-center">Invoice #<?php echo $invoice_data["id"]; ?></h1>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <h5 class="fw-bold">Bill From</h5>
                                        <h6>Company Name</h6>
                                        <h6>Street Address, Zip Code</h6>
                                        <h6>Phone No</h6>
                                    </div>

                                    <div class="col-4 offset-4">
                                        <h5 class="fw-bold">Bill To</h5>
                                        <h6><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h6>
                                        <h6><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?>, <?php echo $address_data["postal_code"]; ?></h6>
                                        <h6><?php echo $_SESSION["u"]["mobile"]; ?></h6>
                                    </div>
                                </div>
                            </div>

                            <div style="border-bottom: solid 1px; border-top: solid 1px;" class="col-12">
                                <div class="row my-2 justify-content-between">

                                    <div class="col-1 text-center">
                                        <h4>#</h4>
                                    </div>

                                    <div class="col-4 text-center">
                                        <h4>Name</h4>
                                    </div>

                                    <div class="col-2 text-center">
                                        <h4>Price</h4>
                                    </div>

                                    <div class="col-1 text-center">
                                        <h4>Quantity</h4>
                                    </div>

                                    <div class="col-2 text-center">
                                        <h4>Sub Total</h4>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="row justify-content-between">

                                    <div class="col-1 text-center">
                                        <h4 class="mt-5">1</h4>
                                    </div>

                                    <div class="col-4 text-center">
                                        <h4 class="mt-5"><?php echo $product_data["title"]; ?></h4>
                                    </div>

                                    <div class="col-2 text-center">
                                        <h4 class="mt-5">Rs. <?php echo $product_data["price"]; ?> .00</hr>
                                    </div>

                                    <div class="col-1 text-center">
                                        <h4 class="mt-5"><?php echo $invoice_data["qty"]; ?></h4>
                                    </div>

                                    <div class="col-2 text-center">
                                        <h4 class="mt-5">Rs. <?php echo ($product_data["price"] * $invoice_data["qty"]); ?> .00</h4>
                                    </div>

                                </div>
                            </div>

                            <hr />

                            <div style="border: solid 1px; border-radius: 20px;" class="col-12 col-lg-5 offset-lg-7">
                                <div class="row">
                                    <div class="col-12 my-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Sub total</h5>
                                            </div>

                                            <?php
                                            $sub_total = $sub_total + ($product_data["price"] * $invoice_data["qty"]);
                                            ?>

                                            <div class="col-6">
                                                <h5>Rs. <?php echo $sub_total; ?> .00</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 my-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Convenience Fee</h5>
                                            </div>

                                            <div class="col-6">
                                                <h5>Rs. <?php echo $convenience; ?> .00</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                    $district_rs = Database::search("SELECT * FROM `district` WHERE `id`='" . $address_data["district_id"] . "'");
                                    $district_data = $district_rs->fetch_assoc();

                                    $delivery = 0;

                                    if ($district_data["id"] == 5) {
                                        $delivery = $product_data["delivery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delivery_fee_other"];
                                    }

                                    ?>

                                    <div class="col-12 my-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Delivery Fee</h5>
                                            </div>

                                            <div class="col-6">
                                                <h5>Rs. <?php echo $delivery; ?> .00</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div style="border-radius: 0px 0px 20px 20px;" class="row bg-warning">
                                            <div class="col-6">
                                                <h3 class="my-1">Grand Total</h3>
                                            </div>

                                            <?php
                                            $grand_total = 0;
                                            $grand_total = $sub_total + $convenience + $delivery;
                                            ?>

                                            <div class="col-6">
                                                <h3 class="my-1">Rs. <?php echo $grand_total; ?> .00</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php
        include "footer.php";
        ?>

        <script src="script.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
}

?>