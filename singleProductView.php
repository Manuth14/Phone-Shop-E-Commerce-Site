<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];
    $user_rs = Database::search("SELECT * FROM `user`");
    $user_data = $user_rs->fetch_assoc();

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,
    product.title,product.description,product.datetime_added,product.category_id,product.model_has_brand_id,
    product.status_id,product.condition_id,product.admin_email,
    model.name AS mname,brand.name AS bname FROM `product`
    INNER JOIN `model_has_brand` ON model_has_brand.id=product.model_has_brand_id 
    INNER JOIN `brand` ON brand.id=model_has_brand.brand_id INNER JOIN 
    `model` ON model.id=model_has_brand.model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="author" content="Manuth Thejaka" />
            <meta name="description" content="E-Commerce Web Application" />
            <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <title><?php echo $product_data["title"]; ?> | Phone Shop</title>
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

            <?php
            $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product_data['category_id'] . "'");
            $category_data = $category_rs->fetch_assoc();

            $brand_rs = Database::search("SELECT * FROM `brand` WHERE `name`='" . $product_data['bname'] . "'");
            $brand_data = $brand_rs->fetch_assoc();

            $modal_rs = Database::search("SELECT * FROM `model` WHERE `name`='" . $product_data['mname'] . "'");
            $modal_data = $modal_rs->fetch_assoc();
            ?>

            <!-- breadcrumb -->
            <div class="container-fluid px-5 d-none d-lg-block">
                <div class="row">
                    <div class="col-12 mt-5">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none"><i class="bi bi-house-door-fill fs-4"></i></a></li>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="bi bi-chevron-right fs-4"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li class="breadcrumb-item fs-5" onclick="window.location='<?php echo "category.php?id=" . ($product_data['category_id']); ?>'"><?php echo $category_data["name"]; ?></li>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="bi bi-chevron-right fs-4"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li class="breadcrumb-item fs-5"><?php echo $brand_data["name"]; ?></li>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="bi bi-chevron-right fs-4"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li class="breadcrumb-item fs-5"><?php echo $modal_data["name"]; ?></li>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="bi bi-chevron-right fs-4"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li class="breadcrumb-item fs-5 text-secondary" disabled><?php echo $product_data["title"]; ?></li>
                        </ol>
                    </div>

                    <hr />

                </div>
            </div>
            <!-- breadcrumb -->

            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-12 col-lg-6" style="box-shadow: 0 1px 5px rgba(0, 0, 121, 0.5); border-radius: 10px; padding: 15px;">
                                <div class="row justify-content-between">

                                    <!-- Main-Img -->
                                    <div class="col-12">
                                        <div class="mainImg" id="mainImg"></div>
                                    </div>
                                    <!-- Main-Img -->

                                    <?php
                                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                    $image_num = $image_rs->num_rows;
                                    $img = array();

                                    if ($image_num != 0) {
                                        for ($x = 0; $x < $image_num; $x++) {
                                            $image_data = $image_rs->fetch_assoc();
                                            $img[$x] = $image_data["path"];
                                    ?>
                                            <div class="col-3">
                                                <img src="<?php echo $img[$x]; ?>" class="w-100" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>

                                        <div class="col-3">
                                            <img src="resources/empty.svg" alt="empty-img" class="w-100" />
                                        </div>

                                        <div class="col-3">
                                            <img src="resources/empty.svg" alt="empty-img" class="w-100" />
                                        </div>

                                        <div class="col-3">
                                            <img src="resources/empty.svg" alt="empty-img" class="w-100" />
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="col-12 col-lg-5 mt-1">
                                <h4 class="single-product-title"><?php echo $product_data['title']; ?></h4>
                                <h5 class="single-product-price mt-3">Rs. <?php echo $product_data['price']; ?>.00</h5>
                                <p class="mt-4">- 8GB RAM | 128GB ROM | Expandable Upto 1 TB</p>
                                <p class="mt-4">- 8GB RAM | 128GB ROM | Expandable Upto 1 TB</p>
                                <p class="mt-4">- 8GB RAM | 128GB ROM | Expandable Upto 1 TB</p>
                                <p class="mt-4">- 8GB RAM | 128GB ROM | Expandable Upto 1 TB</p>

                                <div class="row mx-3 mt-4">
                                    <div class="col-4 mt-2">
                                        <span class="fw-bold">Colour :</span>
                                    </div>

                                    <?php
                                    $color_rs = Database::search("SELECT * FROM `product_has_color` INNER JOIN `color` ON color.id=product_has_color.color_id WHERE `product_id`='" . $pid . "'");

                                    $color_num = $color_rs->num_rows;
                                    ?>

                                    <div class="col-7">
                                        <select class="form-control">
                                            <option>Choose an option</option>
                                            <?php
                                            for ($x = 0; $x < $color_rs->num_rows; $x++) {
                                                $color_data = $color_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $color_data["id"]; ?>"> <?php echo $color_data["name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mx-3 mt-3">
                                    <div class="col-4 mt-2">
                                        <span class="fw-bold">Warrenty :</span>
                                    </div>

                                    <div class="col-7">
                                        <select class="form-control">
                                            <option>Choose an option</option>
                                            <option>1 year Warrenty</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Cart QTY -->
                                <div class="row justify-content-center mt-4">
                                    <div class="col-4">
                                        <div class="input-group mt-2">
                                            <div class="input-group-btn">
                                                <button class="rounded-circle bg-light border">
                                                    <i class="bi bi-dash-lg" onclick='qty_dec();'></i>
                                                </button>
                                            </div>
                                            <input style="border: none; border-bottom: solid 1px;" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' type="text" step="1" min="1" max="<?php echo $product_data["qty"]; ?>" class="form-control fw-bold text-center" value="1" id="qty_input" />
                                            <div class="input-group-btn">
                                                <button class="rounded-circle bg-light border">
                                                    <i class="bi bi-plus-lg" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cart QTY -->

                                    <div class="col-7 mt-3 text-center">
                                        <i class="bi bi-heart mx-3 wishlist-btn" onclick="addToWishlist(<?php echo $pid; ?>);">&nbsp;Add Wishlist</i>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row justify-content-between mx-1">
                                        <button class="cart-btn col-5" onclick="addToCart(<?php echo $pid; ?>);"><i class="bi bi-cart"></i>&nbsp; Add to Cart</button>
                                        <button class="buy-btn col-5" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);"><i class="bi bi-cash-coin"></i>&nbsp; Buy Now</button>
                                    </div>
                                </div>
                            </div>

                            <!-- description & review -->
                            <div class="col-12 mt-5">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-description" aria-selected="true">Description</button>
                                        <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="false">Reviews</button>
                                    </div>
                                </nav>

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active mt-5" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab" tabindex="0">
                                        <p><?php echo $product_data['description']; ?></p>
                                    </div>

                                    <?php
                                    $feed_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                    $feed_num = $feed_rs->num_rows;

                                    for ($x = 0; $x < $feed_num; $x++) {
                                        $feed_data = $feed_rs->fetch_assoc();

                                        $profile_image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $user_data['email'] . "'");
                                        $profile_image_data = $profile_image_rs->fetch_assoc();
                                    ?>

                                        <div class="tab-pane fade mt-5" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab" tabindex="0">
                                            <div style="border-bottom: solid rgba(128, 128, 128, 0.5) 1px; padding: 10px;" class="col-12">
                                                <div class="row">
                                                    <div class="col-4 col-lg-2">
                                                        <?php
                                                        if (empty($profile_image_data["path"])) {
                                                        ?>
                                                            <img src="resources/user.png" width="90" height="90" class="mt-3 rounded" alt="user-img" />
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="<?php echo $profile_image_data['path']; ?>" width="90" height="90" class="mt-3 rounded" alt="user-img" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="col-8 col-lg-10">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <p><?php echo $feed_data["date"]; ?></p>
                                                            </div>

                                                            <div class="col-12 col-lg-6">
                                                                <h3><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h3>
                                                            </div>

                                                            <div class="col-12 col-lg-5 text-lg-end mx-3">
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            </div>

                                                            <div class="col-12">
                                                                <p><?php echo $feed_data["context"]; ?></p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- description & review -->

                            <div class="col-12 mt-5">
                                <div class="col-12">
                                    <h2>Leave a comment</h2>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 col-lg-6">
                                        <input type="text" class="form-control" placeholder="Enter your name">
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <input type="email" class="form-control" placeholder="Enter your email">
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <textarea class="form-control" cols="50" rows="8" id="feed" placeholder="Leave a comment"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- search product -->
                    <div class="col-3 d-none d-lg-block">
                        <div class="input-group mb-3 mt-1">
                            <input type="text" class="form-control" placeholder="Search products." />
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                        </div>

                        <h3 class="mt-2">Categories</h3>

                        <?php

                        $category_rs = Database::search("SELECT * FROM `category` ORDER BY `id` ASC LIMIT 4");
                        $category_num = $category_rs->num_rows;

                        for ($x = 0; $x < $category_num; $x++) {

                            $category_data = $category_rs->fetch_assoc();
                        ?>
                            <div class="col-12 mt-3 mx-2 my-2">
                                <a class="category-link" href="<?php echo "category.php?id=" . ($category_data['id']); ?>"><?php echo $category_data["name"]; ?></a>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                    <!-- search product -->

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
                                    <img src="<?php echo $img_data["path"] ?>" class="img w-100" alt="Apple">
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
            include "footer.php";
            ?>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="script.js"></script>
            <script src="bootstrap/js/bootstrap.js"></script>
            <script src="bootstrap/js/bootstrap.bundle.js"></script>
        </body>

        </html>

    <?php
    } else {
    ?>
        <script>
            alert("Something went wrong");
        </script>
<?php
    }
}

?>