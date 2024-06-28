<?php
require "connection.php";

$query = "SELECT * FROM `product`";
$pageno;

if (isset($_GET["page"])) {
    $pageno = $_GET["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 10;
$number_of_pages = ceil($product_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

$selected_num = $selected_rs->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Manuth Thejaka" />
    <meta name="description" content="E-Commerce Web Application" />
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Product | Admin Panel</title>
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
            <h1 class="topic">Product</h1>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">

            <div class="col-12">
                <div class="row">

                    <div class="col-10 offset-1">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="input-group ">
                                        <input type="text" class=" form-control" placeholder="Search Products" aria-label="Text input with dropdown button" id="basic_search_txt">
                                        <select class="form-select" id="basic_search_select">
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
                                        <div class="col-2">
                                            <button class="btn btn-outline-primary" onclick="basicSearch(0);">Search Product</button>
                                        </div>

                                        <div class="col-2">
                                            <button class="btn btn-outline-danger" onclick="window.location='addProduct.php';">Add Products</button>
                                        </div>

                                        <div class="col-2">
                                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Categories</button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Category</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <label class="form-label">New Category Name : </label>
                                                                <input type="text" class="form-control" id="n" />
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <label class="form-label">Enter Your Email : </label>
                                                                <input type="text" class="form-control" id="e" />
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-success" onclick="verifyCategory();">Save New Category</button>
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
    </div>

    <div class="container mt-5" id="basicSearchResult">
        <div class="row">

            <div class="col-12">
                <div class="row justify-content-between">

                    <div class="col-3 text-center">
                        <h5>Product Name</h5>
                    </div>

                    <div class="col-1 text-center">
                        <h5>Image</h5>
                    </div>

                    <div class="col-2 text-center">
                        <h5>Unit Price</h5>
                    </div>

                    <div class="col-2 text-center">
                        <h5>Status</h5>
                    </div>

                    <div class="col-2 text-center">
                        <h5>Inventory</h5>
                    </div>

                    <div class="col-1 text-center">
                        <h5>Actions</h5>
                    </div>

                </div>
            </div>

            <?php
            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                $image_num = $image_rs->num_rows;
                $image_data = $image_rs->fetch_assoc();
            ?>

                <div class="col-12">
                    <div class="row justify-content-between">

                        <div class="col-3 mt-3 text-center">
                            <span><?php echo $selected_data["title"]; ?></span>
                        </div>

                        <div class="col-1 text-center">
                            <img src="<?php echo $image_data['path']; ?>" class="w-75" alt="" />
                        </div>

                        <div class="col-2 mt-3 text-center">
                            <span>Rs. <?php echo $selected_data["price"]; ?> .00</span>
                        </div>

                        <div class="col-2 mt-3 text-center">
                            <span<i class="bi bi-toggle-on fs-4"></i></span>
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

            <!--  -->
            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="
                            <?php if ($pageno <= 1) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno - 1);
                            } ?>
                            " aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>

                        <li class="page-item">
                            <a class="page-link" href="
                            <?php if ($pageno >= $number_of_pages) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno + 1);
                            } ?>
                            " aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--  -->

        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>