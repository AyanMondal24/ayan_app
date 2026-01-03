<div class="container-fluid mt-2">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">All Orders</h5>
        </div>

        <div class="card-body">
            <div class="row mb-3 align-items-center g-2">

                <!-- LEFT: Entries per page -->
                <div class="col-auto d-flex align-items-center gap-2">
                    <select
                        class="form-select form-select-sm w-auto"
                        id="entriesSelect">

                    </select>
                    <span class="small">entries per page</span>
                </div>

                <!-- RIGHT GROUP -->
                <div class="col ms-auto">
                    <div class="row g-2 justify-content-end">

                        <!-- Filter by -->
                        <div class="col-auto">
                            <select
                                id="filterBy"
                                class="form-select form-select-sm"
                                style="min-width: 170px;">
                                <option value="">-- Select Filter --</option>
                                <option value="order_status">Order Status</option>
                                <option value="payment_status">Payment Status</option>
                            </select>
                        </div>

                        <!-- Filter value -->
                        <div class="col-auto">
                            <select
                                id="filterValue"
                                class="form-select form-select-sm"
                                style="min-width: 170px;"
                                disabled>
                                <option value="">-- Select Value --</option>
                            </select>
                        </div>

                        <!-- Search -->
                        <div class="col-auto">
                            <input
                                type="text"
                                id="tableSearch"
                                class="form-control form-control-sm"
                                placeholder="Search orders..."
                                style="min-width: 220px;">
                        </div>

                    </div>
                </div>

            </div>


            <div class="table-responsive orders-table-wrapper">
                <table class="table table-bordered table-hover text-center align-middle" id="ordersTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="sortable col-id" data-column="id" style="width: 20px;">#</th>
                            <th>Order No</th>
                            <th class="sortable" data-column="customer">Customer</th>
                            <th class="sortable" data-column="total_item">Total Items</th>
                            <th class="sortable" data-column="total_amount">Total Amount</th>
                            <th class="sortable" data-column="discount">Discount</th>
                            <th class="sortable" data-column="final_amount">Final Amount</th>
                            <th>Payment</th>
                            <th>Pay Status</th>
                            <th>Order Status</th>
                            <th class="sortable" data-column="created_at">Order Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody id="order-tbody">
                        <tr>
                            <td colspan="12" class="text-center text-muted">
                                Loading orders...
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <div class="d-flex justify-content-between align-items-end">
                <div id="showing-entries" class="fs-6 text-black text-start small">
                    <!-- Showing text will come here -->
                </div>
                <div id="pagination-container">
                    <!-- pagination links -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        let currentSearch = '';
        let pageno = 1;
        let filterBy = '';
        let filterValue = '';

        let sortOrder = 'desc'; // ✅ default DESC
        let sortColumn = 'id'; // ✅ default column

        let per_page = 5;

        // get entries per page
        $.ajax({
            url: "<?= base_url('admin/Orders/getEntriesPerPage') ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    const total = parseInt(response.total);
                    const entriesSelect = $("#entriesSelect");

                    let options = '';
                    const baseOptions = [5, 10, 25, 50, 100];

                    baseOptions.forEach(function(val) {
                        if (val < total) {
                            options += `<option value="${val}">${val}</option>`;
                        }
                    });

                    // add total as last option
                    options += `<option value="${total}">${total}</option>`;

                    entriesSelect.html(options);
                    loadTable(pageno, currentSearch, filterBy, filterValue, sortOrder, sortColumn, per_page);
                }
            }
        });
        // per page
        $("#entriesSelect").on('change', function(e) {
            e.preventDefault();
            per_page = $(this).val();
            loadTable(pageno, currentSearch, filterBy, filterValue, sortOrder, sortColumn, per_page);

        });
        // sorting
        $("th.sortable").on('click', function(e) {
            e.preventDefault();
            const column = $(this).data('column');
            if (sortColumn === column) {
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = column;
                sortOrder = 'asc';
            }
            $('th.sortable').removeClass('asc desc');
            $(this).addClass(sortOrder);
            loadTable(pageno, currentSearch, filterBy, filterValue, sortOrder, sortColumn, per_page);
        });
        // search
        document.getElementById('tableSearch').addEventListener('keyup', function() {
            currentSearch = this.value.toLowerCase();
            pageno = 1;
            filterBy = $("#filterBy").val();
            filterValue = $("#filterValue").val();
            loadTable(pageno, currentSearch, filterBy, filterValue, sortOrder, sortColumn, per_page);
        });

        // pagination
        $(document).on('click', '#pagination-container a', function(e) {
            e.preventDefault();
            pageno = $(this).data("id");
            search = $('#tableSearch').val();
            filterBy = $('#filterBy').val();
            filterValue = $('#filterValue').val();
            loadTable(pageno, currentSearch, filterBy, filterValue, sortOrder, sortColumn, per_page);
        });

        //filter
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
        $("#filterValue").on('change', function() {

            let filterBy = $("#filterBy").val();
            let filterValue = $(this).val();

            loadTable(1, currentSearch, filterBy, filterValue, sortOrder, sortColumn, per_page);
        });

        loadTable(pageno, currentSearch, filterBy, filterValue, sortOrder, sortColumn, per_page);

    }); // main

    function loadTable(pageno = 1, search = '', filterBy = '', filterValue = '', sortOrder = '', sortColumn = '', per_page = 5) {
        per_page = parseInt(per_page) || 5;

        $.ajax({
            url: '<?= base_url('admin/Orders/index/') ?>',
            type: "POST",
            data: {
                pageno: pageno,
                search: search,
                filterBy: filterBy,
                filterValue: filterValue,
                sortOrder: sortOrder,
                sortColumn: sortColumn,
                per_page: per_page,
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
        // console.log(response.sortOrder)
        // console.log(response.sortColumn)

        if (response.orders.length > 0) {

            let index;
            const total = parseInt(response.total_item);
            const offset = parseInt(response.offset);
            const perPage = parseInt(response.per_page);

            let sortOrder = response.sortOrder ?? 'desc'; // default DESC

            if (sortOrder === 'desc') {
                index = total - offset;
                start = total - offset;
                end = Math.max(total - (offset + perPage) + 1, 1);
            } else {
                index = offset + 1;
                start = offset + 1;
                end = Math.min(offset + perPage, total);
            }
            end = Math.min(offset + perPage, total);

            $('#showing-entries').text(
                `Showing ${index} to ${end} of ${total} entries`
            );

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
                   <td>${response.sortOrder === 'desc' ? index-- : index++}</td>
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

            $("#pagination-container").html(response.pagination);
        } else {
            html = `
            <tr>
                <td colspan="12" class="text-center text-danger">
                    No orders found
                </td>
            </tr>
        `;
            $("#pagination-container").html('');

        }

        $("#order-tbody").html(html);

        // update pagination


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
