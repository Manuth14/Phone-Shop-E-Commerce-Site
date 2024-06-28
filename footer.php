<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Manuth Thejaka" />
    <meta name="description" content="E-Commerce Web Application" />
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>

    <div style="background-color: #000079; padding: 20px;" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row justify-content-between">
                        <div class="col-12 col-lg-3">
                            <h1 class="fw-bold text-center text-white">Phone Shop</h1>
                        </div>

                        <div class="col-12 col-lg-5">
                            <div class="input-group mt-4 mt-lg-2 mb-3">
                                <input type="email" class="form-control" placeholder="Your Email" aria-label="Your Email" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon2">Subcsribe Now</span>
                            </div>
                        </div>

                        <div class="col-2 d-none d-lg-block">
                            <div class="row mt-2 justify-content-between">
                                <div class="col-3">
                                    <img src="resources/social/google.png" alt="google" class="w-100" />
                                </div>

                                <div class="col-3">
                                    <img src="resources/social/facebook.png" alt="facebook" class="w-100" />
                                </div>

                                <div class="col-3">
                                    <img src="resources/social/twitter.png" alt="twitter" class="w-100" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-3" style="color: white;" />

                <div class="col-12 mt-3">
                    <div class="row justify-content-between">
                        <div class="col-12 col-lg-3">
                            <h5 class="text-white fw-bold mb-4">Contact</h5>
                            <p class="text-white text-start">Address : 4/7/2 Kesbewa, Piliyandala</p>
                            <p class="text-white text-start">Email : m.thejaka14@gmail.com</p>
                            <p class="text-white text-start">Phone No : +94 76 062 1337</p>
                        </div>

                        <div class="col-6 col-lg-3 mt-lg-0 mt-4 text-center">
                            <h5 class="text-white fw-bold">Shop Info</h5>
                            <div class="col-12 mt-3 mx-2 my-2">
                                <a class="footer-link" href="#">About us</a>

                                <div class="col-12 mt-3 mx-2 my-2">
                                    <a class="footer-link" href="#">Contact us</a>
                                </div>

                                <div class="col-12 mt-3 mx-2 my-2">
                                    <a class="footer-link" href="#">Privacy Policy</a>
                                </div>

                                <div class="col-12 mt-3 mx-2 my-2">
                                    <a class="footer-link" href="#">Terms & Condition</a>
                                </div>

                                <div class="col-12 mt-3 mx-2 my-2">
                                    <a class="footer-link" href="#">Return Policy</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3 mt-lg-0 mt-4 text-center">
                            <h5 class="text-white fw-bold">Account</h5>
                            <div class="col-12 mt-3 mx-2 my-2">
                                <a class="footer-link" href="userProfile.php">My Account</a>
                            </div>

                            <div class="col-12 mt-3 mx-2 my-2">
                                <a class="footer-link" href="cart.php">Shopping Cart</a>
                            </div>

                            <div class="col-12 mt-3 mx-2 my-2">
                                <a class="footer-link" href="wishlist.php">Wishlist</a>
                            </div>

                            <div class="col-12 mt-3 mx-2 my-2">
                                <a class="footer-link" href="#">Compare</a>
                            </div>

                            <div class="col-12 mt-3 mx-2 my-2">
                                <a class="footer-link" href="purchasedHistory.php">Purchased History</a>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3 mt-lg-0 mt-4 text-center">
                            <h5 class="text-white fw-bold">Most Viewed</h5>

                            <?php

                            $category_rs = Database::search("SELECT * FROM `category` ORDER BY `id` ASC LIMIT 5");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {

                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <div class="col-12 mt-3 mx-2 my-2">
                                    <a class="footer-link" href="<?php echo "category.php?id=" . ($category_data['id']); ?>"><?php echo $category_data["name"]; ?></a>
                                </div>
                            <?php
                            }
                            ?>

                        </div>

                    </div>
                </div>

                <div class="col-12 mt-5">
                    <div class="row">
                        <div class="col-12 col-lg-6 text-center text-lg-start">
                            <p class="text-white">&copy;&nbsp;<a href="index.php" class="text-decoration-none text-warning fw-bold">Phone Shop</a>, All right reserved.</p>
                        </div>

                        <div class="col-12 col-lg-6 text-center text-lg-end">
                            <p class="text-white">Designed By <a href="https://www.web-master.lk/" class="text-decoration-none text-warning fw-bold">web-master.lk</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    
</body>

</html>