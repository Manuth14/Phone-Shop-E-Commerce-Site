<?php
include "connection.php";

$txt = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `product` ";

if (!empty($txt) && $select == 0) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%'";
} else if (empty($txt) && $select != 0) {
    $query .= "WHERE `category_id`='" . $select . "'";
} else if (!empty($txt) && $select != 0) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%' AND `category_id`='" . $select . "'";
}

?>

<div class="row">
    <div class="col-12 mt-5">
        <div class="row justify-content-center gap-3">

            <?php

            $pageno;

            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 5;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;
            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                $img_data = $img_rs->fetch_assoc();

            ?>

                <div class="product-card" style="width: 17rem;">
                    <div class="product-image">
                        <img src="<?php echo $img_data["path"] ?>" class="img w-100" alt="<?php echo $selected_data['title'] ?>" />

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

    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-5 mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php
                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }
                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>