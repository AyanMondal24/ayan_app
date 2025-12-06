<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <form action="#">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label for="fname" class="form-label my-3">First Name<sup>*</sup></label>
                                <input type="text" class="form-control" id="fname" name="fname">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-item">
                        <label class="form-label my-3">Company Name<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div> -->
                    <div class="form-item">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <input type="text" class="form-control" placeholder="House Number Street Name">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Country<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                        <input type="tel" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input type="email" class="form-control">
                    </div>
                    <!-- <div class="form-check my-3">
                        <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                        <label class="form-check-label" for="Account-1">Create an account?</label>
                    </div> -->
                    <hr>
                    <div class="form-check my-3">
                        <input class="form-check-input" type="checkbox" id="Address-1" name="Address" value="Address">
                        <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                    </div>
                    <div class="form-item">
                        <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                    </div>
                    <div class="ship" id="ship" style="display: none;">
                        <h1 class="mb-4 mt-4">Shipping Details</h1>
                        <!-- <div class="col-md-12 col-lg-6 col-xl-7"> -->
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-item">
                            <label class="form-label my-3">Company Name<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div> -->
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="House Number Street Name">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control">
                        </div>
                        <!-- <div class="form-check my-3">
                            <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                            <label class="form-check-label" for="Account-1">Create an account?</label>
                        </div> -->

                        <div class="form-item">
                            <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-5">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Images</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody id="cart-body">
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
                                                    <input type="text" class="form-control form-control-sm text-center border-0 qty-input" id="quantity-input" value="<?= $item->qty ?>" data-id="<?= $item->product_id ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <?php $total = $item->qty * $item->price  ?>
                                                <p class="mb-0 mt-4 total">&#8377;<?= number_format((float)$total, 2) ?></p>
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

                    $applied_coupon = $this->session->userdata('applied_coupon');

                    $code           = isset($applied_coupon['code']) ? $applied_coupon['code'] : '';
                    $discount_type  = isset($applied_coupon['type']) ? $applied_coupon['type'] : '';
                    $discount_value = isset($applied_coupon['discount_value']) ? $applied_coupon['discount_value'] : '';
                    $discount = isset($applied_coupon['discount']) ? $applied_coupon['discount'] : '';

                    if (!empty($applied_coupon)) {
                        $grand_total = $subtotal - $discount;
                    }

                    if (!empty($product)) { ?>

                        <div class="row g-4 justify-content-end">
                            <!-- <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4"> -->
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
                                </div>
                            <!-- </div> -->
                        </div>
                    <?php  }
                    ?>

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="payment-checkbox  form-check-input bg-primary border-0" id="Delivery-1" name="Delivery" value="Delivery">
                                <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="payment-checkbox  form-check-input bg-primary border-0" id="Razorpay-1" name="Razorpay" value="Razorpay">
                                <label class="form-check-label" for="Razorpay-1">Razorpay</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="button" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(".payment-checkbox").on("change", function() {
            $(".payment-checkbox").not(this).prop("checked", false);
        });

        document.getElementById("Address-1").addEventListener("change", function() {

            const div = document.getElementById("ship");
            div.style.display = this.checked ? "block" : "none";
        });

    })
</script>