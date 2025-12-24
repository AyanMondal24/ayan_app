<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <form action="<?= base_url('Checkout/store_address') ?>" method="post" enctype="multipart/form-data" id="checkout-form" novalidate>
            <?php
            if (!empty($address)) { ?>
                <input type="hidden" name="address_id" value="<?= $address->id ?>">
            <?php  }
            ?>

            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100 main-div">
                                <label for="fname" class="form-label my-3">First Name<sup>*</sup></label>
                                <input type="text" class="form-control" id="b_fname" name="b_fname" value="<?= !empty($address->b_fname) ? $address->b_fname : (!empty($userdata->fname) ? $userdata->fname : '') ?>">
                                <span class="error" id="b_fname_error"><?= form_error('b_fname') ?></span>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100 main-div">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input type="text" class="form-control" id="b_lname" name="b_lname" value="<?= !empty($address->b_lname) ? $address->b_lname : (!empty($userdata->lname) ? $userdata->lname : '') ?>">
                                <span class="error" id="b_lname_error"><?= form_error('b_lname') ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-item">
                        <label class="form-label my-3">Company Name<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div> -->
                    <div class="form-item main-div">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <input type="text" class="form-control" placeholder="House Number Street Name" id="b_address" name="b_address" value="<?= !empty($address->b_address) ? $address->b_address : '' ?>">
                        <span class="error" id="b_address_error"><?= form_error('b_address') ?></span>
                    </div>
                    <div class="form-item main-div">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <input type="text" class="form-control" id="b_city" name="b_city" value="<?= !empty($address->b_city) ? $address->b_city : '' ?>">
                        <span class="error" id="b_city_error"><?= form_error('b_city') ?></span>
                    </div>
                    <div class="form-item main-div">
                        <label class="form-label my-3">State<sup>*</sup></label>
                        <input type="text" class="form-control" id="b_state" name="b_state" value="<?= !empty($address->b_state) ? $address->b_state : '' ?>">
                        <span class="error" id="b_state_error"><?= form_error('b_state') ?></span>
                    </div>
                    <div class="form-item main-div">
                        <label class="form-label my-3">Country<sup>*</sup></label>
                        <input type="text" class="form-control" id="b_country" name="b_country" value="<?= !empty($address->b_country) ? $address->b_country : '' ?>">
                        <span class="error" id="b_country_error"><?= form_error('b_country') ?></span>
                    </div>
                    <div class="form-item main-div">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" class="form-control" id="b_pin" name="b_pin" value="<?= !empty($address->b_pin) ? $address->b_pin : '' ?>">
                        <span class="error" id="b_pin_error"><?= form_error('b_pin') ?></span>
                    </div>
                    <div class="form-item main-div">
                        <label class="form-label my-3">Landmark<sup>*</sup></label>
                        <input type="text" class="form-control" id="b_landmark" name="b_landmark" value="<?= !empty($address->b_landmark) ? $address->b_landmark : '' ?>" placeholder="Nearby well-known place (School, Hospital, Bank, etc.)">
                        <span class="error" id="b_landmark_error"><?= form_error('b_landmark') ?></span>
                    </div>
                    <div class="form-item main-div">
                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                        <input type="tel" class="form-control" id="b_phone" name="b_phone" value="<?= !empty($address->b_phone) ? $address->b_phone : (!empty($userdata->mobile) ? $userdata->mobile : '') ?>">
                        <span class="error" id="b_phone_error"><?= form_error('b_phone') ?></span>
                    </div>
                    <div class="form-item main-div">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input type="email" class="form-control" id="b_email" name="b_email" value="<?= !empty($address->b_email) ? $address->b_email : (!empty($userdata->email) ? $userdata->email : '') ?>">
                        <span class="error" id="b_email_error"><?= form_error('b_email') ?></span>
                    </div>
                    <!-- <div class="form-check my-3">
                        <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                        <label class="form-check-label" for="Account-1">Create an account?</label>
                    </div> -->
                    <hr>
                    <div class="form-check my-3">

                        <input class="form-check-input" type="checkbox" id="is_shipping" name="is_shipping" value="shipped"
                            <?= (isset($address->is_shipping_same) && $address->is_shipping_same == 0 ? 'checked' : '') ?>>

                        <label class="form-check-label" for="is_shipping">Ship to a different address?</label>
                    </div>
                    <!-- <div class="form-item">
                        <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                    </div> -->
                    <div class="ship" id="ship" style="display: none;">
                        <h1 class="mb-4 mt-4">Shipping Details</h1>
                        <!-- <div class="col-md-12 col-lg-6 col-xl-7"> -->
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100 main-div">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control" id="s_fname" name="s_fname" value="<?= !empty($address->s_fname) ? $address->s_fname : '' ?>">
                                    <span class="error" id="s_fname_error"><?= form_error('s_fname') ?></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100 main-div">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control" id="s_lname" name="s_lname" value="<?= !empty($address->s_lname) ? $address->s_lname : '' ?>">
                                    <span class="error" id="s_lname_error"><?= form_error('s_lname') ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-item">
                            <label class="form-label my-3">Company Name<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div> -->
                        <div class="form-item main-div">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="House Number Street Name" id="s_address" name="s_address" value="<?= !empty($address->s_address) ? $address->s_address : '' ?>">
                            <span class="error" id="s_address_error"><?= form_error('s_address') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control" id="s_city" name="s_city" value="<?= !empty($address->s_city) ? $address->s_city : '' ?>">
                            <span class="error" id="s_city_error"><?= form_error('s_city') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">State<sup>*</sup></label>
                            <input type="text" class="form-control" id="s_state" name="s_state" value="<?= !empty($address->s_state) ? $address->s_state : '' ?>">
                            <span class="error" id="s_state_error"><?= form_error('s_state') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control" id="s_country" name="s_country" value="<?= !empty($address->s_country) ? $address->s_country : '' ?>">
                            <span class="error" id="s_country_error"><?= form_error('s_country') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control" id="s_pin" name="s_pin" value="<?= !empty($address->s_pin) ? $address->s_pin : '' ?>">
                            <span class="error" id="s_pin_error"><?= form_error('s_pin') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Landmark<sup>*</sup></label>
                            <input type="text" class="form-control" id="s_landmark" name="s_landmark" value="<?= !empty($address->s_landmark) ? $address->s_landmark : '' ?>" placeholder="Nearby well-known place (School, Hospital, Bank, etc.)">
                            <span class="error" id="s_landmark_error"><?= form_error('s_landmark') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <!-- <input type="tel" id="s_phone" name="s_phone" pattern="[0-9]{10}" maxlength="10" class="form-control" required> -->
                            <input type="tel" class="form-control" id="s_phone" name="s_phone" value="<?= !empty($address->s_phone) ? $address->s_phone : '' ?>">
                            <span class="error" id="s_phone_error"><?= form_error('s_phone') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control" id="s_email" name="s_email" value="<?= !empty($address->s_email) ? $address->s_email : '' ?>">
                            <span class="error" id="s_email_error"><?= form_error('s_email') ?></span>
                        </div>
                        <!-- <div class="form-check my-3">
                            <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                            <label class="form-check-label" for="Account-1">Create an account?</label>
                        </div> -->


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
                    <?php $applied_coupon = $this->session->userdata('applied_coupon');

                    $code = $discount_type = $discount_value = $discount = "";
                    $current_coupon_code = "";
                    if (!empty($applied_coupon['coupon_id'])) {
                        $is_applied = true;
                        // $coupon = $this->coupon_model->getCouponById($applied_coupon['coupon_id']);

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
                                <input type="checkbox" class="payment-checkbox  form-check-input bg-primary border-0" id="cod" name="payment" value="Cash On Delivery">
                                <label class="form-check-label" for="cod">Cash On Delivery</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="payment-checkbox  form-check-input bg-primary border-0" id="stripe" name="payment" value="Card">
                                <label class="form-check-label" for="stripe">Stripe</label>
                            </div>
                        </div>
                    </div>
                    <div id="payment_error" class="error "></div>

                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary" id="checkout-submit">Make Payment</button>
                    </div>
                    <div id="response"></div>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- Checkout Page End -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const b_fname = document.querySelector("#b_fname");
        const b_lname = document.querySelector("#b_lname");
        const b_address = document.querySelector("#b_address");
        const b_city = document.querySelector("#b_city");
        const b_state = document.querySelector("#b_state");
        const b_country = document.querySelector("#b_country");
        const b_pin = document.querySelector("#b_pin");
        const b_landmark = document.querySelector("#b_landmark");
        const b_phone = document.querySelector("#b_phone");
        const b_email = document.querySelector("#b_email");
        const is_shipping = document.querySelector("#is_shipping");
        const s_fname = document.querySelector("#s_fname");
        const s_lname = document.querySelector("#s_lname");
        const s_address = document.querySelector("#s_address");
        const s_city = document.querySelector("#s_city");
        const s_state = document.querySelector("#s_state");
        const s_country = document.querySelector("#s_country");
        const s_pin = document.querySelector("#s_pin");
        const s_landmark = document.querySelector("#s_landmark");
        const s_phone = document.querySelector("#s_phone");
        const s_email = document.querySelector("#s_email");

        numberField('#b_pin', 6, 6, '#b_pin_error');
        numberField('#s_pin', 6, 6, '#s_pin_error');
        numberField('#b_phone', 10, 10, '#b_phone_error');
        numberField('#s_phone', 10, 10, '#s_phone_error');
        $("#checkout-form").on('submit', function(e) {

            e.preventDefault();
            let myvalidate = true;
            const fields = [{
                    element: b_fname,
                    rules: [{
                        rule: "required",
                        message: "First name field is required"
                    }],
                    errorSelector: "#b_fname_error"
                },
                {
                    element: b_lname,
                    rules: [{
                        rule: "required",
                        message: "Last name field is required"
                    }],
                    errorSelector: "#b_lname_error"
                },
                {
                    element: b_address,
                    rules: [{
                            rule: "required",
                            message: "Address field is required"
                        },
                        {
                            rule: "min",
                            value: 10
                        }
                    ],
                    errorSelector: "#b_address_error"
                },
                {
                    element: b_city,
                    rules: [{
                        rule: "required",
                        message: "City field is required"
                    }],
                    errorSelector: "#b_city_error"
                },
                {
                    element: b_state,
                    rules: [{
                        rule: "required",
                        message: "State field is required"
                    }],
                    errorSelector: "#b_state_error"
                },
                {
                    element: b_country,
                    rules: [{
                        rule: "required",
                        message: "Country field is required"
                    }],
                    errorSelector: "#b_country_error"
                },
                {
                    element: b_pin,
                    rules: [{
                            rule: "required",
                            message: "Pin Code field is required"
                        },
                        {
                            rule: "number",
                        },
                        {
                            rule: "min",
                            value: 6
                        },
                        {
                            rule: "max",
                            value: 6
                        },

                    ],
                    errorSelector: "#b_pin_error"
                },
                {
                    element: b_landmark,
                    rules: [{
                            rule: "required",
                            message: "Landmark field is required"
                        },
                        {
                            rule: "min",
                            value: 3,
                            message: "Landmark must be at least 3 characters"
                        }
                    ],
                    errorSelector: "#b_landmark_error"
                },
                {
                    element: b_phone,
                    rules: [{
                            rule: "required",
                            message: "Phone number field is required"
                        },
                        {
                            rule: "number"
                        },
                        {
                            rule: "min",
                            value: 10
                        },
                        {
                            rule: "max",
                            value: 10
                        }
                    ],
                    errorSelector: "#b_phone_error"
                },

                {
                    element: b_email,
                    rules: [{
                            rule: "required",
                            message: "Email field is required"
                        },
                        {
                            rule: "email",
                            message: "Enter a valid email"
                        }

                    ],
                    errorSelector: "#b_email_error"
                },
            ];

            let is_validate = validate(fields);

            if (!is_validate) {
                myvalidate = false;
                return;
            }

            if ($("#is_shipping").is(":checked")) {
                const fieldss = [{
                        element: s_fname,
                        rules: [{
                            rule: "required",
                            message: "First name field is required"
                        }],
                        errorSelector: "#s_fname_error"
                    },

                    {
                        element: s_lname,
                        rules: [{
                            rule: "required",
                            message: "Last name field is required"
                        }],
                        errorSelector: "#s_lname_error"
                    },
                    {
                        element: s_address,
                        rules: [{
                                rule: "required",
                                message: "Address field is required"
                            },
                            {
                                rule: "min",
                                value: 10
                            }
                        ],
                        errorSelector: "#s_address_error"
                    },
                    {
                        element: s_city,
                        rules: [{
                            rule: "required",
                            message: "City field is required"
                        }],
                        errorSelector: "#s_city_error"
                    },
                    {
                        element: s_state,
                        rules: [{
                            rule: "required",
                            message: "State field is required"
                        }],
                        errorSelector: "#s_state_error"
                    },
                    {
                        element: s_country,
                        rules: [{
                            rule: "required",
                            message: "Country field is required"
                        }],
                        errorSelector: "#s_country_error"
                    },
                    {
                        element: s_pin,
                        rules: [{
                                rule: "required",
                                message: "Pin Code field is required"
                            },
                            {
                                rule: "number",
                            },
                            {
                                rule: "min",
                                value: 6
                            },
                            {
                                rule: "max",
                                value: 6
                            },

                        ],
                        errorSelector: "#s_pin_error"
                    },
                    {
                        element: s_landmark,
                        rules: [{
                                rule: "required",
                                message: "Landmark field is required"
                            },
                            {
                                rule: "min",
                                value: 3,
                                message: "Landmark must be at least 3 characters"
                            }
                        ],
                        errorSelector: "#s_landmark_error"
                    },
                    {
                        element: s_phone,
                        rules: [{
                                rule: "required",
                                message: "Phone number field is required"
                            },
                            {
                                rule: "number"
                            },
                            {
                                rule: "min",
                                value: 10
                            },
                            {
                                rule: "max",
                                value: 10
                            }
                        ],
                        errorSelector: "#s_phone_error"
                    },

                    {
                        element: s_email,
                        rules: [{
                                rule: "required",
                                message: "Email field is required"
                            },
                            {
                                rule: "email",
                                message: "Enter a valid email"
                            }

                        ],
                        errorSelector: "#s_email_error"
                    },
                ];

                let is_validate = validate(fieldss);

                if (!is_validate) {
                    myvalidate = false;
                    return;
                }
            }

            let paymentChecked = document.querySelector('.payment-checkbox:checked');

            if (!paymentChecked) {
                $("#payment_error").text("Please select a payment method");
                myvalidate = false;
                return;
            }
            if (paymentChecked.value === 'Cash On Delivery') {
                $("#checkout-submit").text("Place Order");
            } else {
                $("#checkout-submit").text("Make Payment");
            }

            $("#payment_error").text('');



            // console.log(myvalidate)
            if (myvalidate === true) {
                $.ajax({
                    url: "<?= base_url('Checkout/store_address') ?>",
                    type: "POST",
                    data: $("#checkout-form").serialize(),
                    dataType: "JSON",
                    success: function(response) {
                        $(".error").html('')
                        set_page(response);
                    }
                })
            }

        }); //end checkout submit 



        $(".payment-checkbox").on("change", function() {
            $(".payment-checkbox").not(this).prop("checked", false);
            if (this.value === "Cash On Delivery") {
                $("#checkout-submit").text("Place Order");
            } else {
                $("#checkout-submit").text("Make Payment");
            }
        });

        function toggleShipping() {
            const div = document.getElementById("ship");
            const check = document.getElementById("is_shipping");
            div.style.display = check.checked ? "block" : "none";
        }
        toggleShipping();
        document.getElementById("is_shipping").addEventListener("change", toggleShipping);
     
    });

    function set_page(response) {
        if (response.status === 'validation_error') {
            $.each(response.errors, function(field, msg) {
                $(`input[name="${field}"]`).closest('.main-div').find(".error").html(msg);
            })
            // console.log(response.messsage)
            return;
        }

        if (response.status === 'success') {
            $("#response").addClass('success-msg').removeClass('error-msg').html(response.message).fadeIn(200).delay(2000).fadeOut(200);

            window.location.href = response.redirect;
            // window.location.reload();

            // console.log(response.message)
        } else {
            $("#response").addClass('error-msg').removeClass('success-msg').html(response.message).fadeIn(200).delay(2000).fadeOut(200)
            // return;
        }


    }
</script>