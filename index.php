<?php

session_start();

require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Manuth Thejaka" />
    <meta name="description" content="E-Commerce Web Application" />
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Phone Shop</title>
    <link rel="icon" href="resources/icon.jpg" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>
    <!-- header -->
    <?php
    include "header.php";
    ?>
    <!-- header -->

     <!-- basic Search -->
     <div class="container-fluid mt-lg-6">
        <div class="row">
            <div id="basicSearchResult"></div>
        </div>
    </div>
    <!-- basic Search -->

    <!-- carousel -->
    <div class="container-fluid carousel-image d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-carousel="right">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <h5>Your trusted gadget store</h5>
                                        <h1>Apple iPhone 15 Plus</h1>
                                    </div>

                                    <div class="carousel-item">
                                        <h5>Your trusted gadget store</h5>
                                        <h1>Samsung Galaxy M55 5G</h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="resources/banner/carousel/carousel-product-1.png" class="d-block" style="width: 30rem;" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resources/banner/carousel/carousel-product-2.png" class="d-block" style="width: 30rem;" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- carousel -->

    <!-- Banner -->
    <div class="container-fluid mt-5">
        <div class="col-12">
            <div class="row justify-content-between">
                <img class="col-4" src="resources/banner/banner-img-3.jpeg" alt="banner-1" style="width: 30rem; border-radius: 33px 10px;" />

                <img class="col-4" src="resources/banner/banner-img-2.jpeg" alt="banner-2" style="width: 30rem; border-radius: 33px 10px;" />

                <img class="col-4" src="resources/banner/banner-img-1.jpeg" alt="banner-3" style="width: 30rem; border-radius: 33px 10px;" />
            </div>
        </div>
    </div>
    <!-- Banner -->

    <!-- product-section -->
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-between mt-5">
            <div class="col-12 col-lg-4 text-center">
                <h1 class="mt-2">Latest Mobile Phones</h1>
            </div>

            <div class="col-5 d-none d-lg-block">
                <button class="more-product-btn float-end" onclick="window.location='<?php echo "category.php?id=" . ('1'); ?>';">More Products</button>
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

                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                            `product_id`='" . $product_data['id'] . "'");

                    $img_data = $img_rs->fetch_assoc();

                ?>

                    <div class="product-card" style="width: 17rem;">
                        <div class="product-image">
                            <img src="<?php echo $img_data["path"] ?>" class="img w-100" alt="<?php echo $product_data['title'] ?>" />

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

        <div class="d-flex justify-content-between mt-5">
            <div class="col-12 col-lg-4 text-center">
                <h1 class="mt-2">Latest Tablets & iPads</h1>
            </div>

            <div class="col-5 d-none d-lg-block">
                <button class="more-product-btn float-end" onclick="window.location='<?php echo "category.php?id=" . ('2'); ?>';">More Products</button>
            </div>
        </div>

        <hr />

        <div class="col-12 mt-5">
            <div class="row justify-content-center gap-3">

                <?php

                $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                        `category_id`='2' AND `status_id`='1' ORDER BY
                                         `datetime_added` DESC LIMIT 5 OFFSET 0");

                $product_num = $product_rs->num_rows;

                for ($x = 0; $x < $product_num; $x++) {
                    $product_data = $product_rs->fetch_assoc();

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
    <!-- product-section -->

    <!-- banner -->
    <div class="container-fluid mt-5">
        <img src="resources/banner/jbl-banner.jpg" class="w-100" alt="jbl-banner" />
    </div>
    <!-- banner -->

    <!-- product-section -->
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-between mt-5">
            <div class="col-12 col-lg-4 text-center">
                <h1 class="mt-2">Headphones & Headsets</h1>
            </div>

            <div class="col-5 d-none d-lg-block">
                <button class="more-product-btn float-end" onclick="window.location='<?php echo "category.php?id=" . ('6'); ?>';">More Products</button>
            </div>
        </div>

        <hr />

        <div class="col-12 mt-5">
            <div class="row justify-content-center gap-3">

                <?php

                $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                        `category_id`='6' AND `status_id`='1' ORDER BY
                                         `datetime_added` DESC LIMIT 5 OFFSET 0");

                $product_num = $product_rs->num_rows;

                for ($x = 0; $x < $product_num; $x++) {
                    $product_data = $product_rs->fetch_assoc();

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
    <!-- product-section -->

    <!-- deals -->
    <div style="background-color: #000079; padding: 20px;" class="container-fluid mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-3 mt-1">
                            <h1 style="color: #FFFC00; font-family: 'BriemHand';" class=" fw-bold text-center">Deals of the Month</h1>
                            <p style="color: #FFFC00;" id="demo" class="text-center mt-4 fw-bold"></p>
                        </div>

                        <div class="col-12 col-lg-9">
                            <div class="row justify-content-between">
                                <div class="col-6 col-lg-3">
                                    <a href="#"><img src="resources/deals/deal-1.png" class="w-100" alt="deal-1"></a>
                                </div>

                                <div class="col-6 col-lg-3">
                                    <a href="#"><img src="resources/deals/deal-2.png" class="w-100" alt="deal-2"></a>
                                </div>

                                <div class="col-6 col-lg-3 mt-3 mt-lg-0">
                                    <a href="#"><img src="resources/deals/deal-3.png" class="w-100" alt="deal-3"></a>
                                </div>

                                <div class="col-6 col-lg-3 mt-3 mt-lg-0">
                                    <a href="#"><img src="resources/deals/deal-4.png" class="w-100" alt="deal-4"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- deals -->

    <!-- delivery-gif -->
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-12 text-center">
                <h6 style="font-family: 'Poetsen'; color: #FFFC00;">Looking for delivery?</h6>
                <h1 class="fw-bold" style="font-family: 'BriemHand';">Order online, We bring to your Home</h1>
            </div>

            <div class="col-12 mt-5">
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-3 text-center">
                        <img src="resources/animated/truck.gif" alt="delivery-gif" class="w-50" />
                        <h4 class="fw-bold">Fast Delivery</h4>
                        <p class="mx-1">within Colombo same day delivery, Island wide within 2-3 working Days.</p>
                    </div>

                    <div class="col-12 col-lg-3 text-center">
                        <img src="resources/animated/box.gif" alt="packaging-gif" class="w-50" />
                        <h4 class="fw-bold">Safe Packaging</h4>
                        <p class="mx-1">All our product packaging is safe & secure. We really care about every order.</p>
                    </div>

                    <div class="col-12 col-lg-3 text-center">
                        <img src="resources/animated/credit-card.gif" alt="payment-gif" class="w-50" />
                        <h4 class="fw-bold">Secure Online Payment</h4>
                        <p class="mx-1">Highly Secure Payment Gateway Trusted by Millions of People, Sri Lanka</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- delivery-gif -->

    <!-- brands -->
    <div class="container">
        <div class="col-12 text-center">
            <h1 style="font-family: 'BriemHand';" class="fw-bold">Shop by Brand</h1>
        </div>

        <div class="row">
            <div class="col-12 mt-5 mb-5 mx-1">
                <div class="row justify-content-between">
                    <div class="col-3 col-lg-1 text-center">
                        <img src="resources/brands/mi-logo-1.jpg" alt="brand-mi" class="w-100" />
                    </div>

                    <div class="col-3 col-lg-1 text-center">
                        <img src="resources/brands/sony.png" alt="brand-sony" class="w-100 mt-3" />
                    </div>

                    <div class="col-3 col-lg-1 text-center">
                        <img src="resources/brands/totu-logo.jpg" alt="brand-totu" class="w-100 mt-3" />
                    </div>

                    <div class="col-3 col-lg-1 text-center">
                        <img src="resources/brands/TP-Link.jpg" alt="brand-tp-link" class="w-100 mt-4" />
                    </div>

                    <div class="col-3 col-lg-1 text-center">
                        <img src="resources/brands/usams.png" alt="brand-usams" class="w-100 mt-3" />
                    </div>

                    <div class="col-3 col-lg-1 text-center">
                        <img src="resources/brands/vivo.png" alt="brand-vivo" class="w-100 mt-3" />
                    </div>

                    <div class="col-3 col-lg-1 text-center">
                        <img src="resources/brands/wiwu-logo.jpg" alt="brand-wiwu" class="w-100 mt-2" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brands -->

    <!-- footer -->
    <?php
    include "footer.php";
    ?>
    <!-- footer -->

    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("Jun 15, 2023 12:40:15").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>

    <script src="script.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>