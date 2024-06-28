<?php
session_start();
require "connection.php";

if (isset($_SESSION["au"])) {
    if (isset($_SESSION["p"])) {

        $product = $_SESSION["p"];
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="author" content="Manuth Thejaka" />
            <meta name="description" content="E-Commerce Web Application" />
            <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <title>Update Product | Admin Panel</title>
            <link rel="icon" href="resources/icon.jpg" />

            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
        </head>

        <body>

            <!-- Header -->



            <!-- Header -->

            <div class="container-fluid">
                <div class="col-12 text-center">
                    <h1 class="topic">Update Product</h1>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <div class="col-12 my-5">
                        <div class="row justify-content-between">
                            <div style="border: solid 1px;" class="col-12 col-lg-7">

                                <div class="col-12 mt-3">
                                    <label class="form-label fw-bold">Product Name</label>
                                    <input type="text" class="form-control" id="title" value="<?php echo $product['title']; ?>" placeholder="Enter the Product Name" />
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="form-label fw-bold">Select Product Category</label>
                                    <select class="form-select" disabled>
                                        <?php
                                        $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                        $category_data = $category_rs->fetch_assoc();
                                        ?>
                                        <option><?php echo $category_data["name"]; ?></option>
                                    </select>
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="form-label fw-bold">Select Product Brand</label>
                                    <select class="form-select" disabled>
                                        <?php
                                        $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN 
                                                    (SELECT `brand_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                        $brand_data = $brand_rs->fetch_assoc();
                                        ?>
                                        <option><?php echo $brand_data["name"]; ?></option>
                                    </select>
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="form-label fw-bold">Select Product Model</label>
                                    <select class="form-select" disabled>
                                        <?php
                                        $model_rs = Database::search("SELECT * FROM `model` WHERE `id` IN 
                                                    (SELECT `model_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                        $model_data = $model_rs->fetch_assoc();
                                        ?>
                                        <option><?php echo $model_data["name"]; ?></option>
                                    </select>
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="form-label fw-bold">Product Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="number" min="0" class="form-control" id="price" value="<?php echo $product['price']; ?>" placeholder="Enter the Price" />
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label fw-bold">Product Quantity</label>
                                        <input type="number" min="1" class="form-control" id="qty" value="<?php echo $product['qty']; ?>" placeholder="Enter the Product Quantity" />
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3 text-center">
                                        <label class="form-label fw-bold">Select Product Condition</label>
                                        <div class="col-12">
                                            <div class="form-check form-check-inline mx-5">
                                                <input class="form-check-input" type="radio" name="c" id="b" checked disabled />
                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="c" id="u" disabled />
                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label fw-bold">Delivery cost Within Colombo</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="number" min="0" class="form-control" id="dwc" value="<?php echo $product['delivery_fee_colombo']; ?>" placeholder="Enter the Price" />
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label fw-bold">Delivery cost out of Colombo</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="number" min="0" class="form-control" id="doc" value="<?php echo $product['delivery_fee_other']; ?>" placeholder="Enter the Price" />
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                    <textarea rows="5" class="form-control" id="desc" value="<?php echo $product['description']; ?>" placeholder="Enter the Description"></textarea>
                                </div>

                                <!-- update button -->
                                <div class="col-6 offset-3 mt-5">
                                    <button class="col-12 btn btn-outline-primary" onclick="updateProduct();">Update Product</button>
                                </div>

                            </div>

                            <?php

                            $img = array();

                            $img[0] = "resources/addproductimg.svg";
                            $img[1] = "resources/addproductimg.svg";
                            $img[2] = "resources/addproductimg.svg";

                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                            $product_img_num = $product_img_rs->num_rows;

                            for ($x = 0; $x < $product_img_num; $x++) {
                                $product_img_data = $product_img_rs->fetch_assoc();

                                $img[$x] = $product_img_data["path"];
                            }
                            ?>

                            <div class="col-12 col-lg-4">
                                <div class="row mx-1">
                                    <div class="col-12 text-center">
                                        <img src="<?php echo $img[0]; ?>" class="w-75 img-fluid" id="i0" />
                                    </div>

                                    <hr />

                                    <div class="col-12 text-center">
                                        <img src="<?php echo $img[1]; ?>" class="w-75 img-fluid" id="i1" />
                                    </div>

                                    <hr />

                                    <div class="col-12 text-center">
                                        <img src="<?php echo $img[2]; ?>" class="w-75 img-fluid" id="i2" />
                                    </div>
                                </div>

                                <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                    <input type="file" class="d-none" multiple id="imageuploader" />
                                    <label for="imageuploader" class="col-12 btn btn-warning" onclick="changeProductImage();">Upload Images</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        <?php
    } else {
        ?>
            <script>
                alert("Please select a product to update.");
                window.location = "myProducts.php";
            </script>
        <?php
    }
} else {
        ?>
        <script>
            alert("You have to signin to the system for access this function.");
            window.location = "home.php";
        </script>
    <?php
}
    ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
        </body>

        </html>