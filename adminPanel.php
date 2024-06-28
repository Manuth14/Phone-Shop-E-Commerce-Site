<?php
session_start();
require "connection.php";

if (isset($_SESSION["au"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="Manuth Thejaka" />
        <meta name="description" content="E-Commerce Web Application" />
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Admin Panel | Phone Shop</title>
        <link rel="icon" href="resources/icon.jpg" />

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

        <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.css" />
        <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://d3js.org/d3.v4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="row">

                        <div class="col-3">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h1 class="fw-bold mt-1">Phone Shop.</h1>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="d-flex align-items-start">
                                                <div class="col-12 nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <button class="nav-link my-2 active text-start">Dashboard</button>
                                                    <button class="nav-link my-2 text-start" onclick="window.location='products.php';"><i class="bi bi-archive"></i>&nbsp; Products</button>
                                                    <button class="nav-link my-2 text-start"><i class="bi bi-cart-check"></i>&nbsp; Orders</button>
                                                    <button class="nav-link my-2 text-start" onclick="window.location='users.php';"><i class="bi bi-person-bounding-box"></i>&nbsp; Customers</button>
                                                    <button class="nav-link my-2 text-start"><i class="bi bi-person-video3"></i>&nbsp; Sellers</button>
                                                    <button class="nav-link my-2 text-start"><i class="bi bi-headset"></i>&nbsp; Support</button>
                                                    <button class="nav-link my-2 text-start"><i class="bi bi-gear"></i>&nbsp; Settings</button>
                                                    <button class="nav-link my-2 text-start" onclick="logout();"><i class="bi bi-box-arrow-right"></i>&nbsp; Logout</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-9">
                            <div class="row">

                                <?php

                                $today = date("Y-m-d");
                                $thismonth = date("m");
                                $thisyear = date("Y");

                                $a = "0";
                                $b = "0";
                                $c = "0";
                                $e = "0";
                                $f = "0";

                                $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                $invoice_num = $invoice_rs->num_rows;

                                for ($x = 0; $x < $invoice_num; $x++) {
                                    $invoice_data = $invoice_rs->fetch_assoc();

                                    $f = $f + $invoice_data["qty"]; //total qty

                                    $d = $invoice_data["date_time"];
                                    $splitDate = explode(" ", $d); //separate the date from time
                                    $pdate = $splitDate["0"]; //sold date

                                    if ($pdate == $today) {
                                        $a = $a + $invoice_data["total"];
                                        $c = $c + $invoice_data["qty"];
                                    }

                                    $splitMonth = explode("-", $pdate); //separate date as year,month & day
                                    $pyear = $splitMonth["0"]; //year
                                    $pmonth = $splitMonth["1"]; //month

                                    if ($pyear == $thisyear) {
                                        if ($pmonth == $thismonth) {
                                            $b = $b + $invoice_data["total"];
                                            $e = $e + $invoice_data["qty"];
                                        }
                                    }
                                }

                                ?>

                                <div class="col-12 mt-5">
                                    <div class="row justify-content-between">

                                        <div class="col-2 bg-danger text-white rounded-3">
                                            <p class="fw-bold text-white">Daily Earnings</p>
                                            <h4>Rs. <?php echo $a; ?> .00</h4>
                                        </div>

                                        <div class="col-2 bg-primary text-white rounded-3">
                                            <p class="fw-bold text-white">Monthly Earnings</p>
                                            <h4>Rs. <?php echo $b; ?> .00</h4>
                                        </div>

                                        <div class="col-2 bg-warning text-white rounded-3">
                                            <p class="fw-bold text-white">Today Sellings </p>
                                            <h4><?php echo $c; ?> Items</h4>
                                        </div>

                                        <div class="col-2 bg-info text-white rounded-3">
                                            <p class="fw-bold text-white">Monthly Sellings </p>
                                            <h4><?php echo $e; ?> Items</h4>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 mt-5">
                                    <div class="row justify-content-between">

                                        <div class="col-12 col-lg-8">

                                            <div class="col-12">
                                                <h3 style="color: rgb(60, 60, 60); letter-spacing: 1px;" class="fw-bold">Sales Chart &nbsp;<i class="bi bi-question-circle fs-4 text-danger"></i></h3>
                                            </div>

                                            <div class="col-12 bg-white rounded-4">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="row">

                                                            <div class="col-11 col-lg-7 offset-lg-1">
                                                                <span class="fs-1"><i class="bi bi-bag-check fs-1 text-success"></i>&nbsp; Rs. <?php echo $b; ?> .00</span>
                                                                &nbsp;&nbsp;
                                                                <span class="fs-5 text-success"><i class="bi bi-arrow-up fs-5"></i> 8.30%</span>
                                                            </div>

                                                            <canvas id="myChart" style="width:100%; margin-left: 10px;"></canvas>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-lg-4">

                                            <div class="col-12 col-lg-10 offset-lg-1">
                                                <h3 style="color: rgb(60, 60, 60); letter-spacing: 1px;" class="fw-bold">Channel &nbsp;<i class="bi bi-question-circle fs-4 text-danger"></i></h3>
                                            </div>

                                            <div class="col-12 col-lg-10 offset-lg-1 bg-white rounded-4">
                                                <div class="row">

                                                    <div class="col-4">
                                                        <div class="row">
                                                            <div class="col-12 text-center rounded" style="height: 100px;">
                                                                <br />
                                                                <span class="fs-2 fw-bold text-success">70%</span>
                                                                <br />
                                                                <span class="fs-5 text-success"><i class="bi bi-arrow-up text-success"></i>10.50%</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="row">
                                                            <div class="col-12 text-center rounded" style="height: 100px;">
                                                                <br />
                                                                <span class="fs-2 fw-bold text-primary">20%</span>
                                                                <br />
                                                                <span class="fs-5 text-danger"><i class="bi bi-arrow-down text-danger"></i>15.50%</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="row">
                                                            <div class="col-12 text-center rounded" style="height: 100px;">
                                                                <br />
                                                                <span class="fs-2 fw-bold text-secondary">20%</span>
                                                                <br />
                                                                <span class="fs-5 text-success"><i class="bi bi-arrow-up text-success"></i>2.50%</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <canvas id="donutChart" style="width:50%;" class="mb-4"></canvas>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="row">

                                <div class="col-6 col-lg-4 text-center" style="height: 200px;">
                                    <div class="card rounded-4">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="bi bi-basket" style="font-size: 35px;"></i></h5>
                                            <p class="card-text fw-bold fs-2" style="letter-spacing: 2px;">Sold</p>
                                            <p class="fw-bold fs-3" style="letter-spacing: 2px;"><?php echo $invoice_num; ?></p>
                                            <p class="text-success fw-bold">Over last month 1.4% <i class="bi bi-arrow-up text-success"></i></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 text-center" style="height: 200px;">
                                    <div class="card rounded-4">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="bi bi-card-list" style="font-size: 35px;"></i></h5>
                                            <p class="card-text fw-bold fs-2" style="letter-spacing: 2px;">Sales</p>
                                            <p class="fw-bold fs-3" style="letter-spacing: 2px;">8</p>
                                            <p class="text-danger fw-bold">Over last month 2.4% <i class="bi bi-arrow-down text-danger"></i></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 mt-5 mt-lg-0">
                                    <div class="card rounded-4" style="height: 220px;">
                                        <div class="card-body">

                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="col-8">
                                                        <h5 class="card-title fw-bold fs-3">Recent Reviews</h5>
                                                    </div>

                                                    <div class="col-4 text-end">
                                                        <h5 class="text-danger vw-all">View All <i class="bi bi-arrow-right text-danger"></i></h5>
                                                    </div>

                                                    <br /><br />

                                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">

                                                                <div class="col-12 card-text">
                                                                    <div class="row">

                                                                        <div class="col-3">
                                                                            <img style="border-radius: 50%;" src="resources/user.png" width="60" height="60" class="bg-primary my-1" />
                                                                        </div>

                                                                        <div class="col-9">
                                                                            <div class="col-12 mt-2">
                                                                                <h4 class="fw-bold">Manuth Thejaka</h4>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <span class="badge">
                                                                                    <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                                    <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                                    <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                                    <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                                    <i class="bi bi-star-fill text-warning fs-5"></i>

                                                                                    &nbsp;&nbsp;&nbsp;

                                                                                    <label class="fs-5 text-dark fw-bold">( 5 )</label>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 mt-3">
                                                                            <span class="fw-bold">I Love your Products. It is very easy and fun to use this panel.</span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?php

                                                            $feedback_rs = Database::search("SELECT * FROM `feedback`");

                                                            $feedback_num = $feedback_rs->num_rows;

                                                            $feed_user_rs = Database::search("SELECT * FROM `user`");
                                                            $feed_user_data = $feed_user_rs->fetch_assoc();

                                                            for ($x = 0; $x < $feedback_num; $x++) {
                                                                $feedback_data = $feedback_rs->fetch_assoc();

                                                                $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $feedback_data['user_email'] . "'");

                                                                $img_data = $img_rs->fetch_assoc();

                                                            ?>

                                                                <div class="carousel-item">
                                                                    <div class="col-12 card-text">
                                                                        <div class="row">

                                                                            <div class="col-3">
                                                                                <img style="border-radius: 50%;" src="<?php echo $img_data['path']; ?>" width="60" height="60" class="bg-primary my-1" />
                                                                            </div>

                                                                            <div class="col-9">
                                                                                <div class="col-12 mt-2">
                                                                                    <h4 class="fw-bold"><?php echo $feed_user_data["fname"] . " " . $feed_user_data["lname"]; ?></h4>
                                                                                </div>

                                                                                <div class="col-12">
                                                                                    <span class="badge">
                                                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                                        <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                                                        <i class="bi bi-star-fill text-secondary fs-5"></i>

                                                                                        &nbsp;&nbsp;&nbsp;

                                                                                        <label class="fs-5 text-dark fw-bold">( 3 )</label>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12 mt-3">
                                                                                <span class="fw-bold"><?php echo $feedback_data["context"]; ?></span>
                                                                            </div>

                                                                        </div>
                                                                    </div>
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
                                </div>

                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="row">

                                <div class="col-12">
                                    <h3 style="color: rgb(60, 60, 60); letter-spacing: 1px;" class="fw-bold">Recent Products</h3>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="card rounded-4">
                                        <div class="card-body">
                                            <h5 class="card-title text-secondary">Products added today. Click <a class="fs-5" href="products.php">here</a> for more details</h5>

                                            <div class="col-12 mt-4">
                                                <div class="row justify-content-between">

                                                    <div class="col-4 text-center">
                                                        <h4>Product Name</h4>
                                                    </div>

                                                    <div class="col-1 text-center">
                                                        <h4>Image</h4>
                                                    </div>

                                                    <div class="col-2 text-center">
                                                        <h4>Unit Price</h4>
                                                    </div>

                                                    <div class="col-2 text-center">
                                                        <h4>Inventory</h4>
                                                    </div>

                                                    <div class="col-1 text-center">
                                                        <h4>Actions</h4>
                                                    </div>

                                                </div>
                                            </div>

                                            <hr />

                                            <?php
                                            $selected_rs = Database::search("SELECT * FROM `product` ORDER BY
                                        `datetime_added` LIMIT 3 OFFSET 0");

                                            $selected_num = $selected_rs->num_rows;

                                            for ($x = 0; $x < $selected_num; $x++) {
                                                $selected_data = $selected_rs->fetch_assoc();

                                                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                $image_num = $image_rs->num_rows;
                                                $image_data = $image_rs->fetch_assoc();
                                            ?>

                                                <div class="col-12">
                                                    <div class="row justify-content-between">

                                                        <div class="col-4 mt-3 text-center">
                                                            <span><?php echo $selected_data["title"]; ?></span>
                                                        </div>

                                                        <div class="col-1 text-center">
                                                            <img src="<?php echo $image_data['path']; ?>" class="w-75" alt="" />
                                                        </div>

                                                        <div class="col-2 mt-3 text-center">
                                                            <span>Rs. <?php echo $selected_data["price"]; ?> .00</span>
                                                        </div>

                                                        <div class="col-2 mt-3 text-center">
                                                            <span><?php echo $selected_data["qty"]; ?> in Stock</span>
                                                        </div>

                                                        <div class="col-1 mt-3 text-center">
                                                            <button class="bg-white border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">...</button>
                                                            <div class="dropdown">
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">Block Product</a></li>
                                                                    <li class="dropdown-item" onclick="sendid(<?php echo $selected_data['id']; ?>);">Update Product</li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <hr />

                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="row">

                                <div class="col-12">
                                    <h3 style="color: rgb(60, 60, 60); letter-spacing: 1px;" class="fw-bold">Recent Customers</h3>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="card rounded-4">
                                        <div class="card-body">
                                            <h5 class="card-title text-secondary">Customers who registered today. Click <a class="fs-5" href="users.php">here</a> for more details</h5>

                                            <div class="col-12 mt-4">
                                                <div class="row justify-content-between">

                                                    <div class="col-3 text-center">
                                                        <h5>User Name</h5>
                                                    </div>

                                                    <div class="col-1 text-center">
                                                        <h5>Image</h5>
                                                    </div>

                                                    <div class="col-3 text-center">
                                                        <h5>Email</h5>
                                                    </div>

                                                    <div class="col-2 text-center">
                                                        <h5>Mobile</h5>
                                                    </div>

                                                    <div class="col-1 text-center">
                                                        <h5>Actions</h5>
                                                    </div>

                                                </div>
                                            </div>

                                            <hr />

                                            <?php

                                            $user_rs = Database::search("SELECT * FROM `user` ORDER BY `register_date` LIMIT 3 OFFSET 0");

                                            $user_num = $user_rs->num_rows;

                                            for ($x = 0; $x < $user_num; $x++) {
                                                $user_data = $user_rs->fetch_assoc();

                                                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $user_data["email"] . "'");
                                                $image_num = $image_rs->num_rows;
                                                $image_data = $image_rs->fetch_assoc();
                                            ?>

                                                <div class="col-12">
                                                    <div class="row justify-content-between">

                                                        <div class="col-3 mt-3 text-center">
                                                            <span><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span>
                                                        </div>

                                                        <div class="col-1 text-center">
                                                            <?php
                                                            if (empty($image_data["path"])) {
                                                            ?>
                                                                <img src="resources/user.png" class="w-75" alt="user" />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="<?php echo $image_data['path']; ?>" class="w-75" alt="user" />
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <div class="col-3 mt-3 text-center">
                                                            <span><?php echo $user_data["email"]; ?></span>
                                                        </div>

                                                        <div class="col-2 mt-3 text-center">
                                                            <span><?php echo $user_data["mobile"]; ?></span>
                                                        </div>

                                                        <div class="col-1 mt-3 text-center">
                                                            <button class="bg-white border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">...</button>
                                                            <div class="dropdown">
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">Block User</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <hr />

                                            <?php
                                            }
                                            ?>

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

        </div>
        </div>

        <!-- bar chart -->
        <script>
            var xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var yValues = [13, 10, 11, 7, 5, <?php echo $e; ?>];
            var barColors = ["yellow", "red", "blue", "purple", "brown", "red", "blue", "purple", "brown"];

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: ""
                    }
                }
            });
        </script>

        <!-- donut chart -->
        <script>
            var ctx = document.getElementById("donutChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Social Media", "Google", "Email"],
                    datasets: [{
                        backgroundColor: [
                            "#2ecc71",
                            "#3498db",
                            "#95a5a6"
                        ],
                        data: [70, 20, 10]
                    }]
                }
            });
        </script>

        <script src="script.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.js"></script>
    </body>

    </html>
<?php

} else {
    echo ("You are not a valid user.");
}

?>