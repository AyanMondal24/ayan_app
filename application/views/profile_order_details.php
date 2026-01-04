<div class="container order-details-page">

    <div class="order-main">


        <!-- Product Card -->
        <div class="order-card">

            <div class="product-top">
                <?php foreach ($items as $item): ?>
                    <div class="product-row">
                        <img src="<?= base_url('assets/uploads/products/thumb/' . $item->image_name) ?>" alt="product">

                        <div class="product-info">
                            <h4><?= $item->product_name ?></h4>
                            <p>Qty: <?= $item->quantity ?></p>
                        </div>

                        <div class="product-price">
                            ₹<?= number_format($item->total, 2) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


            <!-- Order Status -->
            <?php if (!empty($order)) {
                if ($order->order_status === 'pending') { ?>

                    <div class="order-status">
                        <div class="status-item">
                            <span class="check-not"></span>
                            <span>Order Not Confirm</span>
                        </div>

                    </div>

                <?php   } else if ($order->order_status === 'confirmed') { ?>
                    <div class="order-status">
                        <div class="status-item">
                            <span class="check"></span>
                            <span>Order Confirmed, <?= smart_order_date($order->order_updated) ?></span>
                        </div>
                        <div class="status-item">
                            <span class="check"></span>
                            <span>Delivered, Sep 25</span>
                        </div>
                    </div>
                <?php  } else { ?>
                    <div class="order-status">
                        <div class="status-item">
                            <span class="check-not"></span>
                            <span>Order Canceled</span>
                        </div>

                    </div>
            <?php  }
            } ?>

        </div>
        <!-- <a href="#" class="updates-link">See All Updates ›</a> -->

        <!-- Order ID -->
        <!-- <div class="order-id"> -->
        <!-- Order Code - <?= $order->order_number ?>
            <span class="copy">📋</span> -->
        <!-- <span>Order Code - </span>
            <span id="orderCode">ORD-20251224-752923-116</span>
            <button id="copyBtn" onclick="copyOrderCode()">📋</button>
        </div> -->

        <div class="order-code-wrapper">
            <span class="order-label">Order Code</span>
            <span id="orderCode" class="order-code">ORD-20251224-752923-116</span>

            <button class="copy-btn" id="copyBtn" onclick="copyOrderCode()">
                <svg class="copy-icon" viewBox="0 0 24 24">
                    <path d="M16 1H4a2 2 0 0 0-2 2v12h2V3h12V1zm3 4H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm0 16H8V7h11v14z" />
                </svg>
                <span class="copy-text">Copy</span>
            </button>
        </div>

    </div>

    <!-- RIGHT SIDEBAR -->
    <div class="order-sidebar">

        <?php
        if ($order->is_shipping_same == 1) {
            $name = $order->b_fname . ' ' . $order->b_lname;
            $address = $order->b_country . "," . $order->b_state . "," . $order->b_city . "," . $order->b_address . "," . $order->b_pin;
            $landmark = $order->b_landmark;
            $phone = $order->b_phone;
        } else {
            $name = $order->s_fname . ' ' . $order->s_lname;
            $address = $order->s_country . "," . $order->s_state . "," . $order->s_city . "," . $order->s_address . "," . $order->s_pin;
            $landmark = $order->s_landmark;
            $phone = $order->s_phone;
        }
        ?>
        <!-- Delivery Details -->
        <div class="sidebar-card myDesign">
            <h3>Delivery details</h3>

            <div class="info-row">
                <p><?= $address ?></p>
            </div>

            <div class="info-row">
                <strong><?= $name ?></strong>
                <p><?= $phone ?></p>
            </div>
            <div class="info-row">
                <?php $enc_order_id = urlencode(base64_encode($this->encryption->encrypt($order->order_id))) ?>
                <a href="<?= base_url('Profile/edit_billing_address/' . $enc_order_id) ?>" class="btn btn-primary text-light">Change Address</a>
            </div>
        </div>

        <?php
        $discount = 0;

        if (!empty($order->coupon_code)) {
            if ($order->discount_type === 'percentage') {
                $discount = ($order->listing_price * $order->discount_value) / 100;
            } else {
                $discount = $order->discount_value;
            }
        }

        $order->discount_amount = $discount;
        $final_amount = $order->listing_price - $discount;
        ?>



        <div class="sidebar-card myDesign mt-4">
            <h3>Price details</h3>

            <div class="price-row">
                <span>Listing price</span>
                <span>₹ <?= number_format($order->listing_price, 2) ?></span>
            </div>

            <?php if (!empty($order->coupon_code)) { ?>
                <div class="price-row">
                    <span>Discount (<?= $order->coupon_code ?>)</span>
                    <span> ₹ <?= number_format($order->discount_amount, 2) ?></span>
                </div>
            <?php } ?>

            <hr>

            <div class="price-row total">
                <h3>Total amount</h3>
                <span>₹ <?= number_format($final_amount, 2) ?></span>
            </div>

            <div class="payment-info">
                <span class="label">Payment</span>
                <span class="badge badge-payment">
                    <?= $order->payment_method ?>
                </span>
            </div>

            <div class="payment-info">
                <span class="label">Order Status</span>
                <span class="badge badge-status <?= strtolower($order->order_status) ?>">
                    <?= $order->order_status ?>
                </span>
            </div>

        </div>

    </div>

</div>

<script>
    function copyOrderCode() {
        const text = document.getElementById("orderCode").innerText;
        navigator.clipboard.writeText(text).then(() => {
            document.getElementById("copyBtn").innerText = "Copied ✅";
        });
    }
</script>
