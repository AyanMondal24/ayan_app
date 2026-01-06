<div class="container py-5">
    <form action="<?= base_url('Profile/update_address') ?>" method="post" enctype="multipart/form-data" id="address-form" novalidate>
        <?php
        if (!empty($address->id)) { ?>
            <input type="hidden" name="address_id" value="<?= $address->id   ?>">
        <?php  }
        ?>
        <?php
        $enc_order_id = null;
        if (!empty($address->order_id)) {
            $enc_order_id = urlencode(base64_encode($this->encryption->encrypt($address->order_id))) ?>
            <input type="hidden" name="order_id" value="<?= $address->order_id   ?>">
        <?php  }
        ?>

        <div class="row g-5">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <?php if (!empty($billing)) { ?>
                    <input type="hidden" name="is_billing" value="billing">
                    <div>
                        <h1 class="mb-4 mt-4">Billing Details</h1>

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
                        <?php if (!empty($address->id)) { ?>
                            <div class="form-item main-div">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="email" class="form-control" id="b_email" name="b_email" value="<?= !empty($address->b_email) ? $address->b_email : (!empty($userdata->email) ? $userdata->email : '') ?>">
                                <span class="error" id="b_email_error"><?= form_error('b_email') ?></span>
                            </div>
                        <?php }  ?>

                        <!-- for order details change order address page  -->
                        <?php if (!empty($address->order_id)) { ?>
                            <div class="form-item main-div">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="email" class="form-control" id="b_email_order" name="b_email" value="<?= !empty($address->order_b_email) ? $address->order_b_email : ''  ?>">
                                <span class="error" id="b_email_error_order"><?= form_error('b_email') ?></span>
                            </div>
                        <?php  } ?>

                        <?php if (!empty($address->id) && $address->is_shipping_same == 1) { ?>
                            <hr>
                            <div class="form-check my-3">
                                <input class="form-check-input" type="checkbox" id="is_shipping" name="is_shipping" value="1"
                                    <?= (isset($address->is_shipping_same) && $address->is_shipping_same == 0 ? 'checked' : '') ?>>

                                <label class="form-check-label" for="is_shipping">Ship to a different address?</label>
                            </div>
                        <?php  } else if (!empty($address->order_id)) { ?>
                            <hr>
                            <div class="form-check my-3">
                                <input class="form-check-input" type="checkbox" id="is_shipping_order" name="is_shipping" value="1"
                                    <?= (isset($address->is_shipping_same) && $address->is_shipping_same == 0 ? 'checked' : '') ?>>

                                <label class="form-check-label" for="is_shipping">Ship to a different address?</label>
                            </div>
                        <?php } else { ?>
                            <input class="form-check-input" type="hidden" name="is_shipping" value="1">
                        <?php } ?>

                        <div class="ship" id="ship" style="display: none;">
                            <h1 class="mb-4 mt-4">Shipping Details</h1>
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
                                <input type="tel" class="form-control" id="s_phone" name="s_phone" value="<?= !empty($address->s_phone) ? $address->s_phone : '' ?>">
                                <span class="error" id="s_phone_error"><?= form_error('s_phone') ?></span>
                            </div>
                            <?php if (!empty($address->id)) { ?>
                                <div class="form-item main-div">
                                    <label class="form-label my-3">Email Address<sup>*</sup></label>
                                    <input type="email" class="form-control" id="s_email" name="s_email" value="<?= !empty($address->s_email) ? $address->s_email : '' ?>">
                                    <span class="error" id="s_email_error"><?= form_error('s_email') ?></span>
                                </div>
                            <?php } ?>

                            <?php if (!empty($address->order_id)) { ?>
                                <div class="form-item main-div">
                                    <label class="form-label my-3">Email Address<sup>*</sup></label>
                                    <input type="email" class="form-control" id="s_email_order" name="s_email" value="<?= !empty($address->order_s_email) ? $address->order_s_email : ''  ?>">
                                    <span class="error" id="s_email_error_order"><?= form_error('s_email') ?></span>
                                </div>
                            <?php } ?>
                        </div>


                    </div>
                <?php } ?>

                <!-- shipping form  -->
                <div id="ship-btn-clicked" style="display: block;">
                    <?php if (!empty($shipping)) { ?>
                        <input type="hidden" name="is_shippingcheck" value="shipping">

                        <h1 class="mb-4 mt-4">Shipping Details</h1>
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100 main-div">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control" id="shipping_fname" name="s_fname" value="<?= !empty($address->s_fname) ? $address->s_fname : '' ?>">
                                    <span class="error" id="shipping_fname_error"><?= form_error('s_fname') ?></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100 main-div">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control" id="shipping_lname" name="s_lname" value="<?= !empty($address->s_lname) ? $address->s_lname : '' ?>">
                                    <span class="error" id="shipping_lname_error"><?= form_error('s_lname') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="House Number Street Name" id="shipping_address" name="s_address" value="<?= !empty($address->s_address) ? $address->s_address : '' ?>">
                            <span class="error" id="shipping_address_error"><?= form_error('s_address') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control" id="shipping_city" name="s_city" value="<?= !empty($address->s_city) ? $address->s_city : '' ?>">
                            <span class="error" id="shipping_city_error"><?= form_error('s_city') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">State<sup>*</sup></label>
                            <input type="text" class="form-control" id="shipping_state" name="s_state" value="<?= !empty($address->s_state) ? $address->s_state : '' ?>">
                            <span class="error" id="shipping_state_error"><?= form_error('s_state') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control" id="shipping_country" name="s_country" value="<?= !empty($address->s_country) ? $address->s_country : '' ?>">
                            <span class="error" id="shipping_country_error"><?= form_error('s_country') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control" id="shipping_pin" name="s_pin" value="<?= !empty($address->s_pin) ? $address->s_pin : '' ?>">
                            <span class="error" id="shipping_pin_error"><?= form_error('s_pin') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Landmark<sup>*</sup></label>
                            <input type="text" class="form-control" id="shipping_landmark" name="s_landmark" value="<?= !empty($address->s_landmark) ? $address->s_landmark : '' ?>" placeholder="Nearby well-known place (School, Hospital, Bank, etc.)">
                            <span class="error" id="shipping_landmark_error"><?= form_error('s_landmark') ?></span>
                        </div>
                        <div class="form-item main-div">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <!-- <input type="tel" id="s_phone" name="s_phone" pattern="[0-9]{10}" maxlength="10" class="form-control" required> -->
                            <input type="tel" class="form-control" id="shipping_phone" name="s_phone" value="<?= !empty($address->s_phone) ? $address->s_phone : '' ?>">
                            <span class="error" id="shipping_phone_error"><?= form_error('s_phone') ?></span>
                        </div>

                        <div class="form-item main-div">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control" id="shipping_email" name="s_email" value="<?= !empty($address->s_email) ? $address->s_email : '' ?>">
                            <span class="error" id="shipping_email_error"><?= form_error('s_email') ?></span>
                        </div>


                    <?php } ?>
                </div>
                <div class="form-item mt-2">
                    <input type="button" name="submit" id="saved" value="Saved" class="form_control btn btn-success">
                </div>

            </div>


        </div>
    </form>
    <div id="response"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // const checkbox = document.getElementById('is_shipping');
        // const shipDiv = document.getElementById('ship');
        console.log(<?= $address->is_shipping_same ?>)
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

        const b_email_order = document.querySelector("#b_email_order");
        const s_email_order = document.querySelector("#s_email_order");

        const order_id = <?= isset($address->order_id) ? (int)$address->order_id : 'null' ?>

        const hasBilling = <?= isset($billing) ? 'true' : 'false' ?>;
        if (hasBilling) {
            numberField('#b_pin', 6, 6, '#b_pin_error');
            numberField('#b_phone', 10, 10, '#b_phone_error');
            numberField('#s_pin', 6, 6, '#s_pin_error');
            numberField('#s_phone', 10, 10, '#s_phone_error');
        } else {
            numberField('#shipping_pin', 6, 6, '#shipping_pin_error');
            numberField('#shipping_phone', 10, 10, '#shipping_phone_error');
        }
        $("#saved").on("click", function() {
            $("#address-form").trigger("submit");
        });

        $("#address-form").on('submit', function(e) {
            e.preventDefault();
            let myvalidate = true;
            if (hasBilling) {


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
                ];

                if (!order_id) {
                    fields.push({
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
                    });
                } else {
                    fields.push({
                        element: b_email_order,
                        rules: [{
                                rule: "required",
                                message: "Email field is required"
                            },
                            {
                                rule: "email",
                                message: "Enter a valid email"
                            }
                        ],
                        errorSelector: "#b_email_error_order"
                    });
                }

                let is_validate = validate(fields);

                if (!is_validate) {
                    myvalidate = false;
                    return;
                }

                if ($("#is_shipping").is(":checked")) {

                    const billing_is_shipping = [{
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
                    ];

                    if (!order_id) {
                        billing_is_shipping.push({
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
                        });
                    } else {
                        billing_is_shipping.push({
                            element: s_email_order,
                            rules: [{
                                    rule: "required",
                                    message: "Email field is required"
                                },
                                {
                                    rule: "email",
                                    message: "Enter a valid email"
                                }
                            ],
                            errorSelector: "#s_email_error_order"
                        });
                    }
                    let is_validate = validate(billing_is_shipping);

                    if (!is_validate) {
                        myvalidate = false;
                        return;
                    }
                }
            }


            // shipping form validation (only if elements exist)

            const is_shipping_same = <?= (int)$address->is_shipping_same ?>; // 0 or 1

            const shipping_val = "<?= isset($shipping) ? $shipping : '' ?>"; // 'shipping' or ''

            // console.log(is_shipping_same)
            // console.log(shipping_val)


            if (is_shipping_same == 0 && shipping_val === 'shipping' && shipping_fname) {

                const shipping_fname = document.querySelector("#shipping_fname");
                const shipping_lname = document.querySelector("#shipping_lname");
                const shipping_address = document.querySelector("#shipping_address");
                const shipping_city = document.querySelector("#shipping_city");
                const shipping_state = document.querySelector("#shipping_state");
                const shipping_country = document.querySelector("#shipping_country");
                const shipping_pin = document.querySelector("#shipping_pin");
                const shipping_landmark = document.querySelector("#shipping_landmark");
                const shipping_phone = document.querySelector("#shipping_phone");
                const shipping_email = document.querySelector("#shipping_email");

                const fieldss = [{
                        element: shipping_fname,
                        rules: [{
                            rule: "required",
                            message: "First name field is required"
                        }],
                        errorSelector: "#shipping_fname_error"
                    },

                    {
                        element: shipping_lname,
                        rules: [{
                            rule: "required",
                            message: "Last name field is required"
                        }],
                        errorSelector: "#shipping_lname_error"
                    },
                    {
                        element: shipping_address,
                        rules: [{
                                rule: "required",
                                message: "Address field is required"
                            },
                            {
                                rule: "min",
                                value: 10
                            }
                        ],
                        errorSelector: "#shipping_address_error"
                    },
                    {
                        element: shipping_city,
                        rules: [{
                            rule: "required",
                            message: "City field is required"
                        }],
                        errorSelector: "#shipping_city_error"
                    },
                    {
                        element: shipping_state,
                        rules: [{
                            rule: "required",
                            message: "State field is required"
                        }],
                        errorSelector: "#shipping_state_error"
                    },
                    {
                        element: shipping_country,
                        rules: [{
                            rule: "required",
                            message: "Country field is required"
                        }],
                        errorSelector: "#shipping_country_error"
                    },
                    {
                        element: shipping_pin,
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
                        errorSelector: "#shipping_pin_error"
                    },
                    {
                        element: shipping_landmark,
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
                        errorSelector: "#shipping_landmark_error"
                    },
                    {
                        element: shipping_phone,
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
                        errorSelector: "#shipping_phone_error"
                    },

                    {
                        element: shipping_email,
                        rules: [{
                                rule: "required",
                                message: "Email field is required"
                            },
                            {
                                rule: "email",
                                message: "Enter a valid email"
                            }

                        ],
                        errorSelector: "#shipping_email_error"
                    },
                ];


                let is_validate = validate(fieldss);

                if (!is_validate) {

                    myvalidate = false;
                    return;

                }

            }
            if (myvalidate) {
                $.ajax({
                    url: "<?= base_url('Profile/update_address') ?>",
                    type: "POST",
                    data: $("#address-form").serialize(),
                    dataType: "JSON",
                    success: function(response) {
                        // console.log(response)
                        if (response.status === 'validation_error') {
                            $.each(response.errors, function(field, msg) {
                                $(`input[name="${field}"]`).closest('.main-div').find(".error").html(msg);
                            });
                            return;
                        }
                        if (response.status === 'success') {
                            $("#response").addClass("success-msg").removeClass('error-msg').html(response.message).fadeIn(200).delay(3000).fadeOut(200);
                            // show spinner
                            setTimeout(function() {
                                $('#spinner').addClass('show');
                            }, 600);

                            if (order_id) {
                                // redirect after spinner
                                setTimeout(function() {
                                    window.location.href = document.referrer || "<?= base_url('profile/order/details/' . $enc_order_id) ?>";
                                }, 1800);
                            } else {
                                setTimeout(function() {
                                    setTimeout(function() {
                                        window.location.href = "<?= base_url('profile#address') ?>";
                                    }, 1800);

                                }, 1800);
                            }
                        } else {
                            $("#response").addClass("error-msg").removeClass('success-msg').html(response.message).fadeIn(200).delay(3000).fadeOut(200);
                        }
                    }
                });
            }

        });


        function handleShipping() {
            const checkbox =
                document.getElementById('is_shipping_order') ||
                document.getElementById('is_shipping');

            toggleShipping(checkbox, 'ship');
        }

        // Run on page load
        handleShipping();

        // Listen only to checkbox changes
        document.addEventListener('change', (e) => {
            if (
                e.target.id === 'is_shipping' ||
                e.target.id === 'is_shipping_order'
            ) {
                handleShipping();
            }
        });


        function toggleShipping(checkbox, targetId) {
            const shipDiv = document.getElementById(targetId);
            if (!checkbox || !shipDiv) return;

            shipDiv.style.display = checkbox.checked ? 'block' : 'none';

            shipDiv.querySelectorAll('input, select, textarea').forEach(input => {
                input.disabled = !checkbox.checked;
            });
        }

    });
</script>
