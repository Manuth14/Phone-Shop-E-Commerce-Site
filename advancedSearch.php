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

    <title>Advanced Search | Phone Shop</title>
    <link rel="icon" href="resources/icon.jpg" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>
    <?php
    include "header.php";
    ?>

    <div class="container-fluid mt-lg-6">
        <div class="row">

            <div class="col-12 mt-3 mb-5 text-center">
                <h1 class="topic">Advanced Search</h1>
            </div>

            <div class="offset-lg-1 col-12 col-lg-10">
                <div class="row">
                    <div class="col-12 col-lg-10 mt-2 mb-1">
                        <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" />
                    </div>
                    <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                        <button class="btn btn-outline-primary" onclick="advancedSearch(0);">Search</button>
                    </div>
                    <div class="col-12">
                        <hr class="border border-2 border-danger">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="row">

                    <div class="col-7">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 mb-4">
                                        <select class="form-select" id="c1">
                                            <option value="0">Select Category</option>
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
                                    </div>

                                    <div class="col-12 col-lg-4 mb-4">
                                        <select class="form-select" id="b1">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                            $brand_num = $brand_rs->num_rows;

                                            for ($x = 0; $x < $brand_num; $x++) {
                                                $brand_data = $brand_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $brand_data["id"]; ?>">
                                                    <?php echo $brand_data["name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-4 mb-4">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $model_rs = Database::search("SELECT * FROM `model`");
                                            $model_num = $model_rs->num_rows;

                                            for ($x = 0; $x < $model_num; $x++) {
                                                $model_data = $model_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $model_data["id"]; ?>">
                                                    <?php echo $model_data["name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <select class="form-select" id="c2">
                                            <option value="0">Select Condition</option>
                                            <?php
                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                            $condition_num = $condition_rs->num_rows;

                                            for ($x = 0; $x < $condition_num; $x++) {
                                                $condition_data = $condition_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $condition_data["id"]; ?>">
                                                    <?php echo $condition_data["name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <select class="form-select" id="c3">
                                            <option value="0">Select Colour</option>
                                            <?php
                                            $clr_rs = Database::search("SELECT * FROM `color`");
                                            $clr_num = $clr_rs->num_rows;

                                            for ($x = 0; $x < $clr_num; $x++) {
                                                $clr_data = $clr_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $clr_data["id"]; ?>">
                                                    <?php echo $clr_data["name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-8 bg-body rounded mb-4">
                                <div class="row">

                                    <div class="col-4 mt-2 mb-2">
                                        <select id="s" class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-dark">
                                            <option value="0">SORT BY</option>
                                            <option value="1">PRICE LOW TO HIGH</option>
                                            <option value="2">PRICE HIGH TO LOW</option>
                                            <option value="3">QUANTITY LOW TO HIGH</option>
                                            <option value="4">QUANTITY HIGH TO LOW</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-5">
                        <div class="row">

                            <div class="offset-lg-1 col-12 col-lg-10 text-center">
                                <div class="row" id="view_area">
                                    <div class="offset-5 col-2 mt-5">
                                        <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                                    </div>
                                    <div class="offset-3 col-6 mt-3 mb-5">
                                        <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
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
    </div>

    <?php
    include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>