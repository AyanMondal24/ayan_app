<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">All Orders</h5>
        </div>


        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="tableSearch" class="form-control"
                        placeholder="Search orders...">
                </div>
            </div>
            <div class="table-responsive orders-table-wrapper">

                <table class="table table-bordered table-hover text-center align-middle" id="ordersTable">
                    <thead class="table-dark">
                        <tr>
                            <th data-column="0" class="sortable">#</th>
                            <th data-column="1" class="sortable">Order No</th>
                            <th data-column="2" class="sortable">Customer</th>
                            <th data-column="3" class="sortable">Total Items</th>
                            <th data-column="4" class="sortable">Total Amount</th>
                            <th data-column="5" class="sortable">Discount</th>
                            <th data-column="6" class="sortable">Final Amount</th>
                            <th>Payment</th>
                            <th>Pay Status</th>
                            <th>Order Status</th>
                            <th data-column="10" class="sortable">Order Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody id="order-tbody">
                        <?php if (!empty($orders)) : ?>
                            <?php $i = 1;
                            foreach ($orders as $order) :
                                $order_id = urlencode(base64_encode($this->encryption->encrypt($order->order_id)));
                            ?>

                                <tr>
                                    <td><?= $offset++; ?></td>
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
            <?php
            if (!empty($orders)) {
                echo $links;
            }
            ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        /* ===============================
           SEARCH FUNCTION
        ================================*/
        document.getElementById('tableSearch').addEventListener('keyup', function() {
            let searchvalue = this.value.toLowerCase();
            let rows = document.querySelectorAll('#ordersTable tbody tr');

            rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(value) ?
                    '' :
                    'none';
            });

            $.ajax({
                url:'<?= base_url('Orders/index') ?>',
                type:"POST",
                data:{
                    search:searchvalue
                },
                dataType:"JSON",
                success: function(response){
                    // $("#order-tbody"). 
                    // create full page html 
                    
                }
            })
        });

    });
</script>