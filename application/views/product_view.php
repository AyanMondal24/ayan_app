<div class="container-fluid  product-single-view py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="row bg-white shadow-sm rounded p-4">

                <!-- LEFT : IMAGE SECTION -->
                <div class="col-md-5 d-flex">

                    <!-- Thumbnails -->
                    <div class="thumb-column me-3">
                        <?php foreach ($images as $img): ?>
                            <img src="<?= base_url('assets/uploads/products/medium/' . $img['image_name']) ?>"
                                class="thumb"
                                onclick="changeImage(this)"
                                alt="<?= $img['alt_text'] ?>">
                        <?php endforeach; ?>
                    </div>

                    <!-- Main Image -->
                    <div class="main-image flex-grow-1">
                        <img id="mainPreview"
                            src="<?= base_url('assets/uploads/products/medium/' . $featured_images->image_name) ?>"
                            alt="<?= $featured_images->alt_text ?>">
                    </div>

                </div>

                <!-- RIGHT : PRODUCT DETAILS -->
                <div class="col-md-7 product-details">

                    <h3 class="fw-bold mb-2">
                        <?= $product->product_name ?>
                    </h3>

                    <p class="text-muted mb-1"><?= $product->category_name ?></p>

                    <h4 class="text-success fw-bold mb-3">
                        ₹<?= number_format($product->price, 2) ?>
                        <small class="text-muted fs-6">/ <?= $product->short_name ?></small>
                    </h4>

                    <div class="description-box mb-4">
                        <?= htmlspecialchars_decode($product->description) ?>
                    </div>


                    <!-- STATUS -->
                    <div class="mb-4">
                        <?php if ($product->status == '0'): ?>
                            <span class="badge bg-success me-2">Active</span>
                        <?php else: ?>
                            <span class="badge bg-danger me-2">Inactive</span>
                        <?php endif; ?>

                        <?php if ($product->is_available == '0'): ?>
                            <span class="badge bg-success">Available</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Unavailable</span>
                        <?php endif; ?>
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="d-flex gap-3">
                        <!-- <button class="btn btn-warning btn-lg">Add to Cart</button> -->
                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart mt-0" data-id="<?= $product->id ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        <!-- <button class="btn btn-outline-primary btn-lg">Buy Now</button> -->
                    </div>

                </div>
            </div>

            <div class="mt-4">
                <div class="row g-4" id="show-shop-product">
                    <?php foreach ($products as $product) {
                        $desc = strip_tags($product->description);
                        $desc = mb_convert_case($desc, MB_CASE_TITLE, "UTF-8"); // Only makes each word Title Case
                        $desc = mb_strtolower($desc, "UTF-8"); // Make all lowercase
                        $desc = mb_strtoupper(mb_substr($desc, 0, 1, "UTF-8"), "UTF-8") . mb_substr($desc, 1, null, "UTF-8");
                        $desc = mb_substr($desc, 0, 70) . "...";
                    ?>
                        <div class="col-md-3 col-lg-3 col-xl-3 product-shop">
                            <div class="rounded position-relative fruite-item">
                                <div class="fruite-img border border-bottom border-secondary" style="border-bottom: 1px;">
                                    <img src="<?= base_url('assets/uploads/products/medium/' . $product->image_name) ?>" class="img-fluid w-100 rounded-top" alt="<?= $product->alt_text ?>">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $product->category_name ?></div>
                                <div class="p-4 border border-secondary rounded-bottom product-content" style="height:245px; max-height:245px;">
                                    <h4 class="product-title"><a href="<?= base_url('category/' . $product->category_slug . '/product/' . $product->slug) ?>">
                                            <?= $product->product_name ?>
                                        </a></h4>
                                    <p class="text-dark fs-5 fw-bold mb-0 text-start product-price">&#8377; <?= $product->price ?> <span> / <?= $product->short_name ?></span></p>
                                    <p class="text-start product-desc"><?= $desc ?></p>

                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart mt-0" data-id="<?= $product->product_id ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
            <a href="<?= base_url('shop') ?>" class="btn btn-outline-secondary mt-4">
                ← Back
            </a>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // add to cart
        $(document).on("click", ".add-to-cart", function(e) {
            e.preventDefault();

            let product_id = $(this).data('id');
            let quantity = 1;
            let button = $(this);
            $.ajax({
                url: "<?= base_url('Cart/add_to_cart') ?>",
                type: "POST",
                data: {
                    product_id: product_id,
                    quantity: quantity,
                    update_mode: "add"
                },
                dataType: "JSON",
                success: function(response) {
                    // console.log(response)
                    if (response.status === 'success') {
                        button.prop('disabled', true);
                        button.addClass('btn-disabled').text('Added To Cart');


                        // Update cart count in header
                        $('.cart-count').text(response.cart_items);
                    }
                }
            });
        });


    });

    function changeImage(thumb) {
        let main = document.getElementById("mainPreview");

        // Store old main image src
        let oldMainSrc = main.src;

        // Swap: thumb → main
        main.src = thumb.src;

        // Swap: old main → thumb
        thumb.src = oldMainSrc;

        // Set active class
        document.querySelectorAll(".thumb").forEach(t => t.classList.remove("active"));
        thumb.classList.add("active");
    }
</script>
