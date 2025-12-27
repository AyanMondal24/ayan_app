<div class="container-fluid">

    <!-- ORDER HEADER -->
    <div class="card mb-4 shadow-sm">
        <!-- <div class="card-header bg-dark text-white d-flex justify-content-between">
            <h5 class="mb-0">Order #<?= $order_details->order_number ?></h5>
            <span class="badge bg-info">
                <?= ucfirst($order_details->order_status) ?>
            </span>
        </div> -->

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Order #<?= $order_details->order_number ?></h5>

            <div class="d-flex gap-2 align-items-center">
                <?php
                $status = strtolower($order_details->order_status);

                $badgeClass = 'bg-info';

                if ($status === 'confirmed') {
                    $badgeClass = 'bg-success';
                } elseif ($status === 'cancelled') {
                    $badgeClass = 'bg-danger';
                }
                ?>

                <span class="badge <?= $badgeClass ?>">
                    <?= ucfirst($order_details->order_status) ?>
                </span>

                <div class="ms-auto d-flex align-items-center gap-2">
                    <?php if ($order_details->order_status == 'pending'): ?>
                        <a href="<?= base_url('admin/orders/confirm/' . urlencode(base64_encode($this->encryption->encrypt($order_details->order_id)))) ?>"
                            class="btn btn-sm btn-success">
                            ✔ Confirm
                        </a>
                    <?php endif; ?>
                    <?php if ($order_details->order_status !== 'cancelled'): ?>
                        <a href="<?= base_url('admin/orders/cancel/' . urlencode(base64_encode($this->encryption->encrypt($order_details->order_id)))) ?>"
                            class="btn btn-sm btn-danger rounded"
                            onclick="return confirm('Are you sure you want to cancel this order?')">
                            ✖ Cancel
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div class="card-body row">
            <div class="col-md-4">
                <p><strong>Payment Method:</strong> <?= ucfirst($order_details->payment_method) ?></p>
                <p>
                    <strong>Payment Status:</strong>
                    <span class="badge <?= $order_details->payment_status == 'paid' ? 'bg-success' : 'bg-warning' ?>">
                        <?= ucfirst($order_details->payment_status) ?>
                    </span>
                </p>
            </div>
        </div>


    </div>

    <!-- ADDRESS SECTION -->
    <div class="row mb-4">

        <!-- BILLING ADDRESS -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    Billing Address
                </div>
                <div class="card-body">
                    <p><strong><?= $order_details->b_fname . ' ' . $order_details->b_lname ?></strong></p>
                    <p><strong>Address - </strong> <?= $order_details->b_country ?> ,<?= $order_details->b_state ?>,<?= $order_details->b_city ?>, <?= $order_details->b_address ?> </p>
                    <p> <strong>Landmark - </strong> <?= $order_details->b_landmark ?></p>
                    <p><strong>Pin - </strong> <?= $order_details->b_pin ?></p>
                    <p>📞 <?= $order_details->b_phone ?></p>
                </div>
            </div>
        </div>

        <!-- SHIPPING ADDRESS -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    Shipping Address
                </div>
                <div class="card-body">
                    <?php if ($order_details->is_shipping_same): ?>
                        <p class="text-muted">Same as billing address</p>
                    <?php else: ?>
                        <p><strong><?= $order_details->s_fname . ' ' . $order_details->s_lname ?></strong></p>
                        <p><strong>Address - </strong> <?= $order_details->s_country ?> ,<?= $order_details->s_state ?>,<?= $order_details->s_city ?>, <?= $order_details->s_address ?> </p>
                        <p> <strong>Landmark - </strong> <?= $order_details->s_landmark ?></p>
                        <p><strong>Pin - </strong> <?= $order_details->s_pin ?></p>
                        <p>📞 <?= $order_details->s_phone ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <!-- PRODUCT TABLE -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Ordered Products
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $grandTotal = 0; ?>
                    <?php foreach ($products as $item): ?>
                        <?php $grandTotal += $item->total; ?>
                        <tr>
                            <td>
                                <img src="<?= base_url('assets/uploads/products/thumb/' . $item->image_name) ?>"
                                    width="60" class="img-thumbnail">
                            </td>
                            <td><?= $item->product_name ?></td>
                            <td>₹<?= number_format($item->price, 2) ?></td>
                            <td><?= $item->quantity ?></td>
                            <td><strong>₹<?= number_format($item->total, 2) ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- PRICE SUMMARY -->
    <div class="row justify-content-end mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    Order Summary
                </div>
                <div class="card-body">
                    <p>Listing Price: <strong>₹<?= number_format($order_details->listing_price, 2) ?></strong></p>

                    <?php if (!empty($order_details->coupon_code)): ?>
                        <p>
                            Coupon (<?= $order_details->coupon_code ?>):
                            <strong>
                                <?= $order_details->discount_type == 'percentage'
                                    ? $order_details->discount_value . '%'
                                    : '₹' . $order_details->discount_value ?>
                            </strong>
                        </p>
                        <?php
                        $listingPrice = (float) $order_details->listing_price;
                        $discountValue = (float) $order_details->discount_value;
                        if ($order_details->discount_type == 'percentage') {
                            $discountAmount = ($listingPrice * $discountValue) / 100;
                            $grandTotal = $listingPrice - $discountAmount;
                        } else {
                            $discountAmount = $discountValue;
                            $grandTotal = $listingPrice - $discountAmount;
                        }
                        ?>
                    <?php endif; ?>

                    <hr>
                    <p class="fs-5">
                        Final Amount:
                        <strong class="text-success">₹<?= number_format($grandTotal, 2) ?></strong>
                    </p>
                </div>
            </div>
            <a href="<?= base_url('admin/Orders/index/' . $pageno) ?>"
                class="btn btn-primary mt-2 w-25 float-right">
                ← Back
            </a>
        </div>
    </div>

</div>