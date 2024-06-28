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

    <div class="container-fluid main-head fixed-top d-none d-lg-block">
        <div class="row mx-5 justify-content-between top-head">
            <div class="col-3">
                <div class="row mt-3 mx-3">
                    <div class="col-2">
                        <img style="cursor: pointer;" src="resources/social/google.png" alt="google" class="w-100" />
                    </div>

                    <div class="col-2">
                        <img style="cursor: pointer;" src="resources/social/facebook.png" alt="facebook" class="w-100" />
                    </div>

                    <div class="col-2">
                        <img style="cursor: pointer;" src="resources/social/twitter.png" alt="twitter" class="w-100" />
                    </div>
                </div>
            </div>

            <div class="col-3">
                <h1 class="fw-bold text-center mt-1">Phone Shop.</h1>
            </div>

            <div class="col-3 text-end mx-5 mt-3">
                <?php

                if (isset($_SESSION["u"])) {
                    $session_data = $_SESSION["u"];


                ?>

                    <span><b style="font-family: 'Poetsen'; font-size: 17px;">Welcome&nbsp;</b>
                        <span style="font-family: 'BriemHand'; font-size: 18px;" class="text-danger"><?php echo $session_data["fname"] . " " . $session_data["lname"]; ?>
                        </span>
                    </span>

                <?php

                } else {
                ?>

                    <a href="register.php" style="font-family: 'Poetsen'; font-size: 17px; letter-spacing: 1px; color: #000079;" class="fw-bold">
                        Signin or Signup
                    </a>

                <?php
                }

                ?>
            </div>
        </div>

        <div class="row bottom-head">
            <div class="col-7">
                <div class="row justify-content-between mt-2">
                    <a class="text-decoration-none col-2 text-center" href="index.php">Home</a>
                    <a class="text-decoration-none col-2 text-center" href="">Shop</a>
                    <a class="text-decoration-none col-2 text-center" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Categories</a>
                    <a class="text-decoration-none col-2 text-center" href="wishlist.php">Wishlist</a>



                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title topic" id="offcanvasExampleLabel">Categories</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            All Categories
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">

                                            <?php

                                            $category_rs = Database::search("SELECT * FROM `category` ORDER BY `id` ASC");
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="text-decoration-none col-2 text-center" href="#">Gift Card</a>
                </div>
            </div>

            <div class="col-2 offset-3">
                <div class="row justify-content-between">
                    <div class="col-4 text-center">
                        <button style="background: none;" class="border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                            <i class="bi bi-search fs-3"></i>
                        </button>

                        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                            <div class="offcanvas-header">
                                <h1 class="offcanvas-title fw-bold" id="offcanvasTopLabel">Phone Shop.</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>

                            <div class="offcanvas-body">
                                <div class="col-10 offset-1">
                                    <div class="row justify-content-between">

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="input-group ">
                                                    <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">
                                                    <select class="form-select" style="max-width: 250px;" id="basic_search_select">
                                                        <option value="0">All Categories</option>
                                                        <?php
                                                        $category_rs = Database::search("SELECT * FROM `category`");
                                                        $category_num = $category_rs->num_rows;

                                                        for ($x = 0; $x < $category_num; $x++) {
                                                            $category_data = $category_rs->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo $category_data["id"]; ?>">
                                                                <?php echo $category_data["name"]; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="col-3">
                                                        <a href="advancedSearch.php">Advanced</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-7">
                                            <button class="btn btn-outline-primary" onclick="basicSearch(0);">Search Product</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-4 text-center">
                        <i onclick="window.location='cart.php';" style="cursor: pointer;" class="bi bi-bag fs-3"></i>
                        <?php
                        if (isset($_SESSION["u"])) {
                            $user = $_SESSION["u"]["email"];

                            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                            $cart_num = $cart_rs->num_rows;

                            if ($cart_num >= 1) {
                        ?>
                                <span style="margin-left: 86pc; margin-top: 6pc; background: #FFFC00; color: #000079;" class="position-absolute top-0 start-0 badge rounded-pill">
                                    <?php echo $cart_num; ?>
                                </span>
                            <?php

                            } else {
                            ?>
                                <span style="margin-left: 86pc; margin-top: 6pc; background: #FFFC00; color: #000079;" class="position-absolute top-0 start-0 badge rounded-pill">
                                    0
                                </span>
                        <?php
                            }
                        }
                        ?>

                    </div>

                    <div class="col-4 text-center">
                        <div class="col-1 dropdown" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="My Profile">
                            <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="bi bi-person" style="font-size: 31px;"></i>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item" onclick="window.location='userAccountInformation.php';">Account Information</li>
                                    <li class="dropdown-item" onclick="window.location='PurchasedHistory.php';">Purchased History</li>
                                    <li class="dropdown-item" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Messages</li>
                                    <li class="dropdown-item" onclick="window.location='';">Contact Admin</li>
                                    <li class="dropdown-item" onclick="logout();">Sign Out</li>
                                </ul>
                            </span>
                        </div>
                    </div>

                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Messages</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>