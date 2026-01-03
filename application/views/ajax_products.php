<?php
if (!empty($products)) {
    foreach ($products as $product) {
        $desc = strip_tags($product->description);
        $desc = mb_convert_case($desc, MB_CASE_TITLE, "UTF-8"); // Only makes each word Title Case
        $desc = mb_strtolower($desc, "UTF-8"); // Make all lowercase
        $desc = mb_strtoupper(mb_substr($desc, 0, 1, "UTF-8"), "UTF-8") . mb_substr($desc, 1, null, "UTF-8");
        $desc = mb_substr($desc, 0, 70) . "...";
?>

        <div class="col-md-6 col-lg-4 col-xl-3 organic-products">
            <div class="rounded position-relative fruite-item">
                <div class="fruite-img border border-secondary border-bottom-0" style="width: 100%; height:260px;">
                    <img src="<?= base_url('assets/uploads/products/medium/' . $product->image_name) ?>" class="img-fluid w-100 rounded-top" alt="<?= $product->alt_text ?>" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $product->category_name ?></div>
                <div class="p-4 border border-secondary  rounded-bottom product-content" style="height:245px; max-height:245px;">
                    <h4 class="product-title"><?= $product->product_name ?></h4>
                    <p class="text-dark fs-5 fw-bold mb-0 text-start product-price">&#8377; <?= $product->price ?> <span> / <?= $product->short_name ?></span></p>
                    <p class="text-start product-desc"><?= $desc ?></p>

                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart mt-0" data-id="<?= $product->id ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                </div>
            </div>
        </div>
    <?php
    }
} else {
    ?>

    <?php
    // show shop page on product
    if (!empty($category_name)) {
    ?>
        <input type="hidden" value="<?= $category_name ?>" id="current_category">
    <?php
    }

    if (!empty($shopProducts)) { ?>
        <?php foreach ($shopProducts as $product) {
            $desc = strip_tags($product->description);
            $desc = mb_convert_case($desc, MB_CASE_TITLE, "UTF-8"); // Only makes each word Title Case
            $desc = mb_strtolower($desc, "UTF-8"); // Make all lowercase
            $desc = mb_strtoupper(mb_substr($desc, 0, 1, "UTF-8"), "UTF-8") . mb_substr($desc, 1, null, "UTF-8");
            $desc = mb_substr($desc, 0, 100) . "...";
        ?>
            <div class="col-md-6 col-lg-6 col-xl-4 product-shop">
                <div class="rounded position-relative fruite-item">
                    <div class="fruite-img border border-bottom border-secondary" style="border-bottom: 1px;">
                        <img src="<?= base_url('assets/uploads/products/medium/' . $product->image_name) ?>" class="img-fluid w-100 rounded-top" alt="<?= $product->alt_text ?>">
                    </div>
                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $product->category_name ?></div>
                    <div class="p-4 border border-secondary  rounded-bottom product-content" style="height:245px; max-height:245px;">
                        <h4 class="product-title"><?= $product->product_name ?></h4>
                        <p class="text-dark fs-5 fw-bold mb-0 text-start product-price">&#8377; <?= $product->price ?> <span> / <?= $product->short_name ?></span></p>
                        <p class="text-start product-desc"><?= $desc ?></p>

                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart mt-0" data-id="<?= $product->product_id ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                    </div>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="text-center bg-secondary p-4 text-light fs-2 rounded">No items available</div>

<?php   }
}
?>
