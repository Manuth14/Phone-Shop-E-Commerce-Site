<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];

    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $user . "'");
    $invoice_num = $invoice_rs->num_rows;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="Manuth Thejaka" />
        <meta name="description" content="E-Commerce Web Application" />
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Purchased History | Phone Shop</title>
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

        <div class="container-fluid-6 px-5">
            <div class="row">

                <div class="col-12 mt-5 d-none d-lg-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none"><i class="bi bi-house-door-fill fs-4"></i></a></li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="bi bi-chevron-right fs-4 text-secondary"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="breadcrumb-item fs-5 text-secondary" disabled>Purchased History</li>
                    </ol>
                </div>

                <hr class="d-none d-lg-block" />

                <div class="col-12 mt-1 mb-5 text-center">
                    <h1 class="topic">Purchased History</h1>
                </div>
            </div>
        </div>

        <?php

        if ($invoice_num == 0) {
        ?>
            <!-- empty view -->
            <div class="col-12 text-center bg-body" style="height: 450px;">
                <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">
                    You have not purchased any item yet...
                </span>
            </div>
            <!-- empty view -->
        <?php
        } else {
        ?>

            <div class="container">
                <div class="row">

                    <?php
                    for ($x = 0; $x < $invoice_num; $x++) {
                        $invoice_data = $invoice_rs->fetch_assoc();

                        $details_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                                        product.id=product_img.product_id WHERE `id`='" . $invoice_data["product_id"] . "'");

                        $product_data = $details_rs->fetch_assoc();
                    ?>

                        <div class="col-12">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        <i style="cursor: pointer;" class="bi bi-x-circle text-danger fs-4" onclick="removeFromCart(<?php echo $cart_data['id']; ?>);"></i>
                                        <img src="<?php echo $product_data["path"] ?>" class="w-75" alt="<?php echo $product_data['title']; ?>" />
                                    </div>

                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Order Id : <?php echo $invoice_data["order_id"]; ?></h5>
                                                    </div>

                                                    <div class="col-6 text-end">
                                                        <h5>Date & Time : <?php echo $invoice_data["date_time"]; ?></h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-10 mt-2">
                                                <div class="col-12">
                                                    <h3><?php echo $product_data["title"]; ?></h3>
                                                </div>

                                                <div class="col-12">
                                                    <h5>Price : Rs. <?php echo $product_data["price"]; ?> .00</h5>
                                                </div>

                                                <div class="col-12">
                                                    <h5>QTY : <?php echo $invoice_data["qty"]; ?></h5>
                                                </div>

                                                <div class="col-12">
                                                    <h5>Total : Rs. <?php echo $product_data["price"] * $invoice_data["qty"]; ?> .00</h5>
                                                </div>

                                                <div class="col-3 mb-4">
                                                    <span class="badge rounded-pill text-bg-success">Delivered</span>
                                                </div>
                                            </div>

                                            <div class="col-2 mt-2">
                                                <div class="col-12 mt-3">
                                                    <a href="#" class="text-secondary fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Feedback.</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />

                    <?php
                    }
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Feedback</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="form-label fw-bold">Type</label>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type1" />
                                                            <label class="form-check-label text-success fw-bold" for="type1">
                                                                Positive
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type2" checked />
                                                            <label class="form-check-label text-warning fw-bold" for="type2">
                                                                Neutral
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type3" />
                                                            <label class="form-check-label text-danger fw-bold" for="type3">
                                                                Negative
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="form-label fw-bold">User's Email</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control" disabled id="mail" value="<?php echo $user; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="form-label fw-bold">Feedback</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-outline-primary" onclick="saveFeedback(<?php echo $invoice_data['product_id']; ?>);">Save Feedback</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- model -->
                </div>
            </div>

            <!-- Related Products -->
            <div class="container-fluid py-5">
                <div class="d-flex justify-content-between mt-5">
                    <div class="col-12 col-lg-4 text-center">
                        <h1 class="mt-2">Related Products</h1>
                    </div>

                    <div class="col-5 d-none d-lg-block">
                        <button class="more-product-btn float-end">More Products</button>
                    </div>
                </div>

                <hr />

                <div class="col-12 mt-5">
                    <div class="row justify-content-center gap-3">

                        <?php

                        $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                        `category_id`='1' AND `status_id`='1' ORDER BY
                                         `datetime_added` DESC LIMIT 5 OFFSET 0");

                        $product_num = $product_rs->num_rows;

                        for ($x = 0; $x < $product_num; $x++) {
                            $product_data = $product_rs->fetch_assoc();

                        ?>
                            <?php

                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                            `product_id`='" . $product_data['id'] . "'");

                            $img_data = $img_rs->fetch_assoc();

                            ?>

                            <div class="product-card" style="width: 17rem;">
                                <div class="product-image">
                                    <img src="<?php echo $img_data["path"] ?>" class="img w-100" alt="<?php echo $product_data['title']; ?>">
                                </div>

                                <div class="card-body text-center">
                                    <h5 class="product-title"><?php echo $product_data["title"]; ?></h5>
                                    <p class="product-price">Rs. <?php echo $product_data["price"]; ?>.00</p>
                                    <a href="<?php echo "singleproductview.php?id=" . ($product_data['id']); ?>" class="add-cart" data-back="Add to Cart" data-front="Select Option"></a>
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <!-- Related Products -->

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

        <title>Purchased History | Phone Shop</title>
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
                        <li class="breadcrumb-item fs-5 text-secondary" disabled>Purchased History</li>
                    </ol>
                </div>

                <hr />

                <div class="col-12 text-center">
                    <h1 class="fw-bold">Purchased History</h1>
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