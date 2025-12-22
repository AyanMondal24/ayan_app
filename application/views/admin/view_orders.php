<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">All Orders</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>Total Items</th>
                            <th>Total Amount</th>
                            <th>Discount</th>
                            <th>Final Amount</th>
                            <th>Payment</th>
                            <th>Pay Status</th>
                            <th>Order Status</th>
                            <th>Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($orders)) : ?>
                            <?php $i = 1;
                            foreach ($orders as $order) : 
                            $order_id=urlencode(base64_encode($this->encryption->encrypt($order->order_id)));
                            ?>
                            
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $order->order_number ?: '#' . $order->order_id; ?></td>
                                    <td><?= $order->customer_name ?? 'Guest'; ?></td>
                                    <td><?= $order->total_items; ?></td>
                                    <td>₹<?= number_format($order->total_amount, 2); ?></td>
                                    <td>₹<?= number_format($order->coupon_discount, 2); ?></td>
                                    <td><strong>₹<?= number_format($order->final_amount, 2); ?></strong></td>

                                    <td>
                                        <span class="badge bg-info">
                                            <?= ucfirst($order->payment_method); ?>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge 
                                            <?= $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning'; ?>">
                                            <?= ucfirst($order->payment_status); ?>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge 
                                            <?= $order->order_status == 'delivered' ? 'bg-success' : 'bg-secondary'; ?>">
                                            <?= ucfirst($order->order_status); ?>
                                        </span>
                                    </td>

                                    <td><?= date('d M Y', strtotime($order->created_at)); ?></td>

                                    <td>
                                        <a href="<?= base_url('admin/orders/view/' . $order_id); ?>"
                                            class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="12" class="text-center text-danger">
                                    No orders found
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>