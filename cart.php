<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
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

        <title>Cart | Phone Shop</title>
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

        <div class="container-fluid px-5">
            <div class="row">

                <div class="col-12 mt-5 d-none d-lg-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none"><i class="bi bi-house-door-fill fs-4"></i></a></li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="bi bi-chevron-right fs-4 text-secondary"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="breadcrumb-item fs-5 text-secondary" disabled>Cart</li>
                    </ol>
                </div>

                <hr class="d-none d-lg-block" />

                <div class="col-12 mt-1 mb-5 text-center">
                    <h1 class="topic">Cart</h1>
                </div>
            </div>
        </div>

        <?php
        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 0) {
        ?>
            <!-- Empty View -->
            <div class="col-12 mt-5 mb-5">
                <div class="row">
                    <div class="col-12 emptyCart"></div>
                    <div class="col-12 text-center mb-2">
                        <label class="form-label fs-1 fw-bold">
                            You have no items in your Cart yet.
                        </label>
                    </div>

                    <div class="offset-lg-4 col-12 col-lg-4 mt-2 mt-0 mb-4 d-grid">
                        <a href="index.php" class="btn btn-outline-info fs-3 fw-bold">
                            Start Shopping
                        </a>
                    </div>
                </div>
            </div>
            <!-- Empty View -->
        <?php
        } else {

        ?>
            <div class="container">
                <div class="col-12">
                    <div class="row">

                        <div class="col-12 d-none d-lg-block">
                            <div class="row">
                                <div class="col-1 text-center">
                                    <h4>Handle</h4>
                                </div>

                                <div class="col-2 text-center">
                                    <h4>Products</h4>
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

                        <hr class="mt-1  d-none d-lg-block">

                        <?php
                        for ($x = 0; $x < $cart_num; $x++) {
                            $cart_data = $cart_rs->fetch_assoc();

                            $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                                    `id`='" . $cart_data["product_id"] . "'");

                            $product_data = $product_rs->fetch_assoc();

                            $total = $total + ($product_data["price"] * $cart_data["cart_qty"]);

                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                            `product_id` ='" . $product_data['id'] . "'");

                            $img_data = $img_rs->fetch_assoc();
                        ?>

                            <div class="col-12 mb-3 d-none d-lg-block">
                                <div class="row">

                                    <div class="col-1 text-center">
                                        <i class="bi bi-x-circle text-danger fs-4 mt-5" onclick="removeFromCart(<?php echo $cart_data['id']; ?>);"></i>
                                    </div>

                                    <div class="col-2 text-center">
                                        <img src="<?php echo $img_data['path']; ?>" class="w-75" alt="<?php echo $product_data['title']; ?>">
                                    </div>

                                    <div class="col-4 text-center">
                                        <h4 class="mt-5"><?php echo $product_data["title"]; ?></h4>
                                    </div>

                                    <div class="col-2 text-center">
                                        <h4 class="mt-5">Rs. <?php echo $product_data["price"]; ?> .00</hr>
                                    </div>

                                    <div class="col-1 text-center">
                                        <input style="border: none; border-bottom: 1px solid" class="mt-5 text-center" type="number" step="1" min="1" max="<?php echo $product_data["qty"]; ?>" onchange="changeQTY(<?php echo $cart_data['id']; ?>);" step="1" value="<?php echo $cart_data['cart_qty']; ?>" id="qty<?php echo $cart_data['id']; ?>" />
                                    </div>

                                    <div class="col-2 text-center">
                                        <h4 class="mt-5">Rs. <?php echo ($product_data["price"] * $cart_data["cart_qty"]); ?> .00</h4>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 mb-3 d-block d-lg-none">
                                <div class="row">
                                    <div class="col-5">
                                        <i class="bi bi-x-circle text-danger fs-4" onclick="removeFromCart(<?php echo $cart_data['id']; ?>);"></i>
                                        <img src="<?php echo $img_data['path']; ?>" class="w-100" alt="<?php echo $product_data['title']; ?>">
                                    </div>

                                    <div class="col-7">
                                        <div class="row">
                                            <div class="col-12">
                                                <p><?php echo $product_data["title"]; ?></p>
                                            </div>

                                            <div class="col-7 mt-1">
                                                <p>Rs. <?php echo $product_data["price"]; ?>.00</p>
                                            </div>

                                            <div class="col-1">
                                                <input style="border: none; border-bottom: 1px solid" class="text-center" type="number" step="1" min="1" max="<?php echo $product_data["qty"]; ?>" onchange="changeQTY(<?php echo $cart_data['id']; ?>);" value="<?php echo $cart_data['qty']; ?>" id="<?php echo $cart_data['id']; ?>" />

                                            </div>

                                            <div class="col-12 mt-2 text-center">
                                                <span class="fs-5">Sub Total</span>
                                                <br />
                                                <span>Rs. <?php echo ($product_data["price"] * $cart_data["cart_qty"]); ?> .00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mt-3 d-block d-lg-none">

                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="input-group">
                            <input type="text" class="coupen" placeholder="Coupen Code" />
                            <button class="input-group-text">Apply Coupen</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="row">
                            <div style="border-radius: 15px; background-color: #FFFC00;" class="col-12 col-lg-5">
                                <div style="padding: 15px;" class="row">
                                    <div class="col-12">
                                        <h1>Cart Total</h1>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Sub Total :</h5>
                                            </div>

                                            <div class="col-5 offset-1 col-lg-4 offset-lg-2">
                                                <h6>Rs. <?php echo $total; ?> .00</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Convenience Fee :</h5>
                                            </div>

                                            <div class="col-5 offset-1 col-lg-4 offset-lg-2">
                                                <h6>Rs. <?php echo $convenience; ?> .00</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Total :</h5>
                                            </div>

                                            <div class="col-5 offset-1 col-lg-4 offset-lg-2">
                                                <h6>Rs. <?php echo $total + $convenience ?> .00</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <button class="buy-btn col-4" onclick="window.location='checkout.php';">Proceed to Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php
        }
        include "footer.php";
        ?>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="script.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cart | Phone Shop</title>
        <link rel="icon" href="resources/logo.ico" />

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    </head>

    <body>

        <?php
        require "header.php";
        ?>

        <div class="container">
            <div class="row">

                <div class="col-12 mt-5">
                    <ol class="breadcrumb">
                        <li style="cursor: pointer;" class="breadcrumb-item" onclick="window.location = 'index.php'; "><i class="bi bi-house-door-fill fs-4 text-secondary"></i></li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="bi bi-chevron-right fs-4 text-secondary"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="breadcrumb-item fs-5 text-secondary" disabled>Cart</li>
                    </ol>
                </div>

                <hr />

                <div class="col-12 text-center">
                    <h1 class="fw-bold">Cart</h1>
                </div>

                <!-- Empty View -->
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-12 emptyCart"></div>
                        <div class="col-12 text-center mb-2">
                            <label class="form-label fs-1 fw-bold">
                                You are not login now. Please login first...
                            </label>
                        </div>
                        <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                            <a href="register.php" class="btn btn-outline-info fs-3 fw-bold">
                                Login OR Register
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Empty View -->

            </div>
        </div>

        <?php
        require "footer.php";
        ?>

        <script src="script.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
}
?>