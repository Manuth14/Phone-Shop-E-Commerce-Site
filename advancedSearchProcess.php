<?php

require "connection.php";

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if ($sort == 0) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_id`='" . $category . "'";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_id`='" . $category . "'";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='" . $brand . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($brand == 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id`='" . $model . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($brand != 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' 
        AND `model_id`='" . $model . "'");

        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    $cid = 0;
    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_id`='" . $color . "'");
        $clr_num = $clr_rs->num_rows;

        for ($x = 0; $x < $clr_num; $x++) {
            $clr_data = $clr_rs->fetch_assoc();
            $cid = $clr_data["product_id"];
        }

        if ($status == 0) {
            $query .= " WHERE `id`='" . $cid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `id`='" . $cid . "'";
        }
    }

    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "'";
        }
    }

    if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "'";
        }
    }

    if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        }
    }

} else if ($sort == 1) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `price` ASC";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_id`='" . $category . "' ORDER BY `price` ASC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_id`='" . $category . "' ORDER BY `price` ASC";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='" . $brand . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
        }
    }

    if ($brand == 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id`='" . $model . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
        }
    }

    if ($brand != 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' 
        AND `model_id`='" . $model . "'");

        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `condition_id`='" . $condition . "' ORDER BY `price` ASC";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_id`='" . $condition . "' ORDER BY `price` ASC";
    }

    $cid = 0;
    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_id`='" . $color . "'");
        $clr_num = $clr_rs->num_rows;

        for ($x = 0; $x < $clr_num; $x++) {
            $clr_data = $clr_rs->fetch_assoc();
            $cid = $clr_data["product_id"];
        }

        if ($status == 0) {
            $query .= " WHERE `id`='" . $cid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `id`='" . $cid . "' ORDER BY `price` ASC";
        }
    }

    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "' ORDER BY `price` ASC";
        }
    }

    if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "' ORDER BY `price` ASC";
        }
    }

    if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
        }
    }
}

$pageno;

if ("0" != ($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 1;
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

<div class="offset-2 offset-lg-3 col-8 col-lg-6 mt-5 mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>