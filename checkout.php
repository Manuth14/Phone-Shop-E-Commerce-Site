<?php

require "connection.php";
session_start();

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];

    $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
    user.gender_id=gender.id WHERE `email`='" . $user . "'");

    $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `district` ON 
user_has_address.district_id=district.id INNER JOIN `province` ON 
district.province_id=province.id WHERE `user_email`='" . $user . "'");

    $details_data =  $details_rs->fetch_assoc();
    $address_details = $address_rs->fetch_assoc();

    $total = 0;
    $subtotal = 0;
    $shipping = 500;
    $convenience = 3500;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Checkout | Phone Shop</title>
        <link rel="icon" href="resources/logo.ico" />

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    </head>

    <body>

        <?php
        require "header.php";
        ?>

        <div style="margin-top: 125px;" class="container-fluid px-5">
            <div class="row">

                <div class="col-12 mt-5 d-none d-lg-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none"><i class="bi bi-house-door-fill fs-4"></i></a></li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="bi bi-chevron-right fs-4"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li style="cursor: pointer;" class="breadcrumb-item fs-5" onclick="window.history.back();">Cart</li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="bi bi-chevron-right fs-4"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="breadcrumb-item fs-5 text-secondary" disabled>Checkout</li>
                    </ol>
                </div>

                <hr class="d-none d-lg-block" />

                <div class="col-12 text-center">
                    <h1 class="topic">Checkout</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="row">

                        <div class="col-12 col-lg-6">
                            <div class="row">

                                <div class="col-12">
                                    <span style="border-bottom: 3px solid #FFFC00;" class="h1">Billing Details</span>
                                </div>

                                <div class="col-6 mt-5">
                                    <label class="form-label">First Name</label>
                                    <input type="text" id="fname" class="form-control" value="<?php echo $details_data["fname"]; ?>" />
                                </div>

                                <div class="col-6 mt-5">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" id="lname" class="form-control" value="<?php echo $details_data["lname"]; ?>" />
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" id="mobile" class="form-control" value="<?php echo $details_data["mobile"]; ?>" />
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label">Email</label>
                                    <input type="text" id="email" class="form-control" value="<?php echo $details_data["email"]; ?>" />
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label">Address Line 01</label>
                                    <?php
                                    if (empty($address_details["line1"])) {
                                    ?>
                                        <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01" />
                                    <?php
                                    } else {
                                    ?>
                                        <input type="text" id="line1" class="form-control" value="<?php echo $address_details["line1"]; ?>" />
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label">Address Line 02</label>
                                    <?php
                                    if (empty($address_details["line2"])) {
                                    ?>
                                        <input type="text" id="line2" class="form-control" placeholder="Enter Address Line 02" />
                                    <?php
                                    } else {
                                    ?>
                                        <input type="text" id="line2" class="form-control" value="<?php echo $address_details["line2"]; ?>" />
                                    <?php
                                    }
                                    ?>
                                </div>

                                <?php

                                $province_rs = Database::search("SELECT * FROM `province`");
                                $district_rs = Database::search("SELECT * FROM `district`");

                                $province_num = $province_rs->num_rows;
                                $district_num = $district_rs->num_rows;

                                ?>
                                <div class="col-6 mt-2">
                                    <label class="form-label">Province</label>
                                    <select class="form-select" id="province">
                                        <option value="0">Select Province</option>
                                        <?php
                                        for ($x = 0; $x < $province_rs->num_rows; $x++) {
                                            $province_data = $province_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $province_data["id"]; ?>" <?php
                                                                                                if (!empty($address_details["id"])) {
                                                                                                    if ($province_data["id"] == $address_details["id"]) {
                                                                                                ?>selected<?php
                                                                                                        }
                                                                                                    }
                                                                                                            ?>>
                                                <?php echo $province_data["province_name"]; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6 mt-2">
                                    <label class="form-label">District</label>
                                    <select class="form-select" id="district">
                                        <option value="0">Select District</option>
                                        <?php
                                        for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                            $district_data = $district_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $district_data["id"]; ?>" <?php
                                                                                                if (!empty($address_details["id"])) {
                                                                                                    if ($district_data["id"] == $address_details["district_id"]) {
                                                                                                ?>selected<?php
                                                                                                        }
                                                                                                    }
                                                                                                            ?>>
                                                <?php echo $district_data["district_name"]; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6 mt-2">
                                    <label class="form-label">City</label>
                                    <?php
                                    if (empty($address_details["city"])) {
                                    ?>
                                        <input type="text" id="city" class="form-control" placeholder="Enter Your City" />
                                    <?php
                                    } else {
                                    ?>
                                        <input type="text" id="city" class="form-control" value="<?php echo $address_details["city"]; ?>" />
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="col-6 mt-2">
                                    <label class="form-label">Postal Code</label>
                                    <?php
                                    if (empty($address_details["postal_code"])) {
                                    ?>
                                        <input type="number" min="1" max="99999" id="pcode" class="form-control" placeholder="Enter Your Postal Code" />
                                    <?php
                                    } else {
                                    ?>
                                        <input type="number" min="1" max="99999" id="pcode" class="form-control" value="<?php echo $address_details["postal_code"]; ?>" />
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="col-12 mt-2 mb-5">
                                    <label class="form-label">Gender</label>
                                    <?php
                                    if (empty($details_data["gender_id"])) {
                                    ?>
                                        <select class="form-control" id="gender">
                                            <option value="0">Select gender</option>

                                            <?php

                                            $gender_rs = Database::search("SELECT * FROM `gender`");
                                            $gender_num = $gender_rs->num_rows;

                                            for ($x = 0; $x < $gender_num; $x++) {
                                                $gender_data = $gender_rs->fetch_assoc();
                                            ?>

                                                <option value="<?php echo $gender_data["id"]; ?>">
                                                    <?php echo $gender_data["gender_name"]; ?>
                                                </option>

                                            <?php
                                            }
                                            ?>

                                        </select>

                                    <?php
                                    } else {
                                    ?>
                                        <input type="text" class="form-control" value="<?php echo $details_data["gender_name"]; ?>" readonly />
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="col-12">
                                    <span style="border-bottom: 3px solid #FFFC00;" class="h1">Shipping Details</span>
                                </div>

                                <!-- Shipping Other Address -->
                                <div class="col-12 mt-4 mb-4">
                                    <input type="checkbox" id="oShipping" />
                                    <label for="oShipping" onclick="shipping();">Ship to a different address?</label>
                                </div>

                                <div class="col-12 d-none" id="otherAddress">
                                    <div class="row">

                                        <div class="col-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" id="fname" class="form-control" />
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" id="lname" class="form-control" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Mobile Number</label>
                                            <input type="text" id="mobile" class="form-control" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <input type="text" id="email" class="form-control" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Address Line 01</label>
                                            <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Address Line 02</label>
                                            <input type="text" id="line2" class="form-control" placeholder="Enter Address Line 02" />
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Province</label>
                                            <select class="form-select" id="province">
                                                <option value="0">Select Province</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">District</label>
                                            <select class="form-select" id="district">
                                                <option value="0">Select District</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">City</label>
                                            <select class="form-select" id="city">
                                                <option value="0">Select City</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" id="pc" placeholder="Enter Your Postal Code" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Gender</label>
                                            <input type="text" class="form-control" />
                                        </div>

                                    </div>
                                </div>
                                <!-- Shipping Other Address -->

                                <div class="col-12 mb-5">
                                    <label class="form-label">Order notes (optional)</label>
                                    <textarea class="form-control" placeholder="Notes about your order." rows="5"></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="row">

                                <div class="col-12">
                                    <span style="border-bottom: 3px solid #FFFC00;" class="h1">Your Order</span>
                                </div>

                                <div style="background-color: rgb(220, 220, 250);" class="col-12 mt-5 rounded-4">
                                    <div class="row">

                                        <div class="col-12 mt-3">
                                            <div class="row">

                                                <div class="col-7 col-lg-8 text-center">
                                                    <h4>Product</h4>
                                                </div>

                                                <div class="col-5 col-lg-4 text-center">
                                                    <h4>Sub Total</h4>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="col-12 mt-1" />

                                        <div class="col-12">
                                            <div class="row">

                                                <?php
                                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                                                $cart_num = $cart_rs->num_rows;

                                                for ($x = 0; $x < $cart_num; $x++) {
                                                    $cart_data = $cart_rs->fetch_assoc();

                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                                    `id`='" . $cart_data["product_id"] . "'");

                                                    $product_data = $product_rs->fetch_assoc();

                                                    $total = $total + ($product_data["price"] * $cart_data["cart_qty"]);

                                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` ='" . $product_data['id'] . "'");

                                                    $img_data = $img_rs->fetch_assoc();
                                                ?>

                                                    <div class="col-7 col-lg-8">
                                                        <h5><?php echo $product_data["title"]; ?> <b class="fs-5">x <?php echo $cart_data["cart_qty"]; ?></b></h5>
                                                    </div>

                                                    <div class="col-5 col-lg-4 text-center">
                                                        <h5>Rs. <?php echo ($product_data["price"] * $cart_data["cart_qty"]); ?> .00</h5>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <hr class="col-12 mt-1" />

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-8">
                                                    <h5>Convenience Fee</h5>
                                                </div>

                                                <div class="col-4 text-center">
                                                    <h5>Rs. <?php echo $convenience; ?> .00</h5>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="col-12" />

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-8">
                                                    <h5>Shipping Fee</h5>
                                                </div>

                                                <div class="col-4 text-center">
                                                    <h5>Rs. <?php echo $shipping; ?> .00</h5>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="col-12 mt-1" />

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-6 col-lg-8">
                                                    <h4 class="fw-bold">Total</h4>
                                                </div>
                                                <?php
                                                $grand_total = $total + $convenience + $shipping;
                                                ?>
                                                <div class="col-6 col-lg-4 text-center">
                                                    <h4 class="fw-bold">Rs. <?php echo $grand_total; ?> .00</h4>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="col-12 mt-1" />

                                        <div class="form-check col-11 offset-1 mt-2">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="credit_card" value="option1" checked>
                                            <label class="form-check-label fw-bold" for="credit_card">
                                                Online Pay Credit/Debit Card
                                            </label>
                                        </div>

                                        <div class="form-check col-11 offset-1 mt-2">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="bank" value="option2">
                                            <label class="form-check-label fw-bold" for="bank">
                                                Bank Transfer
                                            </label>
                                        </div>

                                        <div class="form-check col-11 offset-1 mt-3">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="koko" value="option3">
                                            <label class="form-check-label fw-bold" for="koko">
                                                Koko: Buy Now Pay Later
                                            </label>
                                        </div>

                                        <hr class="mt-3" />

                                        <div class="col-6 offset-1">
                                            <img src="resources/sampath.jpg" class="w-100" />
                                        </div>

                                        <div class="col-3 offset-1">
                                            <img src="resources/daraz-koko.png" class="w-100" />
                                        </div>

                                        <hr class="mt-3" />

                                        <div class="col-12">
                                            <p>Your personal data will be used to process your order,
                                                support your experience throughout this website,
                                                and for other purposes described in our <a href="#">privacy policy.</a>
                                            </p>
                                        </div>

                                        <div class="col-8 offset-2 mt-2 mb-4 d-grid">
                                            <button style="height: 45px; letter-spacing: 5px;" class="btn btn-danger rounded-5 text-white fw-bold" onclick="checkout();">Place Order</button>
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

        require "footer.php";

        ?>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="script.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    </body>

    </html>

<?php
}
?>