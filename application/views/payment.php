    <?php
    $order_id = $order->order_id;
    $enc_order_id = urlencode(base64_encode($this->encryption->encrypt($order_id)));
    $subtotal = 0;
    foreach ($order_details as $od) {
        $subtotal += $od->price * $od->quantity;
    }
    $discount = 0;
    ?>
    <div class="container ">
        <div class="row g-4 justify-content-end mb-4 w-50">
            <input type="hidden" name="order_id" value=<?= isset($order->order_id) ? $order->order_id : 0 ?>>
            <!-- <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4"> -->
            <div class="bg-light rounded">
                <div class="p-4">
                    <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="mb-0 me-4">Subtotal:</h5>
                        <p class="mb-0" id="subtotal">&#8377;<?= number_format((float)$subtotal, 2)  ?></p>
                    </div>
                    <div id="discount_section" style="<?= !empty($order->coupon_code) ? '' : 'display:none' ?>">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Discount :</h5>
                            <div id="show-discount-div">
                                <p class="mb-0">
                                    <?php if (!empty($order->coupon_code) && $order->discount_type === 'percentage') { ?>
                                        <span id="discount-type">(<?= $order->discount_value ?>%) Off :</span>
                                        <?php $discount = ($subtotal * $order->discount_value) / 100; ?>
                                        ₹<span id="discount"><?= number_format($discount, 2) ?></span>
                                    <?php } elseif (!empty($order->coupon_code) && $order->discount_type === 'fixed') { ?>
                                        <span id="discount-type">Flat ₹<?= $order->discount_value ?> Off :</span>
                                        <?php $discount = $order->discount_value ?>
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
                    <?php $grand_total = $subtotal - $discount; ?>
                    <p class="mb-0 pe-4" id="grand_total">₹ <?= number_format($grand_total, 2) ?></p>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <form id="payment-form">
            <div id="payment"></div>

            <button type="submit" id="submit-btn" class="btn btn-primary text-light">
                Pay Now
            </button>

            <div id="payment-message"></div>
        </form>
    </div>

    <!-- <script src="https://js.stripe.com/clover/stripe.js"></script> -->
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajax({
                url: "<?= base_url('payment/get_intent'); ?>",
                type: 'POST',
                data: {
                    // "amount": amountInPaise,
                    // "currency": 'inr',
                    "order_id": <?= (int) $order->order_id ?>

                },
                dataType: 'json',
                success: function(response) {
                    if (response.clientSecret) {
                        buildPaymentElem(response.clientSecret);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            var stripe = Stripe('pk_test_51SfJbNF338nGzwqeHvBJvTtptFqt2i1EDiXJckfHeSeTNzmffuRs5XnrRztlSClA6O7AL4QfuMCFLiGHflyZQqYm00BL0qxd2f');
            let elements;

            function buildPaymentElem(clientSecret) {

                elements = stripe.elements({
                    clientSecret: clientSecret,
                    fields: {
                        billingDetails: {
                            name: 'never',
                            email: 'never',
                            phone: 'never',
                            address: 'never' // disable address
                        }
                    }
                });

                const paymentElement = elements.create('payment');
                paymentElement.mount('#payment');
            }



            $('#payment-form').on('submit', async function(e) {
                e.preventDefault();

                $('#submit-btn').prop('disabled', true).text('Processing...');

                const {
                    error
                } = await stripe.confirmPayment({
                    elements: elements,
                    confirmParams: {
                        return_url: "<?= base_url('Thank_you/verifyIntent'); ?>"
                    }
                });

                if (error) {
                    $('#payment-message').text(error.message);
                    $('#submit-btn').prop('disabled', false).text('Pay Now');
                }
            });
        });
    </script>