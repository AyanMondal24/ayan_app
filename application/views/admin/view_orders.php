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
                <!-- <div class="row mb-3"> -->
                <div class="col-md-3">
                    <select id="filterBy" class="form-select" name="filterBy">
                        <option value="">-- Select Filter --</option>
                        <option value="order_number">Order No</option>
                        <option value="customer">Customer</option>
                        <option value="total_items">Total Items</option>
                        <option value="final_amount">Amount</option>
                        <option value="order_status">Order Status</option>
                        <option value="payment_status">Payment Status</option>
                        <option value="order_date">Order Date</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="filterValue" class="form-select" name="filterValue" disabled>
                        <option value="">-- Select Value --</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button id="applyFilter" class="btn btn-primary w-100" disabled>
                        Apply
                    </button>
                </div>
                <!-- </div> -->

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

                                    <?php
                                    switch (strtolower($order->order_status)) {
                                        case 'pending':
                                            $badgeClass = 'bg-warning';   // yellow
                                            break;

                                        case 'confirmed':
                                            $badgeClass = 'bg-primary';   // blue
                                            break;

                                        case 'delivered':
                                            $badgeClass = 'bg-success';   // green
                                            break;

                                        case 'cancelled':
                                            $badgeClass = 'bg-danger';    // red
                                            break;

                                        default:
                                            $badgeClass = 'bg-secondary'; // gray
                                    }
                                    ?>

                                    <td>
                                        <span class="badge <?= $badgeClass ?>">
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
        let urlSegments = window.location.pathname.split('/');
        let pageNumber = parseInt(urlSegments[urlSegments.length - 1]) || 1;
        let per_page = 6;
        let offset = (pageNumber - 1) * per_page;
        loadTable(offset);

        let currentSearch = '';
        // search 
        document.getElementById('tableSearch').addEventListener('keyup', function() {
            currentSearch = this.value.toLowerCase();
            let offset = 0;
            let filterBy = $("#filterBy").val();
            let filterValue = $("#filterValue").val();
            loadTable(offset, currentSearch, filterBy, filterValue);
        });

        // pagination 
        $(".pagination").on('click', 'a', function(e) {
            e.preventDefault();
            const href = $(this).attr("href");

            let page_number = $(this).attr('data-ci-pagination-page');
            let per_page = 6;
            let offset = (page_number - 1) * per_page;

            // Update browser URL with page number
            let newUrl = "<?= base_url('admin/Orders/index/') ?>" + page_number;
            window.history.replaceState({}, document.title, newUrl);

            let filterBy = $("#filterBy").val();
            let filterValue = $("#filterValue").val();
            loadTable(offset, currentSearch, filterBy, filterValue);
        });

        //sorting
        $("#filterBy").on('change', function(e) {
            e.preventDefault();
            let selectedFilter = $(this).val();

            if (!selectedFilter) return;
            $.ajax({
                url: "<?= base_url('admin/orders/set_select/') ?>",
                type: "POST",
                data: {
                    select: selectedFilter
                },
                dataType: "JSON",
                success: function(response) {
                    let $filterValue = $("#filterValue");
                    let $applyFilter = $("#applyFilter");
                    $filterValue.empty();
                    // $filterValue.append('<option value="">-- Select Value --</option>');
                    if (response.selected && response.selected.length > 0) {
                        response.selected.forEach(function(element) {
                            $filterValue.append(`
                        <option value="${element.value}">
                            ${element.label}
                        </option>
                    `);
                        });

                        $filterValue.prop('disabled', false);
                        $applyFilter.prop('disabled', false);
                    } else {
                        $filterValue.prop('disabled', true);
                        $applyFilter.prop('disabled', true);

                    }
                }
            });

        });

        // filter apply btn clicked
        $("#applyFilter").on('click', function() {

            let filterBy = $("#filterBy").val();
            let filterValue = $("#filterValue").val();

            loadTable(0, currentSearch, filterBy, filterValue);
        });

    }); // main 


    function loadTable(offset, search = '', filterBy = '', filterValue = '') {
        $.ajax({
            url: '<?= base_url('admin/Orders/index/') ?>',
            type: "POST",
            data: {
                offset: offset,
                search: search,
                filterBy: filterBy,
                filterValue: filterValue
            },
            dataType: "JSON",
            success: function(response) {
                set_page(response)
            }
        });
    }

    function set_page(response) {
        let html = "";
        const BASE_URL = "<?= base_url() ?>";
        
        if (response.orders.length > 0) {
            $(".pagination").show();

            let index = response.offset + 1;

            $.each(response.orders, function(i, order) {
              

                let orderNo = order.order_number ? order.order_number : "#" + order.order_id;

                let paymentStatusClass =
                    order.payment_status === "paid" ? "bg-success" : "bg-warning";

                 let orderStatusClass = getOrderStatusClass(order.order_status);

                let paymentMethod = order.payment_method ?
                    order.payment_method.charAt(0).toUpperCase() + order.payment_method.slice(1) :
                    'N/A';

                html += `
                <tr>
                    <td>${index++}</td>
                    <td>${orderNo}</td>
                    <td>${order.customer_name ?? 'Guest'}</td>
                    <td>${order.total_items}</td>
                    <td>₹${parseFloat(order.total_amount).toFixed(2)}</td>
                    <td>₹${parseFloat(order.coupon_discount).toFixed(2)}</td>
                    <td><strong>₹${parseFloat(order.final_amount).toFixed(2)}</strong></td>

                    <td>
                    <span class="badge bg-info">${paymentMethod}</span>

                    </td>

                    <td>
                        <span class="badge ${paymentStatusClass}">
                            ${order.payment_status.charAt(0).toUpperCase() + order.payment_status.slice(1)}
                        </span>
                    </td>

                    <td>
                        <span class="badge ${orderStatusClass}">
                            ${order.order_status.charAt(0).toUpperCase() + order.order_status.slice(1)}
                        </span>
                    </td>

                    <td>${formatDate(order.created_at)}</td>

                    <td>
                        <a href="${BASE_URL}admin/orders/view/${order.enc_order_id}?pageno=${response.pageno}" 
                           class="btn btn-sm btn-primary">
                            View
                        </a>
                    </td>
                </tr>
            `;
            });

        } else {
            html = `
            <tr>
                <td colspan="12" class="text-center text-danger">
                    No orders found
                </td>
            </tr>
        `;
            $(".pagination").hide();
        }

        $("#order-tbody").html(html);

        // update pagination

        if (response.total_rows <= 6) {
            $(".pagination").hide();
        } else {
            $(".pagination").html(response.links).show();
        }

    }

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        return d.toLocaleDateString('en-IN', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }

    function getOrderStatusClass(status) {
    switch (status.toLowerCase()) {
        case 'pending':
            return 'bg-warning';
        case 'confirmed':
            return 'bg-primary';
        case 'delivered':
            return 'bg-success';
        case 'cancelled':
            return 'bg-danger';
        default:
            return 'bg-secondary';
    }
}

</script>