<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>

</div>
<!-- Single Page Header End -->

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Images</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody id="cart-body">
                    <?php if (!empty($product)) { ?>
                        <?php foreach ($product as $item) { ?>

                            <tr id="product-<?= $item->product_id ?>" class="product" data-id="<?= $item->product_id ?>">
                                <th scope="row">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="<?= base_url('assets/uploads/products/thumb/' . $item->image_name) ?>"
                                            class="img-fluid rounded-circle"
                                            style="width: 80px; height: 80px;"
                                            alt="<?= $item->alt_text ?>">
                                    </div>
                                </th>

                                <td>
                                    <div class="d-flex justify-content-center align-items-center h-100">
                                        <p class="mb-0 mt-4"><?= $item->product_name ?></p>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center align-items-center h-100">
                                        <p class="mb-0 mt-4"
                                            id="price-<?= $item->product_id ?>"
                                            data-price="<?= $item->price ?>">
                                            &#8377;<?= $item->price ?> / <?= $item->short_name ?>
                                        </p>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center align-items-center h-100">
                                        <div class="input-group quantity mt-4"
                                            style="width: 100px;"
                                            data-id="<?= $item->product_id ?>">

                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border qty-btn">
                                                <i class="fa fa-minus"></i>
                                            </button>

                                            <input type="text"
                                                class="form-control form-control-sm text-center border-0 qty-input"
                                                value="<?= $item->qty ?>"
                                                data-id="<?= $item->product_id ?>">

                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border qty-btn">
                                                <i class="fa fa-plus"></i>
                                            </button>

                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center align-items-center h-100">
                                        <p class="mb-0 mt-4 total">
                                            &#8377;<?= number_format($item->qty * $item->price, 2) ?>
                                        </p>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center align-items-center h-100">
                                        <button class="btn btn-md mt-4 rounded-circle bg-light border remove-btn"
                                            data-id="<?= $item->product_id ?>">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?>
                    <?php } else { ?>
                        <tr class="text-center fw-bold w-100">
                            <td class="py-4" colspan="6">Your Cart Is Empty</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
        $subtotal = 0;
        if (!empty($product)) {
            foreach ($product as $item) {
                $subtotal += $item->qty * $item->price;
            }
        }
        ?>
        <?php $applied_coupon = $this->session->userdata('applied_coupon');

        $code = $discount_type = $discount_value = $discount = "";
        $current_coupon_code = "";
        if (!empty($applied_coupon['coupon_id'])) {
            $is_applied = true;

            if ($coupon) {
                $current_coupon_code = $coupon->code;
                $code = $coupon->code;
                $discount_type = $coupon->discount_type;  // percentage/fixed
                $discount_value = $coupon->discount_value;

                // Recalculate discount for safety
                if ($discount_type === 'percentage') {
                    $discount = ($subtotal * $discount_value) / 100;
                } else {
                    $discount = $discount_value;
                }

                if ($discount > $subtotal) {
                    $discount = $subtotal;
                }

                $grand_total = $subtotal - $discount;
            }
        }
        ?>
        <?php
        if (!empty($product)) { ?>

            <div class="mt-5" style="height: 100px;" id="coupon-form">
                <form action="<?= base_url('Cart/apply_coupon') ?>" method="post" id="coupon-form">
                    <input type="text" name="code" id="coupon_code" class="border-0 border-bottom rounded me-5 py-3 mb-4" value="<?= $code  ?>" placeholder="Coupon Code">
                    <?php
                    $applied_coupon = $this->session->userdata('applied_coupon');

                    if (!empty($applied_coupon)) { ?>
                        <input type="submit" id="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary" value="<?= $is_applied ? 'Applied' : 'Apply Coupon' ?>">
                    <?php } else { ?>
                        <input type="submit" id="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary" value="Apply Coupon">

                    <?php  }

                    ?>

                </form>
                <div id="response-msg" class="mt-0"></div>
            </div>

            <div class="row g-4 justify-content-end" id="cart-total-div">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="subtotal">&#8377;<?= number_format((float)$subtotal, 2)  ?></p>
                            </div>
                            <div id="discount_section" style="<?= !empty($applied_coupon) ? '' : 'display:none' ?>">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Discount :</h5>
                                    <div id="show-discount-div">
                                        <p class="mb-0">
                                            <?php if (!empty($applied_coupon) && $discount_type === 'percentage') { ?>
                                                <span id="discount-type">(<?= $discount_value ?>%) Off :</span>
                                                ₹<span id="discount"><?= number_format($discount, 2) ?></span>
                                            <?php } elseif (!empty($applied_coupon) && $discount_type === 'fixed') { ?>
                                                <span id="discount-type">Flat ₹<?= $discount_value ?> Off :</span>
                                                ₹<span id="discount"><?= number_format($discount, 2) ?></span>
                                            <?php } else { ?>
                                                <span id="discount-type"></span> <span id="discount"></span>
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4" id="grand_total">₹<?= isset($grand_total) ? number_format($grand_total, 2) : number_format($subtotal, 2) ?></p>



                        </div>
                        <?php
                        $user_id = $this->session->userdata('user_id');
                        if (!empty($user_id)) { ?>
                            <a href="<?= base_url('checkout') ?>" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" role="button">Proceed Checkout</a>
                        <?php   } else {
                        ?>
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button" data-bs-toggle="modal" data-bs-target="#proceedCheckout">Proceed Checkout</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php  }
        ?>
    </div>
</div>
<!-- Cart Page End -->
<!-- proceed to checkout modal  -->

<!-- Modal -->
<div class="modal fade" id="proceedCheckout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 200px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <a href="<?= base_url('checkout') ?>" role="button" class="btn btn-secondary text-light">Guest</a>
                <a href="<?= base_url('login?redirect=checkout') ?>" type="button" class="btn btn-primary text-light float-end">Login</a>
            </div>
            <!-- <div class="modal-footer">

            </div> -->
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // quantity incease decrease
        $(document).on("click", '.qty-btn', function(e) {
            e.preventDefault();

            const elem = e.target; // DOM element
            const product_div = elem.closest('.product');
            const quantityElem = product_div.querySelector('.qty-input');
            let quantity = quantityElem.value;
            const data = product_div.dataset;

            if ($(this).hasClass("btn-plus")) {
                quantity++;
            } else if ($(this).hasClass("btn-minus") && quantity > 1) {
                quantity--;
            }

            let payload = {
                product_id: data.id,
                quantity: quantity,
                update_mode: "update"
            }

            quantityElem.value = quantity;

            $.ajax({
                url: "<?= base_url('Cart/add_to_cart') ?>",
                type: "POST",
                dataType: 'JSON',
                data: {
                    ...payload
                },
                success: function(response) {
                    set_page(response);
                }
            });
        });

        // remove from cart
        $(document).on('click', '.remove-btn', function(e) {

            let product_id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('Cart/remove_item') ?>",
                type: "POST",
                data: {
                    product_id: product_id
                },
                dataType: "JSON",
                success: function(response) {
                    set_page(response)
                }
            });
        });

        lastApplied = "<?= $current_coupon_code ?>";
        // coupons
        $('#coupon-form').on('submit', function(e) {
            e.preventDefault();
            const code = document.getElementById('coupon_code').value;
            $.ajax({
                url: "<?= base_url('Cart/apply_coupon') ?>",
                type: "POST",
                data: {
                    code: code
                },
                dataType: "JSON",
                success: function(response) {
                    document.getElementById('discount_section').style.display = 'block';
                    set_page(response)

                    if (response.coupon_applied === true) {

                        lastApplied = code;
                        $('#submit').val('Applied').prop('disabled', true);

                    } else {

                        lastApplied = "";
                        $('#submit').val('Apply Coupon').prop('disabled', false);

                    }
                }
            });
        });

        const couponInput = document.getElementById('coupon_code');
        if (couponInput) {

            couponInput.addEventListener("input", function() {

                if (this.value === lastApplied && lastApplied !== "") {
                    $('#submit').val("Applied").prop("disabled", true);
                } else {
                    $('#submit').val("Apply Coupon").prop("disabled", false);
                }
            });
        }

    });

    function set_page(response) {
        const product_cont = document.getElementById('cart-body');
        if (response.cart_items == 0) {
            $("#cart-count, .cart-count").text(response.cart_items);
            $("#cart-body").html(`<tr class="text-center fw-bold w-100">
                            <td class="py-4" colspan="6">Your Cart Is Empty </td>
                         </tr>`);
            $("#coupon-form").hide();
            $("#cart-total-div").hide();
            return;
        }
        if (response.status == 'success') {

            lastApplied = response?.coupon?.code ?? "";

            const type = response?.coupon?.type ?? null;
            const discount_value = response?.coupon?.discount_value ?? null;


            if (type === 'percentage') {
                document.getElementById('discount-type').innerHTML = `(${discount_value})% Off : `;
            } else if (type === 'fixed') {
                document.getElementById('discount-type').innerHTML = `Flat (${discount_value}) Off : `;
            } else {
                document.getElementById('discount-type').innerHTML = ""; // no coupon applied
            }

            data = response;
            $("#subtotal").text("₹" + parseFloat(response.subtotal).toLocaleString('en-IN', {
                minimumFractionDigits: 2
            }));
            $("#grand_total").text("₹" + parseFloat(response.total).toLocaleString('en-IN', {
                minimumFractionDigits: 2
            }));


            // $('#cart-count').text(data.cart_items);
            // Update header cart count everywhere
            $("#cart-count, .cart-count").text(data.cart_items);


            // console.log(data.coupon_applied)
            if (data.coupon_applied) {
                $("#discount").text(parseFloat(response.discount).toLocaleString('en-IN', {
                    minimumFractionDigits: 2
                }));
                $('#submit').val('Applied').prop('disabled', true);
            } else {
                $("#discount").text("0.00");
                $("#discount-type").text("");
                $('#submit').val('Apply Coupon').prop('disabled', false);
            }

            var table_html = '';
            data.products.forEach(function(product, index) {
                table_html += `<tr id="product-${product.product_id}" class="product" data-id="${product.product_id}">
                                <th scope="row">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="<?= base_url('assets/uploads/products/thumb/') ?>${product.image}" class="img-fluid rounded-circle" style="width: 80px; height: 80px;" alt="${product.alt_text}">
                                    </div>
                                </th>
                                <td>
                                  <div class="d-flex justify-content-center align-items-center h-100">
                                    <p class="mb-0 mt-4">${product.name}</p>
                                    </div>
                                </td>
                                <td>
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <p class="mb-0 mt-4" id="price-${product.price}" data-price="${product.price}">₹${product.price}/${product.unit}</p>
                                    </div>
                                </td>
                                <td>
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <div class="input-group quantity mt-4" style="width: 100px;" data-id="${product.product_id}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border qty-btn" id="decrease">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 qty-input" id="quantity-input" value="${product.quantity}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border qty-btn" id="increase">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                   </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center align-items-center h-100">
                                        <p class="mb-0 mt-4 total">₹${parseFloat(product.subtotal).toLocaleString('en-IN', { minimumFractionDigits: 2 })}
                                        </p>
                                    </div>
                                </td>
                                <td>
                                 <div class="d-flex justify-content-center align-items-center h-100">
                                    <button class="btn btn-md mt-4 rounded-circle bg-light border remove-btn" data-id="${product.product_id}">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </div>
                                </td>

                            </tr>`;
            });

            $(product_cont).html(table_html);
        } else if (response.status === 'error') {
            // cart empty
            $("#coupon_code").val('');
            $("#subtotal").text('0.00');
            $("#grand_total").text('0.00');
            $("#discount").text("0.00");
            // $('#cart-count').text(response.cart_items);
            $("#cart-count, .cart-count").text(response.cart_items);


            $("#discount-type").text("");
            $("#cart-body").html(`<tr class="text-center fw-bold w-100">
                            <td class="py-4" colspan="6">Your Cart Is Empty </td>
                         </tr>`);
            // console.log("Cart inside else " + response.message)
        } else if (response.status === 'couponError') {
            $("#subtotal").text("₹" + parseFloat(response.subtotal).toLocaleString('en-IN', {
                minimumFractionDigits: 2
            }));
            $("#grand_total").text("₹" + parseFloat(response.total).toLocaleString('en-IN', {
                minimumFractionDigits: 2
            }));
            $("#discount").text(parseFloat(response.discount).toLocaleString('en-IN', {
                minimumFractionDigits: 2
            }));
            $("#discount-type").text("");
            $("#response-msg").addClass('error-msg').html(response.message).fadeIn(200).delay(2000).fadeOut(200)

        } else {
            table_html = `
                         <tr class="text-center fw-bold w-100">
                            <td class="py-4" colspan="6">Your Cart Is Empty </td>
                         </tr>
            `;
            $(product_cont).html(table_html);

        }
    }
</script>
