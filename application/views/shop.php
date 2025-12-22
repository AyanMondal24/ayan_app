<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop</h1>
</div>
<!-- Single Page Header End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Fresh fruits shop</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" name="search" id="search-box" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1" value="<?= (isset($search) ? $search : '') ?>">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <!-- <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Default Sorting:</label>
                            <select id="sort_by" class="border-0 form-select-sm bg-light me-3">
                                <option value="">Nothing</option>
                                <option value="popularity">Popularity</option>
                                <option value="organic">Organic</option>
                                <option value="fantastic">Fantastic</option>
                            </select>

                        </div>
                    </div> -->
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie" id="categories">
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name" id="categories">
                                                <a href="#" data-category_name="all" class="active-category">All</a>
                                                <span>(<?= $total_product ?>)</span>
                                            </div>
                                        </li>
                                        <?php
                                        foreach ($category as $cat) {
                                        ?>
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="#" data-category_name="<?= $cat->name ?>"><?= $cat->name ?></a>
                                                    <span>(<?= $cat->total_products ?>)</span>
                                                </div>
                                            </li>
                                        <?php   }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="mb-2">Price</h4>
                                    <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="2000" value="0" oninput="amount.value=rangeInput.value">
                                    &#8377;<output id="amount" name="amount" min-velue="0" max-value="2000" for="rangeInput">0</output>
                                </div>
                            </div>
                            <!-- <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Additional</h4>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="Beverages">
                                        <label for="Categories-1"> Organic</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-2" name="Categories-1" value="Beverages">
                                        <label for="Categories-2"> Fresh</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-3" name="Categories-1" value="Beverages">
                                        <label for="Categories-3"> Sales</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-4" name="Categories-1" value="Beverages">
                                        <label for="Categories-4"> Discount</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-5" name="Categories-1" value="Beverages">
                                        <label for="Categories-5"> Expired</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="mb-3">Featured products</h4>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="<?= base_url('assets/') ?>img/featur-1.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Big Banana</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="<?= base_url('assets/') ?>img/featur-2.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Big Banana</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="<?= base_url('assets/') ?>img/featur-3.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Big Banana</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center my-4">
                                    <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                                </div>
                            </div> -->
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="<?= base_url('assets/') ?>img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                    <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center" id="show-shop-product">
                            <?php foreach ($products as $product) {
                                $desc = strip_tags($product->description);
                                $desc = mb_convert_case($desc, MB_CASE_TITLE, "UTF-8"); // Only makes each word Title Case
                                $desc = mb_strtolower($desc, "UTF-8"); // Make all lowercase
                                $desc = mb_strtoupper(mb_substr($desc, 0, 1, "UTF-8"), "UTF-8") . mb_substr($desc, 1, null, "UTF-8");
                                $desc = mb_substr($desc, 0, 70) . "...";
                            ?>
                                <div class="col-md-6 col-lg-6 col-xl-4 product-shop">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img border border-bottom border-secondary" style="border-bottom: 1px;">
                                            <img src="<?= base_url('assets/uploads/products/medium/' . $product->image_name) ?>" class="img-fluid w-100 rounded-top" alt="<?= $product->alt_text ?>">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $product->category_name ?></div>
                                        <div class="p-4 border border-secondary rounded-bottom product-content" style="height:245px; max-height:245px;">
                                            <h4 class="product-title"><?= $product->product_name ?></h4>
                                            <p class="text-dark fs-5 fw-bold mb-0 text-start product-price">&#8377; <?= $product->price ?> <span> / <?= $product->short_name ?></span></p>
                                            <p class="text-start product-desc"><?= $desc ?></p>

                                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart mt-0" data-id="<?= $product->product_id ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?= base_url('assets/') ?>img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Grapes</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?= base_url('assets/') ?>img/fruite-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Raspberries</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?= base_url('assets/') ?>img/fruite-item-4.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Apricots</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?= base_url('assets/') ?>img/fruite-item-3.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Banana</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?= base_url('assets/') ?>img/fruite-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Oranges</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?= base_url('assets/') ?>img/fruite-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Raspberries</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?= base_url('assets/') ?>img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Grapes</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?= base_url('assets/') ?>img/fruite-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Oranges</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                        <div class="col-12">
                            <div class="pagination d-flex justify-content-center mt-5" id="pagination-container">
                                <?= $pagination ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let category_name = 'all';

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
        // pagination 
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let page_number = $(this).attr('data-ci-pagination-page');
            let per_page = 9;
            let offset = (page_number - 1) * per_page;

            let category_name = $("#current_category").val();
            let search = $("#search-box").val();
            let price = $("#rangeInput").val();
            loadTable(url, offset, category_name, search, price)
        });

        // fetch data based on category 
        $('#categories a').on('click', function(e) {
            e.preventDefault();
            $('#categories a').removeClass('active-category');
            $(this).addClass('active-category');

            let category_name = $(this).data('category_name');
            let url = "<?= base_url('Shop/index') ?>";
            let search = $("#search-box").val();
            let price = $("#rangeInput").val();

            loadTable(url, 0, category_name, search, price);
        });
        // $(document).on('keyup', '#search-box', function() {
        //     let search = $(this).val()
        //     let url = "<?= base_url('Shop/index') ?>";
        //     let current_category = $("#current_category").val();
        //     let price = $("#rangeInput").val();
        //     // console.log(current_category)

        //     // console.log(category_name)
        //     loadTable(url, 0, current_category, search, price)
        // });

        const searchDebounced = debounce(function() {

            let search = $('#search-box').val();
            let url = "<?= base_url('Shop/index') ?>";
            let current_category = $("#current_category").val();
            let price = $("#rangeInput").val();

            loadTable(url, 0, current_category, search, price);

        }, 300);
        $('#search-box').on('keyup', function() {
            searchDebounced();
        });
        let search = $('#search-box').val();
        if (search && search.length > 0) {
            searchDebounced();
        }

        $('#rangeInput').on('input', function() {
            let price = $(this).val();
            $("#amount").text(price);
            let url = "<?= base_url('Shop/index') ?>";
            let current_category = $("#current_category").val();
            let search = $("#search-box").val();

            loadTable(url, 0, current_category, search, price)
            // console.log(price)
        });

        function loadTable(url, offset, category_name, search, price) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    category_name: category_name,
                    offset: offset,
                    search: search,
                    price: price,
                },
                dataType: "JSON",
                success: function(response) {
                    // console.log(response.html)
                    $("#show-shop-product").html(response.html);
                    $("#pagination-container").html(response.pagination);
                }
            })
        }

    });
</script>