<div class="container-fluid my-5 single-view">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="product-card p-4">
                <!-- Product Image -->
                <div class="text-center mb-4">
                    <img src="<?= base_url('assets/uploads/products/' . $product->img) ?>" alt="<?= $product->product_name ?>" class="product-img rounded">
                </div>

                <!-- Product Details -->
                <h2 class="fw-bold text-center mb-3"><?= $product->product_name ?></h2>
                <p class="text-muted text-center mb-4"><?= $product->description ?></p>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6><strong>Category:</strong> <?= $product->category_name ?></h6>
                    </div>
                    <div class="col-md-6">
                        <h6><strong>Price:</strong> ₹<?= number_format($product->price, 2) ?></h6>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6><strong>Quantity:</strong> <?= $product->quantity ?></h6>
                    </div>
                    <div class="col-md-6">
                        <h6><strong>Status:</strong> <?= $product->status ?></h6>
                    </div>
                </div>

                <!-- Status Section -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <?php if ($product->status == '0'): ?>
                            <span class="badge bg-success badge-status">Active</span>
                        <?php else: ?>
                            <span class="badge bg-danger badge-status">Inactive</span>
                        <?php endif; ?>

                        <?php if ($product->is_available == '0'): ?>
                            <span class="badge bg-success text-light badge-status">Available</span>
                        <?php else: ?>
                            <span class="badge bg-danger badge-status">Unavailable</span>
                        <?php endif; ?>
                    </div>

                    <a href="<?= base_url('admin/Product') ?>" class="btn btn-outline-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
