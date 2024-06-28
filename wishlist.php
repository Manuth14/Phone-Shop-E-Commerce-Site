<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];

    $watchlist_rs = Database::search("SELECT * FROM `watchlist` INNER JOIN `product` ON 
                watchlist.product_id=product.id INNER JOIN `condition` ON 
                product.condition_id=condition.id WHERE watchlist.user_email='" . $user . "'");

    $watchlist_num = $watchlist_rs->num_rows;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="Manuth Thejaka" />
        <meta name="description" content="E-Commerce Web Application" />
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Wishlist | Phone Shop</title>
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
                        <li class="breadcrumb-item fs-5 text-secondary" disabled>Wishlist</li>
                    </ol>
                </div>

                <hr class="d-none d-lg-block" />

                <div class="col-12 mt-1 mb-5 text-center">
                    <h1 class="topic">Wishlist</h1>
                </div>
            </div>
        </div>

        <?php

        if ($watchlist_num == 0) {
        ?>
            <!-- Empty View -->
            <div class="col-12 mt-5 mb-5">
                <div class="row">
                    <div class="col-12 emptyCart"></div>
                    <div class="col-12 text-center mb-2">
                        <label class="form-label fs-1 fw-bold">
                            You have no items in your Wishlist yet.
                        </label>
                    </div>

                    <div class="offset-lg-4 col-12 col-lg-4 mt-2 mt-0 mb-4 d-grid">
                        <a href="index.php" class="btn btn-outline-warning fs-3 fw-bold">
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
                <div class="row">

                    <div class="col-12">
                        <div class="row justify-content-between">

                            <div class="col-1 text-center">
                                <h4>Handle</h4>
                            </div>

                            <div class="col-5 text-center">
                                <h4>Product Name</h4>
                            </div>

                            <div class="col-2 text-center">
                                <h4>Unit Price</h4>
                            </div>

                            <div class="col-2 text-center">
                                <h4>Stock Status</h4>
                            </div>

                            <div class="col-2 text-center">
                                <h4></h4>
                            </div>

                        </div>
                    </div>

                    <hr class="mt-1">

                    <?php
                    for ($x = 0; $x < $watchlist_num; $x++) {
                        $watchlist_data = $watchlist_rs->fetch_assoc();
                        $list_id = $watchlist_data["id"];

                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $watchlist_data["product_id"] . "'");
                        $img_data = $img_rs->fetch_assoc();

                        $status_rs = Database::search("SELECT * FROM `status` WHERE `id`='" . $watchlist_data["status_id"] . "'");
                        $status_data = $status_rs->fetch_assoc();
                    ?>

                        <div class="col-12 mb-3">
                            <div class="row">

                                <div class="col-1 text-center">
                                    <i class="bi bi-x-circle text-danger fs-4 mt-5" onclick="removeFromWatchlist(<?php echo $list_id; ?>);"></i>
                                </div>

                                <div class="col-5">
                                    <div class="row">

                                        <div class="col-3">
                                            <img src="<?php echo $img_data['path']; ?>" class="w-100" alt="">
                                        </div>

                                        <div class="col-9">
                                            <h4 class="mt-4"><?php echo $watchlist_data["title"]; ?></h4>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-2 text-center">
                                    <h4 class="mt-4">Rs. <?php echo $watchlist_data["price"]; ?> .00</hr>
                                </div>

                                <div class="col-2 text-center">
                                    <?php
                                    if ($watchlist_data["status_id"] == "1") {
                                    ?>
                                        <span class="badge text-bg-success mt-4"><?php echo $status_data["name"]; ?></span>

                                    <?php

                                    } else {
                                    ?>
                                        <span class="badge text-bg-danger mt-4"><?php echo $status_data["name"]; ?></span>
                                    <?php
                                    }
                                    ?>

                                </div>

                                <div class="col-2 text-center">
                                    <button class="cart-btn mt-4" onclick="window.location='<?php echo 'singleproductview.php?id=' . ($watchlist_data['product_id']); ?>'">See Details</button>
                                </div>

                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>

        <?php
        }
        include "footer.php";
        ?>

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

        <title>Wishlist | Phone Shop</title>
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
                        <li class="breadcrumb-item fs-5 text-secondary" disabled>Wishlist</li>
                    </ol>
                </div>

                <hr />

                <div class="col-12 text-center">
                    <h1 class="fw-bold">Wishlist</h1>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="script.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
}
?>