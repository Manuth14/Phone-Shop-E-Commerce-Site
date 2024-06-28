<?php
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

    <title>Admin Login | Phone-Shop</title>
    <link rel="icon" href="resources/icon.jpg" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body class="admin-main-body">

    <div class="container vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <!-- Login box -->
            <div style="padding: 20px 60px 10px 60px;" class="col-6 offset-3 admin" id="signinbox">
                <div class="row">

                    <div class="col-12 mt-3">
                        <h1 class="title02 text-center">ADMIN - Login Here</h1>
                    </div>

                    <div class="input-group">
                        <input class="input" type="email" placeholder="Your Email" id="email" />
                    </div>

                    <div class="col-8 offset-2 d-grid mt-4 mb-4">
                        <button class="btn btn-success" onclick="verifyCode();">Send Verification Code</button>
                    </div>

                </div>
            </div>
            <!-- Login box -->


            <!-- modal-->
            <div class="modal" tabindex="-1" id="adminPanelModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ADMIN PANEL - SIGN IN</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="from-control" id="vcode" />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="adminLogin();">Submit Code</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal-->

            <!--footer-->
            <div class="col-12 d-none d-lg-block fixed-bottom">
                <p style="letter-spacing: 5px;" class="text-center text-white fs-6">&copy; 2023 Phone-Shop.lk || All rights Reserved.</p>
            </div>
            <!--footer-->

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>