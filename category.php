<?php

require "connection.php";
session_start();

if (isset($_GET["id"])) {
    $cid = $_GET["id"];

    $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $cid . "'");
    $category_num = $category_rs->num_rows;

    $category_data = $category_rs->fetch_assoc();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $category_data["name"]; ?> | Phone Shop</title>
        <link rel="icon" href="resources/logo.ico" />

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    </head>

    <body>

        <?php
        require "header.php";
        ?>

        <?php



        $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $cid . "'");
        $category_num = $category_rs->num_rows;

        $category_data = $category_rs->fetch_assoc();

        ?>

        <div class="container-fluid mt-lg-6 px-5">
            <div class="row">

                <div class="col-12 mt-5 d-none d-lg-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none"><i class="bi bi-house-door-fill fs-4"></i></a></li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="bi bi-chevron-right fs-4 text-secondary"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="breadcrumb-item fs-5 text-secondary" disabled><?php echo $category_data["name"]; ?></li>
                    </ol>
                </div>

                <hr class="d-none d-lg-block" />

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="row">

                        <div class="col-lg-3 d-none d-lg-block">

                            <div class="col-8">
                                <h3 class="text-center">
                                    Brands
                                </h3>
                            </div>

                            <hr class="col-9" />

                            <div class="col-9">
                                <button class="col-11 offset-1 border-0 bg-white text-start fs-4">Apple</button>
                                <button class="col-11 offset-1 border-0 bg-white text-start fs-4">Acer</button>
                                <button class="col-11 offset-1 border-0 bg-white text-start fs-4">Asus</button>
                                <button class="col-11 offset-1 border-0 bg-white text-start fs-4">Dell</button>
                                <button class="col-11 offset-1 border-0 bg-white text-start fs-4">msi</button>
                            </div>

                            <hr class="border border-2 border-black col-9" />

                            <div class="col-9">
                                <h4>
                                    Filter by Price.
                                </h4>
                            </div>

                            <div class="col-9">
                                <div class="row">

                                    <div class="col-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                                    </div>

                                </div>
                            </div>

                            <div class="col-5 offset-2">
                                <button class="col-12 btn btn-danger">Filter</button>
                            </div>

                        </div>


                        <div class="col-lg-9">
                            <div class="row">

                                <div class="col-12">
                                    <h1 class="fw-bold"><?php echo $category_data["name"]; ?></h1>
                                </div>

                                <hr />

                                <div class="col-12 mt-3 mb-3">
                                    <div class="row gap-3">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $cid . "' ORDER BY `datetime_added` DESC");
                                        $product_num = $product_rs->num_rows;

                                        $results_per_page = 8;
                                        $number_of_pages = ceil($product_num / $results_per_page);
                                        $page_results = ($pageno - 1) * $results_per_page;

                                        $selected_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $cid . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();

                                        ?>

                                            <?php

                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data['id'] . "'");

                                            $img_data = $img_rs->fetch_assoc();

                                            ?>

                                            <div class="product-card" style="width: 17rem;">
                                                <div class="product-image">
                                                    <img src="<?php echo $img_data["path"] ?>" class="img w-100" alt="<?php echo $selected_data['title']; ?>">
                                                </div>

                                                <div class="card-body text-center">
                                                    <h5 class="product-title"><?php echo $selected_data["title"]; ?></h5>
                                                    <p class="product-price">Rs. <?php echo $selected_data["price"]; ?>.00</p>
                                                    <a href="<?php echo "singleproductview.php?id=" . ($selected_data['id']); ?>" class="add-cart" data-back="Add to Cart" data-front="Select Option"></a>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                                <div class="col-4 offset-7 mt-3 mb-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                echo ("#");
                                                                            } else {
                                                                                echo "?id=" . ($cid) . "&page=" . ($pageno - 1);
                                                                            } ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>

                                            <?php

                                            for ($y = 1; $y <= $number_of_pages; $y++) {
                                                if ($y == $pageno) {
                                            ?>

                                                    <li class="page-item active">
                                                        <a class="page-link" href="<?php echo "?id=" . ($cid) . "&page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>

                                                <?php
                                                } else {
                                                ?>

                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo "?id=" . ($cid) . "&page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>

                                            <?php
                                                }
                                            }
                                            ?>

                                            <li class="page-item">
                                                <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                echo ("#");
                                                                            } else {
                                                                                echo "?id=" . ($cid) . "&page=" . ($pageno + 1);
                                                                            } ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
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
        require "footer.php";
        ?>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>

    </body>

    </html>

<?php
} else {
?>
    <script>
        alert("Something went wrong");
    </script>
<?php
}

?>