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

    <title>Account Information | Phone Shop</title>
    <link rel="icon" href="resources/icon.jpg" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body class="account-information-body">
    <?php
    include "header.php";

    if (isset($_SESSION["u"])) {

        $email = $_SESSION["u"]["email"];

        $details_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");

        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `district` ON 
                user_has_address.district_id=district.id INNER JOIN `province` ON 
                district.province_id=province.id WHERE `user_email`='" . $email . "'");

        $user_details = $details_rs->fetch_assoc();
        $image_details = $image_rs->fetch_assoc();
        $address_details = $address_rs->fetch_assoc();

    ?>

        <!-- basic Search -->
        <div class="container-fluid mt-lg-6">
            <div class="row">
                <div id="basicSearchResult"></div>
            </div>
        </div>
        <!-- basic Search -->

        <div class="container-fluid">
            <div class="row">

                <!-- large device -->
                <div class="col-3 bg-white d-none d-lg-block">
                    <div class="accordion mt-5" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <i class="bi bi-gear-fill fs-4"></i> &nbsp; Settings
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="d-flex align-items-start">
                                        <div class="col-12 nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <button class="nav-link active" id="v-pills-Account-Information-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Account-Information" type="button" role="tab" aria-controls="v-pills-Account-Information" aria-selected="true">Account Information</button>
                                            <button class="nav-link" id="v-pills-Change-Pasword-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Change-Pasword" type="button" role="tab" aria-controls="v-pills-Change-Pasword" aria-selected="false">Change Password</button>
                                            <button class="nav-link" id="v-pills-Address-Information-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Address-Information" type="button" role="tab" aria-controls="v-pills-Address-Information" aria-selected="false">Address Information</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- large device -->

                <!-- small device -->
                <div class="col-2 bg-white d-block d-lg-none">
                    <button class="border-0 bg-white mt-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <img src="resources/icon/menu.png" width="40" alt="menu" />
                    </button>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h3 class="offcanvas-title" id="offcanvasExampleLabel">Phone Shop</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="accordion mt-5" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                            <i class="bi bi-gear-fill fs-4"></i> &nbsp; Settings
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="d-flex align-items-start">
                                                <div class="col-12 nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <button class="nav-link active" id="v-pills-Account-Information-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Account-Information" type="button" role="tab" aria-controls="v-pills-Account-Information" aria-selected="true">Account Information</button>
                                                    <button class="nav-link" id="v-pills-Change-Pasword-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Change-Pasword" type="button" role="tab" aria-controls="v-pills-Change-Pasword" aria-selected="false">Change Password</button>
                                                    <button class="nav-link" id="v-pills-Address-Information-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Address-Information" type="button" role="tab" aria-controls="v-pills-Address-Information" aria-selected="false">Address Information</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- small device -->

                <div class="col-10 col-lg-9 tab-content" id="v-pills-tabContent">
                    <!-- account-information -->
                    <div class="tab-pane fade show active" id="v-pills-Account-Information" role="tabpanel" aria-labelledby="v-pills-Account-Information-tab" tabindex="0">
                        <div class="row">
                            <div class="col-12 mt-5 text-center">
                                <h1>Account Information</h1>
                            </div>

                            <div style="padding-left: 25px; padding-right: 25px;" class="col-10 offset-1 mt-4 mb-5 user-box">
                                <div class="row">
                                    <div class="col-12 text-center text-lg-start">

                                        <?php

                                        if (empty($image_details["path"])) {
                                        ?>
                                            <img src="resources/user.png" class="rounded" id="img" width="120" alt="user" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_details["path"]; ?>" class="rounded" id="img" width="120" alt="user" />
                                        <?php
                                        }

                                        ?>

                                        <input type="file" class="d-none" id="profileImage" />
                                        <label for="profileImage" onclick="changeProfileImg();" class="photo-btn mt-2 mx-3">Update Profile Image</label>
                                    </div>

                                    <div class="col-12 col-lg-6 mt-lg-5 mt-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" id="fname" class="form-control" value="<?php echo $user_details["fname"]; ?>" />
                                    </div>

                                    <div class="col-12 col-lg-6 mt-lg-5 mt-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" id="lname" class="form-control" value="<?php echo $user_details["lname"]; ?>" />
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" id="email" class="form-control" value="<?php echo $user_details["email"]; ?>" />
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" id="mobile" class="form-control" value="<?php echo $user_details["mobile"]; ?>" />
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label">Date of Birth</label>

                                        <?php
                                        if (empty($user_details["date_of_birth"])) {
                                        ?>
                                            <input type="date" id="dob" class="form-control" />
                                        <?php
                                        } else {
                                        ?>
                                            <input type="date" id="dob" class="form-control" value="<?php echo $user_details["date_of_birth"]; ?>" />
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label">Gender</label>
                                        <?php
                                        if (empty($user_details["gender_id"])) {
                                        ?>
                                            <select class="form-control" id="gender">
                                                <option value="0">Select gender</option>

                                                <?php

                                                $gender_rs = Database::search("SELECT * FROM `gender`");
                                                $gender_num = $gender_rs->num_rows;

                                                for ($x = 0; $x < $gender_num; $x++) {
                                                    $gender_data = $gender_rs->fetch_assoc();
                                                ?>

                                                    <option value="<?php echo $gender_data["id"]; ?>">
                                                        <?php echo $gender_data["gender_name"]; ?>
                                                    </option>

                                                <?php
                                                }
                                                ?>

                                            </select>

                                        <?php
                                        } else {
                                        ?>
                                            <select class="form-control" id="gender">

                                                <?php

                                                $gender_rs = Database::search("SELECT * FROM `gender`");
                                                $gender_num = $gender_rs->num_rows;

                                                for ($x = 0; $x < $gender_num; $x++) {
                                                    $gender_data = $gender_rs->fetch_assoc();
                                                ?>

                                                    <option value="<?php echo $gender_data["id"]; ?>">
                                                        <?php echo $gender_data["gender_name"]; ?>
                                                    </option>

                                                <?php
                                                }
                                                ?>

                                            </select>
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" readonly class="form-control" value="<?php echo $user_details["password"]; ?>" />
                                    </div>

                                    <div class="col-12 mb-4 mt-3">
                                        <label class="form-label">Register Date</label>
                                        <input type="text" readonly class="form-control" value="<?php echo $user_details["register_date"]; ?>" />
                                    </div>

                                    <div class="col-12 text-center">
                                        <button class="col-12 col-lg-4 update-information-btn" onclick="updateInformation();">Update Informations</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- account-information -->

                    <!-- change-password -->
                    <div class="tab-pane fade" id="v-pills-Change-Pasword" role="tabpanel" aria-labelledby="v-pills-Change-Pasword-tab" tabindex="0">
                        <div class="row">
                            <div class="col-12 mt-5 text-center">
                                <h1>Change Password</h1>
                            </div>

                            <div style="padding-left: 25px; padding-right: 25px;" class="col-10 offset-1 mt-4 mb-5 user-box">
                                <div class="row">

                                    <div class="col-12 mt-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" id="cpw" class="form-control" />
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" id="npw" class="form-control" />
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4 mt-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" id="cnpw" class="form-control" />
                                    </div>

                                    <div class="col-12 text-center">
                                        <button class="col-12 col-lg-4 update-information-btn" onclick="">Update Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- change-password -->

                    <!-- address-information -->
                    <div class="tab-pane fade" id="v-pills-Address-Information" role="tabpanel" aria-labelledby="v-pills-Address-Information-tab" tabindex="0">
                        <div class="row">
                            <div class="col-12 mt-5 text-center">
                                <h1>Address Information</h1>
                            </div>

                            <div style="padding-left: 25px; padding-right: 25px;" class="col-10 offset-1 mt-4 mb-5 user-box">
                                <div class="row">

                                    <div class="col-12 mt-3">
                                        <label class="form-label">Address Line 01</label>
                                        <?php
                                        if (empty($address_details["line1"])) {
                                        ?>
                                            <input type="text" id="line1" class="form-control" />
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" id="line1" class="form-control" value="<?php echo $address_details["line1"]; ?>" />
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="form-label">Address Line 02</label>
                                        <?php
                                        if (empty($address_details["line2"])) {
                                        ?>
                                            <input type="text" id="line2" class="form-control" />
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" id="line2" class="form-control" value="<?php echo $address_details["line2"]; ?>" />
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <?php
                                    $province_rs = Database::search("SELECT * FROM `province`");
                                    $district_rs = Database::search("SELECT * FROM `district`");

                                    $province_num = $province_rs->num_rows;
                                    $district_num = $district_rs->num_rows;
                                    ?>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" id="province">
                                            <option value="0">Select Province</option>
                                            <?php
                                            for ($x = 0; $x < $province_rs->num_rows; $x++) {
                                                $province_data = $province_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $province_data["id"]; ?>" <?php
                                                                                                    if (!empty($address_details["id"])) {
                                                                                                        if ($province_data["id"] == $address_details["id"]) {
                                                                                                    ?>selected<?php
                                                                                                            }
                                                                                                        }
                                                                                                                ?>>
                                                    <?php echo $province_data["province_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="district">
                                            <option value="0">Select District</option>
                                            <?php
                                            for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                                $district_data = $district_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $district_data["id"]; ?>" <?php
                                                                                                    if (!empty($address_details["id"])) {
                                                                                                        if ($district_data["id"] == $address_details["district_id"]) {
                                                                                                    ?>selected<?php
                                                                                                            }
                                                                                                        }
                                                                                                                ?>>
                                                    <?php echo $district_data["district_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label">City</label>
                                        <?php
                                        if (empty($address_details["city"])) {
                                        ?>
                                            <input type="text" id="city" class="form-control" />
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" id="city" class="form-control" value="<?php echo $address_details["city"]; ?>" />
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4 mt-3">
                                        <label class="form-label">Postal Code</label>
                                        <?php
                                        if (empty($address_details["postal_code"])) {
                                        ?>
                                            <input type="number" min="1" max="99999" id="pcode" class="form-control" />
                                        <?php
                                        } else {
                                        ?>
                                            <input type="number" min="1" max="99999" id="pcode" class="form-control" value="<?php echo $address_details["postal_code"]; ?>" />
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button class="col-12 col-lg-4 update-information-btn" onclick="updateAddress();">Update Informations</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- address-information -->
                </div>
            </div>
        </div>

    <?php
    } else {
    ?>
        <div style="margin-top: 125px;" class="container">
            <div class="row">

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
    }
    include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>







<!--  -->