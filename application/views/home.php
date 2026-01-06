<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">100% Organic Foods</h4>
                <h1 class="mb-5 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
                <div class="position-relative mx-auto">
                    <form action="<?= base_url('shop') ?>" method="POST">
                        <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text" name="home_search" id="home-search" placeholder="Search">
                        <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                    </form>
                </div>
            </div>

            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">

                        <?php if (!empty($slider_category)): ?>
                            <?php $i = 0; ?>
                            <?php foreach ($slider_category as $slider_cat): ?>
                                <div class="carousel-item <?= ($i == 0) ? 'active' : '' ?> rounded">
                                    <img
                                        src="<?= base_url('assets/uploads/category/medium/' . $slider_cat->image) ?>"
                                        class="img-fluid w-100 h-100 bg-secondary rounded"
                                        alt="<?= htmlspecialchars($slider_cat->image_alt) ?>" style="width: 100%; height:330px !important;">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">
                                        <?= $slider_cat->name ?>
                                    </a>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Fallback slide -->
                            <div class="carousel-item active rounded">
                                <img src="<?= base_url('assets/img/hero-img-2.jpg') ?>"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Default slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">
                                    Vegetables
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Featurs Section Start -->
<div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Free Shipping</h5>
                        <p class="mb-0">Free on order over $300</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Security Payment</h5>
                        <p class="mb-0">100% security payment</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-exchange-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>30 Day Return</h5>
                        <p class="mb-0">30 day money guarantee</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>24/7 Support</h5>
                        <p class="mb-0">Support every time fast</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featurs Section End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our Organic Products</h1>
                </div>

                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item category">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" value="all" data-bs-toggle="pill" href="">
                                <span class="text-dark" style="width: 130px;">All Products</span>
                            </a>
                        </li>
                        <?php foreach ($category as $cat) { ?>
                            <li class="nav-item category">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" value="<?= $cat->name ?>" data-bs-toggle="pill" href="">
                                    <span class="text-dark" style="width: 130px;"><?= $cat->name ?></span>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>


            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4" id="show-product-by-category">
                                <?php
                                // if(empty($products)){
                                ?>
                                <!-- <div class="p-4 text-center text-light rounded" style="background-color:#81c408;">
                                            No Data Found
                                        </div> -->
                                <?php
                                //    }
                                ?>
                                <?php foreach ($products as $product) {
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

                                                <h4 class="product-title">
                                                    <a href="<?= base_url('category/' . $product->category_slug . '/product/' . $product->slug) ?>">
                                                        <?= $product->product_name ?>
                                                    </a>
                                                </h4>

                                                <p class="text-dark fs-5 fw-bold mb-0 text-start product-price">&#8377; <?= $product->price ?> <span> / <?= $product->short_name ?></span></p>
                                                <p class="text-start product-desc"><?= $desc ?></p>

                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart mt-0" data-id="<?= $product->id ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } ?>

                            </div>
                            <a href="<?= base_url('shop') ?>" class="mt-2 btn btn-primary text-light view-more-btn"> View More</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->


<!-- Featurs Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <a href="#">
                    <div class="service-item bg-secondary rounded border border-secondary">
                        <img src="<?= base_url('assets/img') ?>/featur-1.jpg" class="img-fluid rounded-top w-100" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-primary text-center p-4 rounded">
                                <h5 class="text-white">Fresh Apples</h5>
                                <h3 class="mb-0">20% OFF</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="#">
                    <div class="service-item bg-dark rounded border border-dark">
                        <img src="<?= base_url('assets/img') ?>/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-light text-center p-4 rounded">
                                <h5 class="text-primary">Tasty Fruits</h5>
                                <h3 class="mb-0">Free delivery</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="#">
                    <div class="service-item bg-primary rounded border border-primary">
                        <img src="<?= base_url('assets/img') ?>/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-secondary text-center p-4 rounded">
                                <h5 class="text-white">Exotic Vegitable</h5>
                                <h3 class="mb-0">Discount 30$</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Featurs End -->


<!-- Vesitable Shop Start-->
<div class="container-fluid vesitable py-5">
    <div class="container py-5">
        <h1 class="mb-0">Fresh Organic Vegetables</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">
            <?php foreach ($vegetables as $veg) {
                $desc = strip_tags($veg->description);
                $desc = mb_convert_case($desc, MB_CASE_TITLE, "UTF-8"); // Only makes each word Title Case
                $desc = mb_strtolower($desc, "UTF-8"); // Make all lowercase
                $desc = mb_strtoupper(mb_substr($desc, 0, 1, "UTF-8"), "UTF-8") . mb_substr($desc, 1, null, "UTF-8");
                $desc = mb_substr($desc, 0, 70) . "...";
            ?>

                <div class="border border-primary rounded position-relative vesitable-item ">
                    <div class="vesitable-img border-primary border-bottom ">
                        <img src="<?= base_url('assets/uploads/products/medium/' . $veg->image_name) ?>" class="img-fluid w-100 rounded-top" alt="<?= $veg->alt_text ?>">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?= $veg->category_name ?></div>
                    <div class="p-4 border  rounded-bottom product-content" style="height:245px; max-height:245px;">
                        <h4 class="product-title"><?= $veg->product_name ?></h4>
                        <p class="text-dark fs-5 fw-bold mb-0 text-start product-price">&#8377; <?= $veg->price ?> <span> / <?= $veg->short_name ?></span></p>
                        <p class="text-start product-desc"><?= $desc ?></p>

                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart mt-0" data-id="<?= $veg->id ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                    </div>
                </div>
            <?php }  ?>
        </div>
    </div>
</div>
<!-- Vesitable Shop End -->


<!-- Banner Section Start-->
<div class="container-fluid banner bg-secondary my-5">
    <div class="container py-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="py-4">
                    <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
                    <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                    <p class="mb-4 text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.</p>
                    <a href="#" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="<?= base_url('assets/img') ?>/baner-1.png" class="img-fluid w-100 rounded" alt="">
                    <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                        <h1 style="font-size: 100px;">1</h1>
                        <div class="d-flex flex-column">
                            <span class="h2 mb-0">50$</span>
                            <span class="h4 text-muted mb-0">kg</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Section End -->


<!-- Bestsaler Product Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h1 class="display-4">Bestseller Products</h1>
            <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
        </div>
        <div class="row g-4">
            <?php
            if (!empty($best_sales_product)) {
                foreach ($best_sales_product as $product) {
            ?>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="<?= base_url('assets/uploads/products/medium/' . $product->image) ?>" class="img-fluid rounded-circle w-100" alt="<?= $product->alt_text ?>">
                                </div>
                                <div class="col-6">
                                    <a href="#" class="h5"><?= $product->name ?></a>
                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3">&#8377; <?= number_format((float)$product->price, 2) ?></h4>
                                    <!-- <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart mt-0" data-id="<?= $product->id ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php  }
            }
            ?>



        </div>
    </div>
</div>
<!-- Bestsaler Product End -->
<div class="container-fluid vesitable py-5">
    <div class="container py-5">
        <h1 class="mb-0">Featured Products</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">
            <?php foreach ($featured as $featured) {
                $desc = strip_tags($featured->description);
                $desc = mb_convert_case($desc, MB_CASE_TITLE, "UTF-8"); // Only makes each word Title Case
                $desc = mb_strtolower($desc, "UTF-8"); // Make all lowercase
                $desc = mb_strtoupper(mb_substr($desc, 0, 1, "UTF-8"), "UTF-8") . mb_substr($desc, 1, null, "UTF-8");
                $desc = mb_substr($desc, 0, 70) . "...";
            ?>

                <div class="border border-primary rounded position-relative vesitable-item ">
                    <div class="vesitable-img border-primary border-bottom ">
                        <img src="<?= base_url('assets/uploads/products/medium/' . $featured->image_name) ?>" class="img-fluid w-100 rounded-top" alt="<?= $featured->alt_text ?>">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?= $featured->category_name ?></div>
                    <div class="p-4 border  rounded-bottom product-content" style="height:245px; max-height:245px;">
                        <h4 class="product-title"><?= $featured->product_name ?></h4>
                        <p class="text-dark fs-5 fw-bold mb-0 text-start product-price">&#8377; <?= $featured->price ?> <span> / <?= $featured->short_name ?></span></p>
                        <p class="text-start product-desc"><?= $desc ?></p>

                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart mt-0" data-id="<?= $featured->id ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                    </div>
                </div>
            <?php }  ?>
        </div>
    </div>
</div>
<!-- <div class="container-fluid my-5">
    <div class="container">
        <div class="text-center  mb-5" style="max-width: 700px;">
            <h1 class="mb-0"></h1>

            <div class="d-flex ">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="<?= base_url('assets/img') ?>/fruite-item-1.jpg" class="img-fluid rounded" alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="<?= base_url('assets/img') ?>/fruite-item-2.jpg" class="img-fluid rounded" alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="<?= base_url('assets/img') ?>/fruite-item-3.jpg" class="img-fluid rounded" alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="<?= base_url('assets/img') ?>/fruite-item-4.jpg" class="img-fluid rounded" alt="">
                        <div class="py-2">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Fact Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="bg-light p-5 rounded">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter bg-white rounded p-5">
                        <i class="fa fa-users text-secondary"></i>
                        <h4>satisfied customers</h4>
                        <h1>1963</h1>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter bg-white rounded p-5">
                        <i class="fa fa-users text-secondary"></i>
                        <h4>quality of service</h4>
                        <h1>99%</h1>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter bg-white rounded p-5">
                        <i class="fa fa-users text-secondary"></i>
                        <h4>quality certificates</h4>
                        <h1>33</h1>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter bg-white rounded p-5">
                        <i class="fa fa-users text-secondary"></i>
                        <h4>Available Products</h4>
                        <h1><?= $total_product ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fact Start -->

<script>
    document.addEventListener('DOMContentLoaded', function() {


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

        let currentCategory = "all";

        $(document).on('click', '.category a', function(e) {
            e.preventDefault();
            let category_name = $(this).attr('value');
            // console.log(category_name)
            // return;

            let url = " <?= base_url('home') ?>";
            loadProducts(url, category_name);
        });

        function loadProducts(url, category_name) {
            // console.log(category_name)
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    category_name: category_name,
                },
                dataType: "JSON",
                success: function(response) {
                    // console.log(response.html)
                    $("#show-product-by-category").html(response.html);
                    // $("#pagination-container").html(response.pagination);
                }
            });
        }
    }); // main
</script>
