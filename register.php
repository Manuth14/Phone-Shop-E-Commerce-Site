<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Manuth Thejaka" />
    <meta name="description" content="E-Commerce Web Application" />
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Register | Phone Shop</title>
    <link rel="icon" href="resources/icon.jpg" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <!-- signin Box -->
            <div style="padding: 20px 60px 10px 60px;" class="col-12 main" id="signinbox">
                <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="col-12">
                            <img style="padding: 30px;" src="resources/images/signin-image.jpg" alt="signin" class="w-100" />
                        </div>

                        <div class="col-12 text-center mb-3">
                            <button class="border-0 bg-white" onclick="changeView();">Create an account</button>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="col-12 mt-3 mb-5 text-lg-start text-center">
                            <h1 style="font-family: 'BriemHand'; font-style: italic;" class="fw-bold">Signin Here</h1>
                        </div>

                        <?php

                        $email = "";
                        $password = "";

                        if (isset($_COOKIE["email"])) {
                            $email = $_COOKIE["email"];
                        }

                        if (isset($_COOKIE["password"])) {
                            $password = $_COOKIE["password"];
                        }

                        ?>

                        <div class="input-group">
                            <input class="input" value="<?php echo $email ?>" type="email" placeholder="Your Email" id="email" />
                        </div>

                        <div class="input-group">
                            <input class="input col-11" value="<?php echo $password ?>" type="password" placeholder="Your Password" id="password" />
                            <span style="border: none; border-bottom: solid 1px #999; border-radius: 0px;" class="col-1 input-group-text"><i class="bi bi-eye-slash text-black"></i></span>
                        </div>

                        <div class="col-12 text-end">
                            <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>
                        </div>


                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberme" />
                            <label class="form-check-label" for="rememberme">
                                Remember Me.
                            </label>
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <button class="signin-btn" onclick="login();">Sign In</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- signin Box -->

            <!-- signup Box -->
            <div style="padding: 20px 60px 10px 60px;" class="col-12 main d-none" id="signupbox">
                <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="col-12 mt-3 mb-5 text-lg-start text-center">
                            <h1 style="font-family: 'BriemHand'; font-style: italic;" class="fw-bold">Signup Here</h1>
                        </div>

                        <div class="col-12 d-none" id="msgdiv">
                            <div class="alert alert-danger" role="alert" id="msg">

                            </div>
                        </div>

                        <div class="input-group">
                            <input type="text" class="input col-12 col-lg-6" placeholder="Your First Name" id="fname" />&nbsp;&nbsp;
                            <input type="text" class="input col-12 col-lg-6" placeholder="Your Last Name" id="lname" />
                        </div>

                        <div class="input-group">
                            <input class="input" type="email" placeholder="Your Email" id="remail" />
                        </div>

                        <div class="input-group">
                            <input class="input col-11" type="password" placeholder="Password" id="rpassword" />
                            <span style="border: none; border-bottom: solid 1px #999; border-radius: 0px;" class="col-1 input-group-text"><i class="bi bi-eye-slash text-black"></i></span>
                        </div>

                        <div class="input-group">
                            <input class="input" type="number" min="0" placeholder="Your Mobile" id="mobile" />
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="terms" />
                            <label class="form-check-label" for="terms">
                                I agree all statements in <a href="#">Terms of service</a>
                            </label>
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <button class="register-btn" onclick="signup();">Register</button>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="col-12">
                            <img style="padding: 30px;" src="resources/images/signup-image.jpg" alt="signup" class="w-100" />
                        </div>

                        <div class="col-12 text-center mb-3">
                            <button class="border-0 bg-white" onclick="changeView();">I am already member</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- signup Box -->

            <!-- modal-->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">New Password</label>

                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np" />
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword2();">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-Type New Password</label>

                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp" />
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword3();">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="from-control" id="vc" />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal-->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>