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
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cart)) {
                        foreach ($cart as $key => $item) {
                    ?>
                            <tr id="row-<?= $item['product_id'] ?>">
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url('assets/uploads/products/thumb/' . $item['image']) ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="<?= $item['alt_text'] ?>">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4"><?= $item['name'] ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="price-<?= $item['product_id'] ?>" data-price="<?= $item['price'] ?>">&#8377;<?= $item['price'] ?>/<?= $item['unit'] ?></p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;" data-id="<?= $item['product_id'] ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border qty-btn" id="decrease">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 qty-input" id="quantity-input" value="<?= $item['qty'] ?>" data-id="<?= $item['product_id'] ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border qty-btn" id="increase">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php $total = $item['qty'] * $item['price']  ?>
                                    <p class="mb-0 mt-4 " id="total-<?= $item['product_id'] ?>">&#8377;<?= $total ?></p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 remove-btn" data-id="<?= $item['product_id'] ?>">
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
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $subtotal += $item['qty'] * $item['price'];
            }
        }
        ?>
        <?php
        $discount = $this->session->userdata('discount');
        $coupon_code = $this->session->userdata('coupon_code');
        $grand_total = $this->session->userdata('grand_total');
        if (!empty($cart)) { ?>

            <div class="mt-5">
                <form action="<?= base_url('Cart/apply_coupon') ?>" method="post" id="coupon-form">
                    <input type="text" name="code" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                    <input type="hidden" name="total" id="coupon-total" value="<?= $subtotal ?>">
                    <input type="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary" value="Apply Coupon">
                </form>
                <div id="response-msg"></div>
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
                                            <p class="mb-0">Flat rate: &#8377;<?= number_format($discount, 2) ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4" id="grand_total">₹<?= !empty($grand_total) ? number_format($grand_total, 2) : number_format($subtotal, 2) ?></p>
                        </div>
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        <?php  }
        ?>
    </div>
</div>
<!-- Cart Page End -->


<script>
    function calculateSubtotal() {
        let subtotal = 0;

        $("p[id^='total-']").each(function() {
            let amount = parseInt($(this).text().replace("₹", ""));
            subtotal += amount;
        });

        $("#subtotal").text("₹" + subtotal);
        $("#coupon-total").val(subtotal);
        $("#grand_total").html(subtotal);
    }
    document.addEventListener('DOMContentLoaded', function() {

        $(document).on('submit', '#coupon-form', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
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
                        $("#response-msg")
                            .text("Success!") // show message
                            .css({
                                "color": "green", // change text color
                                "font-weight": "bold", // any css you want
                                "background": "none" // ensure NO background color
                            }).fadeIn();

                        setTimeout(() => {
                            $("#response-msg")
                                .text("").fadeOut();
                        }, 4000);
                    } else if (response.status === 'error') {
                        console.log('error')
                        $("#response-msg")
                            .html(response.message) // show message
                            .css({
                                "color": "red", // change text color
                                "font-weight": "bold", // any css you want
                                "background": "none" // ensure NO background color
                            }).fadeIn();
                        setTimeout(() => {
                            $("#response-msg")
                                .text("").fadeOut();
                        }, 4000);
                    }
                }
            })
        })
        // quantity incease decrease 
        $(document).on("click", ".qty-btn", function(e) {
            e.preventDefault();

            let wrapper = $(this).closest(".quantity");
            let input = wrapper.find(".qty-input");

            let qty = parseInt(input.val());
            let product_id = input.data('id');

            let price = parseFloat($("#price-" + product_id).data("price"));

            if ($(this).hasClass("btn-plus")) {
                qty++;
            } else if ($(this).hasClass("btn-minus") && qty > 1) {
                qty--;
            }

            let total = price * qty;
            $("#total-" + product_id).text("₹" + total);


            input.val(qty);
            calculateSubtotal();

            // Send AJAX update
            $.ajax({
                url: "<?= base_url('Cart/add_to_cart') ?>",
                type: "POST",
                data: {
                    product_id: product_id,
                    quantity: qty,
                    update_mode: "update"
                },
                success: function(res) {
                    console.log("Updated", res);
                }
            });
        });

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
                    console.log(response)
                    if (response.status === 'success') {
                        // Remove row from HTML
                        $('#row-' + product_id).remove();
                        calculateSubtotal();
                        // Update cart count in header
                        $('.cart-count').text(response.cart_items);
                    }
                }
            });
        });
    });
</script>