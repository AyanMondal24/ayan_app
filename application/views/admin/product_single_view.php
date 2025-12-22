<div class="container-fluid my-5 single-view">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="product-card ">
                <!-- Product Image -->
                <!-- Left Thumbnail Images -->

                <div class="product-container d-flex align-items-center justify-content-center p-4">


                    <!-- ONE SINGLE THUMB COLUMN -->
                    <div class="thumb-column">
                        <?php foreach ($images as $img): ?>
                            <?php if (!empty($img['is_featured']) && ($img['is_featured'] == '1')): ?>
                                <img src="<?= base_url('assets/uploads/products/medium/' . $img['image_name']) ?>"
                                    class="thumb"
                                    onclick="changeImage(this)"
                                    alt="<?= $img['alt_text'] ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- MAIN IMAGE -->
                    <div class="main-image">

                        <?php if (isset($featured_images->is_featured) && $featured_images->is_featured === '0'): ?>
                            <img id="mainPreview"
                                src="<?= base_url('assets/uploads/products/medium/' . $featured_images->image_name) ?>"
                                alt="<?= $featured_images->alt_text ?>">
                        <?php endif; ?>

                    </div>


                </div>


                <!-- Product Details -->
                <div class="single-view-details rounded p-3">
                    <h2 class="fw-bold mt-4 mb-3"><?= $product->product_name ?> <sup>(<?= $product->category_name ?>)</sup></h2>

                    <h5><strong>Price:</strong> ₹<?= number_format($product->price, 2) . " / " . $product->short_name ?></h5>

                    <p class="text-muted description-box mb-4 "><?= $product->description ?></p>


                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6><strong>Quantity:</strong> <?= $product->quantity ?></h6>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Created On:</strong> <?= date('d M Y, h:i A', strtotime($product->created_at)) ?></h6>
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <?php if ($product->status == '0'): ?>
                                <span class="badge bg-success badge-status ">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger badge-status badge-md">Inactive</span>
                            <?php endif; ?>

                            <?php if ($product->is_available == '0'): ?>
                                <span class="badge bg-success text-light badge-status">Available</span>
                            <?php else: ?>
                                <span class="badge bg-danger badge-status badge-md">Unavailable</span>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
            <a href="<?= base_url('admin/Product') ?>" class="btn btn-outline-primary float-end mt-4">Back to List</a>
        </div>
    </div>
</div>

<script>
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