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
                <tbody>
                    <?php if (!empty($product)) {
                        foreach ($product as $key => $item) {
                    ?>
                            <tr id="product-<?= $item->product_id ?>" class="product" data-id="<?= $item->product_id ?>">
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url('assets/uploads/products/thumb/' . $item->image_name) ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="<?= $item->alt_text ?>">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4"><?= $item->product_name ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="price-<?= $item->product_id ?>" data-price="<?= $item->price ?>">&#8377;<?= $item->price ?>/<?= $item->short_name ?></p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;" data-id="<?= $item->product_id ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border qty-btn" id="decrease">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 qty-input" id="quantity-input" value="<?= $item->qty ?>" data-id="<?= $item->product_id ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border qty-btn" id="increase">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php $total = $item->qty * $item->price  ?>
                                    <p class="mb-0 mt-4 total">&#8377;<?= $total ?></p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 remove-btn" data-id="<?= $item->product_id ?>">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>

                                </td>

                            </tr>
                        <?php  } ?>
                    <?php  } else { ?>
                        <tr class="text-center fw-bold w-100">
                            <td class="py-4" colspan="6">Your Cart Is Empty </td>
                        </tr>
                    <?php  } ?>


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
        <?php
        $discount = $this->session->userdata('discount');
        $coupon_code = $this->session->userdata('coupon_code');
        $grand_total = $this->session->userdata('grand_total');
        if (!empty($product)) { ?>

            <div class="mt-5" style="height: 100px;">
                <form action="<?= base_url('Cart/apply_coupon') ?>" method="post" id="coupon-form">
                    <input type="text" name="code" id="coupon_code" class="border-0 border-bottom rounded me-5 py-3 mb-4" value="<?= set_value('code', $coupon_code) ?>" placeholder="Coupon Code">
                    <input type="hidden" name="total" id="coupon-total" value="<?= $subtotal ?>">
                    <input type="submit" id="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary" value="Apply Coupon">
                </form>
                <div id="response-msg" class="mt-0"></div>
            </div>


            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="subtotal">&#8377;<?= $subtotal ?></p>
                            </div>
                            <!-- <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Flat rate: $3.00</p>
                                </div>
                            </div> -->
                            <!-- <p class="mb-0 text-end">Shipping to Ukraine.</p> -->
                            <div id="discount_section">
                                <?php if (!empty($discount)) : ?>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0 me-4">Discount : </h5>
                                        <div class="">
                                            <p class="mb-0">Flat rate: &#8377;<span id="discount"><?= number_format($discount, 2) ?></span></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4" id="grand_total">₹<?= isset($grand_total) ? number_format($grand_total, 2) : number_format($subtotal, 2) ?></p>
                        </div>
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button" data-bs-toggle="modal" data-bs-target="#proceedCheckout">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        <?php  }
        ?>
    </div>
</div>
<!-- Cart Page End -->
<!-- proceed to checkout modal  -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="proceedCheckout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 200px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <a href="<?= base_url('Checkout/index') ?>" role="button" class="btn btn-secondary text-light">Guest</a>
                <a href="<?= base_url('Auth/login') ?>" type="button" class="btn btn-primary text-light float-end">Login</a>
            </div>
            <!-- <div class="modal-footer">
               
            </div> -->
        </div>
    </div>
</div>

<script>
    // calculate sub total
    // function calculateSubtotal() {
    //     let subtotal = 0;

    //     $("p[id^='total-']").each(function() {
    //         let amount = parseInt($(this).text().replace("₹", ""));
    //         subtotal += amount;
    //     });

    //     $("#subtotal").text("₹" + subtotal);
    //     $("#coupon-total").val(subtotal);
    //     $("#grand_total").html(subtotal);
    // }
    // Coupons(function(response) {

    //     if (response.status === "success") {

    //         $("#submit")
    //             .val("Applied")
    //             .addClass("btn-secondary")
    //             .prop("disabled", true);

    //         $("#response-msg")
    //             .text("Success!")
    //             .css({
    //                 "color": "green",
    //                 "font-weight": "bold"
    //             })
    //             .fadeIn();

    //         setTimeout(() => {
    //             $("#response-msg").fadeOut();
    //         }, 4000);

    //     } else if (response.status === "error") {

    //         $("#response-msg")
    //             .text(response.message)
    //             .css({
    //                 "color": "red",
    //                 "font-weight": "bold"
    //             })
    //             .fadeIn();

    //         setTimeout(() => {
    //             $("#response-msg").fadeOut();
    //         }, 4000);

    //     }
    // });


    document.addEventListener('DOMContentLoaded', function() {


        $('#coupon-form').on('submit', function(e) {
            e.preventDefault();
            console.log("called");

        });

        lastApplied = $("#coupon_code").val();
        $(document).on('input', '#coupon_code', function(e) {
            // console.log(lastApplied)
            if ($(this).val() !== lastApplied) {
                $("#submit")
                    .val("Apply Coupon")
                    .removeClass("btn-secondary btn-primary")
                    .prop("disabled", false);
                calculateSubtotal();
            }

            if ($(this).val() === lastApplied) {
                $("#submit")
                    .val("Applied")
                    .addClass("btn-secondary")
                    .prop("disabled", true);
                calculateSubtotal();
            }
        });

        // quantity incease decrease 
        $(document).on("click", '.qty-btn', function(e) {
            e.preventDefault();

            const elem = e.target; // DOM element
            const product_div = elem.closest('.product'); // Pure JS .closest()
            const quantityElem = product_div.querySelector('.qty-input');
            const quantity = quantityElem.value;
            const data = product_div.dataset;
            let payload = {
                product_id: data.id,
                quantity: quantity,
                update_mode: "update"
            }


            // let wrapper = $(this).closest(".quantity");
            // let input = wrapper.find(".qty-input");

            // let qty = parseInt(input.val(),2);
            // let product_id = input.data('id');

            // let price = parseFloat($("#price-" + product_id).data("price"));

            // if ($(this).hasClass("btn-plus")) {
            //     qty++;
            // } else if ($(this).hasClass("btn-minus") && qty > 1) {
            //     qty--;
            // }

            // let total = price * qty;
            // $("#total-" + product_id).text("₹" + total);


            // input.val(qty);
            // Coupons();

            $.ajax({
                url: "<?= base_url('Cart/add_to_cart') ?>",
                type: "POST",
                dataType: 'JSON',
                data: {
                    ...payload
                },
                success: function(res) {
                    set_page(res, product_div);
                    // calculateSubtotal();

                    console.log("Updated", res);
                }
            });
        });
        // code by atanu 
        function set_page(response) {
            const product_cont = document.querySelector('tbody')
            if (response.status == 'success') {
            lastApplied = response.coupon.code;
                data=response;
                $('#subtotal').text(data.subtotal);
                $('#grand_total').text(data.total);
                if (data.coupon_applied) {
                    $('#discount').text(data.discount);
                    $('#submit').val('Applied').prop('disabled', true);
                } else {
                    $('#discount').text('0');
                    $('#submit').val('Apply Coupon').prop('disabled', false);
                }
                var table_html = '';
                data.products.forEach(function(product, index) {
                table_html +=    `<tr id="product-17" class="product" data-id="${product.id}">
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="http://localhost/ayan_app/assets/uploads/products/thumb/product_69259cbb1325a.jpg" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="Ut consequat Tempor">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">${product.name}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="price-17" data-price="678.00">${product.price}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;" data-id="17">
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
                                </td>
                                <td>
                                                                        <p class="mb-0 mt-4 total">${product.subtotal}</p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 remove-btn" data-id="17">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>

                                </td>

                            </tr>`;
                });

                $(product_cont).html(table_html);
            }
        }
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

        function Coupons(callback) {
            total = $("#coupon-total").val();
            code = $("#coupon_code").val();
            $.ajax({
                url: "<?= base_url('Cart/apply_coupon') ?>",
                type: "POST",
                data: {
                    total: total,
                    code: code
                },
                dataType: "JSON",
                success: function(response) {
                    console.log(response)

                    if (response.status === 'success') {
                        $("#discount_section").html(`
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Discount :</h5>
                                <div>
                                    <p class="mb-0">₹${parseFloat(response.discount).toFixed(2)}</p>
                                </div>
                            </div>
                        `);
                        $("#grand_total").text("₹" + parseFloat(response.grand_total).toFixed(2));
                        // $("#coupon_code").prop("readonly", true);
                        $("#submit").html("Applied").addClass("btn-secondery").removeClass("btn-primary");

                    } else if (response.status === 'error') {
                        console.log('error')
                    }
                    callback(response);
                }
            })
        }
    });
</script>