<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Single View - POCO C71</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            display: flex;
            gap: 30px;
        }

        
     
        .details {
            width: 30%;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .details h1 {
            margin-top: 0;
            font-size: 28px;
        }

        .price {
            font-size: 24px;
            color: #e60023;
            margin: 10px 0;
        }

        .btn {
            background: #008cff;
            color: #fff;
            padding: 12px 20px;
            display: inline-block;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 15px;
            font-size: 16px;
        }

        .btn:hover {
            background: #006acc;
        }
    </style>
</head>

<body>

    <div class="container">


      
        <div class="details">
            <h1>POCO C71</h1>
            <p class="price">₹7,499</p>

            <h3>Key Features</h3>
            <ul>
                <li>120Hz Large Display</li>
                <li>Premium Split Grid Design</li>
                <li>5200mAh Battery</li>
                <li>15W Fast Charger Included</li>
            </ul>

            <button class="btn">Add to Cart</button>
            <button class="btn" style="background:#e60023; margin-left: 10px;">Buy Now</button>
        </div>

    </div>

</body>

</html> -->



<div class="container-fluid my-5 single-view">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="product-card p-4">
                <!-- Product Image -->
                <!-- Left Thumbnail Images -->
              
                <div class="product-container d-flex align-items-center justify-content-center">

                    <!-- ONE SINGLE THUMB COLUMN -->
                    <div class="thumb-column">
                        <?php foreach ($images as $img): ?>
                            <?php if (!empty($img['image_type']) && ($img['image_type'] == 'gallery' || $img['image_type'] == 'main')): ?>
                                <img src="<?= base_url('assets/uploads/products/' . $img['image_name']) ?>"
                                    class="thumb"
                                    onclick="changeImage(this)"
                                    alt="<?= $img['alt_text'] ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- MAIN IMAGE -->
                    <div class="main-image">
                        <?php foreach ($images as $img): ?>
                            <?php if (!empty($img['image_type']) && $img['image_type'] == 'main'): ?>
                                <img id="mainPreview"
                                    src="<?= base_url('assets/uploads/products/' . $img['image_name']) ?>"
                                    alt="<?= $img['alt_text'] ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                </div>


                <!-- Product Details -->
                <h2 class="fw-bold text-center mb-3"><?= $product->product_name ?></h2>
                <p class="text-muted text-center mb-4"><?= $product->description ?></p>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6><strong>Category:</strong> <?= $product->category_name ?></h6>
                    </div>
                    <div class="col-md-6">
                        <h6><strong>Price:</strong> ₹<?= number_format($product->price, 2) . " / " . $product->short_name ?></h6>
                    </div>
                </div>

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

<script>
    function changeImage(thumb) {
        // Change main image
        document.getElementById("mainPreview").src = thumb.src;

        // Remove active from all
        let all = document.querySelectorAll(".thumb");
        all.forEach(t => t.classList.remove("active"));

        // Add active
        thumb.classList.add("active");
    }
</script>