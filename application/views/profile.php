<div class="profile-page">
    <div class="container profile">

        <!-- Left Sidebar -->
        <div class="sidebar">
            <div class="user-box">
                <!-- <img src="https://i.pravatar.cc/100" alt="User"> -->
                <i class="fas fa-user"></i>
                <h4>Hello,</h4>
                <p><?= $user->fname . " " . $user->lname ?></p>
            </div>

            <ul class="menu">
                <li class="<?= ($this->uri->segment(1) == 'Profile' && $this->uri->segment(2) == 'index') ? 'active' : '' ?>">
                    <a href="#profile" class="menu-link" id="profileMenu">
                        <span class="icon">👤</span>
                        <span class="text">My Profile</span>
                    </a>
                </li>

                <li class="<?= ($this->uri->segment(1) == 'Profile' && $this->uri->segment(2) == 'Orders') ? 'active' : '' ?>">
                    <a href="#orders" class="menu-link" id="ordersMenu">
                        <span class="icon">📦</span>
                        <span class="text">Orders</span>
                    </a>
                </li>

                <li class="<?= ($this->uri->segment(1) == 'Profile' && $this->uri->segment(2) == 'Address') ? 'active' : '' ?>">
                    <a href="#address" class="menu-link" id="addressMenu" class="menu-link">
                        <span class="icon">📍</span>
                        <span class="text">Addresses</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('Profile/Wallet') ?>" class="menu-link">
                        <span class="icon">💰</span>
                        <span class="text">Wallet</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('Profile/Wishlist') ?>" class="menu-link">
                        <span class="icon">❤️</span>
                        <span class="text">Wishlist</span>
                    </a>
                </li>

                <li class="logout">
                    <a href="<?= base_url('logout') ?>" class="menu-link">
                        <span class="icon">🚪</span>
                        <span class="text">Logout</span>
                    </a>
                </li>
            </ul>

        </div>

        <!-- profile -->
        <div class="content profile-section" id="profileSection">
            <div class="content">
                <h2>Personal Information</h2>

                <div class="card">
                    <form method="post" enctype="multipart/form-data" id="edit-user">
                        <div class="form-group row">
                            <label class="pt-4">Full Name</label>

                            <div class="col-md-6 col-sm-12 col-lg-6 error-error">
                                <input type="text"
                                    value="<?= $user->fname ?>"
                                    name="fname"
                                    id="fname"
                                    class="form-control"
                                    readonly>
                                <span class="error" id="fname_error"><?= form_error('fname') ?></span>
                            </div>

                            <div class="col-md-6 col-sm-12 col-lg-6 error-error">
                                <input type="text"
                                    value="<?= $user->lname ?>"
                                    name="lname"
                                    id="lname"
                                    class="form-control"
                                    readonly>

                                <span class="error" id="lname_error"><?= form_error('lname') ?></span>

                            </div>
                        </div>

                        <div class="form-group error-error">
                            <label>Email Address</label>
                            <input type="email"
                                value="<?= $user->email ?>"
                                class="form-control"
                                name="email"
                                id="email"
                                readonly>
                            <span class="error" id="email_error"><?= form_error('email') ?></span>
                        </div>

                        <div class="form-group error-error">
                            <label>Mobile Number</label>
                            <input type="text"
                                value="<?= $user->mobile ?>"
                                name="phone"
                                class="form-control"
                                id="phone"
                                readonly>
                            <span class="error" id="phone_error"><?= form_error('phone') ?></span>

                        </div>

                        <!-- BUTTONS -->
                        <button type="button" class="btn profile-edit-btn profile-btn" id="editBtn">
                            Edit Profile
                        </button>

                        <button type="submit" class="btn profile-save-btn d-none profile-btn" id="saveBtn">
                            Save Changes
                        </button>
                    </form>

                    <div id="response-msg" class="text-center py-2"></div>
                </div>

            </div>
        </div>

        <!-- orders  -->
        <div class="profile-orders d-none" id="ordersSection">

            <?php
            if (!empty($orders)) {

            ?>
                <!-- <div class="row mb-3">
                    <div class="col-md-3 ">
                        <select id="paymentFilter" class="form-select form-select-sm">
                            <option value="">All Payments</option>
                            <option value="Paid">Paid</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select id="statusFilter" class="form-select form-select-sm">
                            <option value="">All Status</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="pending">Pending</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div> -->

                <table class="table table-bordered show-order" id="profile-order-table">
                    <thead class="text-center">
                        <tr>
                            <th class="text-center">Order No</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Items</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Payment</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order):

                            $enc_order_id = urlencode(base64_encode($this->encryption->encrypt($order->order_id)))
                        ?>
                            <tr>
                                <td><?= $order->order_number ?></td>
                                <td data-order="<?= strtotime($order->created_at) ?>">
                                    <?= date('d M Y', strtotime($order->created_at)) ?>
                                </td>

                                <td>
                                    <?php
                                    $products = explode(', ', $order->product_names);   // string → array
                                    $show = array_slice($products, 0, 4);               // take first 4

                                    echo implode(', ', $show);                           // show 4 only

                                    if (count($products) > 4) {
                                        echo ' <span class="text-muted">+' . (count($products) - 4) . ' more</span>';
                                    }
                                    ?>

                                </td>
                                <td data-order="<?= $order->final_amount ?>">
                                    ₹<?= number_format($order->final_amount, 2) ?></td>
                                <td>
                                    <span class="badge bg-<?= $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'cancelled' ? 'danger' : 'warning') ?>">
                                        <?= ucfirst($order->payment_status) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-<?= $order->order_status == 'confirmed' ? 'success' : ($order->order_status == 'cancelled' ? 'danger' : 'warning') ?>">
                                        <?= ucfirst($order->order_status) ?>
                                    </span>
                                </td>

                                <td class="action-button">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="<?= base_url('profile/order/details/' . $enc_order_id) ?>" class="btn btn-sm btn-primary text-light">
                                            Visit
                                        </a>
                                        <?php
                                        if ($order->order_status !== 'cancelled') { ?>
                                            <a href="" class="btn btn-sm btn-danger text-light cancel-btn" data-order-id="<?= $enc_order_id ?>" data-bs-toggle="modal" data-bs-target="#cancelModal">
                                                Cancel
                                            </a>
                                        <?php  }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php } else { ?>
                <p>No orders found.</p>
            <?php  } ?>


        </div>


        <!-- address  -->
        <div class="profile-order d-none w-100" id="addressSection">
            <!-- <div class="container profile-address"> -->
            <div class="address-wrapper">
                <?php
                if (!empty($address)) { ?>


                    <!-- Billing Address -->
                    <div class="address-card">
                        <div class="address-header">
                            <h4>Billing Address</h4>
                            <a href="<?= base_url('profile/order/billing-address') ?>" class="btn-change">
                                Change
                            </a>
                        </div>

                        <div class="address-body">
                            <p class="name"><?= $address->b_fname ?> <?= $address->b_lname ?></p>

                            <p>
                                <?= $address->b_address ?><br>
                                <?= $address->b_landmark ?><br>
                                <?= $address->b_city ?>, <?= $address->b_state ?><br>
                                <?= $address->b_country ?> – <?= $address->b_pin ?>
                            </p>

                            <p class="phone">📞 <?= $address->b_phone ?></p>
                            <p class="email">✉ <?= $address->b_email ?></p>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="address-card">
                        <div class="address-header">
                            <h4>Shipping Address</h4>

                            <?php if (!$address->is_shipping_same): ?>
                                <a href="<?= base_url('profile/order/shipping-address') ?>" class="btn-change">
                                    Change
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="address-body">
                            <?php if ($address->is_shipping_same): ?>
                                <p class="same-text">Same as billing address</p>
                            <?php else: ?>
                                <p class="name"><?= $address->s_fname ?> <?= $address->s_lname ?></p>

                                <p>
                                    <?= $address->s_address ?><br>
                                    <?= $address->s_landmark ?><br>
                                    <?= $address->s_city ?>, <?= $address->s_state ?><br>
                                    <?= $address->s_country ?> – <?= $address->s_pin ?>
                                </p>

                                <p class="phone">📞 <?= $address->s_phone ?></p>
                                <p class="email">✉ <?= $address->s_email ?></p>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php } else { ?>
                    <div class="container py-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="<?= base_url('profile/order/billing-address?profile=profile') ?>" class="btn btn-primary btn-change text-light">
                                Add Address
                            </a>
                        </div>
                    </div>

                <?php }
                ?>

            </div>
            <?php if (!empty($address)) {
                if ($address->is_shipping_same == 0) {
            ?>
                    <div class="mt-2">
                        <button class="btn btn-danger" id="same-as-bill-address" data-id="<?= ($address) ? $address->id : '' ?>">Same as Billing Address</button>
                    </div>
            <?php }
            } ?>
            <!-- </div> -->
        </div>

        <!-- end  -->
    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="cancelModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Do you want to cancel this order?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="confirm-cancel">Yes</button>
                <button type="button" class="btn btn-danger">No</button>
            </div>
            <div id="response"> </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> -->

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // profile
        const fname = document.querySelector('#fname');
        const lname = document.querySelector('#lname');
        const email = document.querySelector('#email');
        const phone = document.querySelector('#phone');
        numberField('#phone', 10, 10, "#phone_error");
        $("#edit-user").on('submit', function(e) {
            e.preventDefault();
            // validate profile
            const fields = [{
                    element: fname,
                    rules: [{
                        rule: "required",
                        message: "First name is required."
                    }],
                    errorSelector: "#fname_error"
                },
                {
                    element: lname,
                    rules: [{
                        rule: "required",
                        message: "Last name required"
                    }],
                    errorSelector: "#lname_error"
                },
                {
                    element: email,
                    rules: [{
                            rule: "required"
                        },
                        {
                            rule: "email",
                            message: "Enter a valid email"
                        }
                    ],
                    errorSelector: "#email_error"
                },
                {
                    element: phone,
                    rules: [{
                            rule: "required"
                        },
                        {
                            rule: "number"
                        },
                        {
                            rule: "min",
                            value: 10,
                            message: "Minimum 10 digits"
                        }
                    ],
                    errorSelector: "#phone_error"
                }
            ];

            let is_validate = validate(fields);
            if (!is_validate) return;


            $.ajax({
                url: "<?= base_url('Profile/user') ?>",
                type: "POST",
                data: $("#edit-user").serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status === 'success') {

                        $('#saveBtn')
                            .prop('disabled', true)
                            .removeClass('btn-primary')
                            .addClass('btn-success')
                            .text('Saved');
                    } else {
                        $.each(response.errors, function(field, msg) {
                            $(`[name="${field}"]`).closest('error-error').find('span.error').html(msg)
                        });
                        $("#response-msg").addClass('error-msg').removeClass('success-msg').html(response.message).fadeIn(200).delay(4000).fadeOut(200);

                    }
                }
            });

        });

        // same - as - bill - address
        $("#same-as-bill-address").on('click',function(e){
            e.preventDefault();
            id=$(this).data('id');
            $.ajax({
                url: "<?= base_url('Profile/is_shipping_same') ?>",
                type:"POST",
                data:{id:id},
                dataType:"JSON",
                success: function(response){
                    if(response.status==='success'){
                        window.location.reload();
                    }else{

                    }
                }
            })
        });

        //edit btn change to save canges
        const editBtn = document.getElementById('editBtn');
        const saveBtn = document.getElementById('saveBtn');
        const inputs = document.querySelectorAll('.card input');

        editBtn.addEventListener('click', function() {
            inputs.forEach(input => {
                if (input.id !== 'email') {
                    input.removeAttribute('readonly');
                }
            });

            editBtn.classList.add('d-none');
            saveBtn.classList.remove('d-none');
        });

        // side bar menu clicked show page view logic

        const profileMenu = document.getElementById('profileMenu');
        const ordersMenu = document.getElementById('ordersMenu');
        const addressMenu = document.getElementById('addressMenu');

        const profileSection = document.getElementById('profileSection');
        const ordersSection = document.getElementById('ordersSection');
        const addressSection = document.getElementById('addressSection');

        function showSection(section) {
            profileSection.classList.add('d-none');
            ordersSection.classList.add('d-none');
            addressSection.classList.add('d-none');

            document.querySelectorAll('.menu li').forEach(li => {
                li.classList.remove('active');
            });

            if (section === 'orders') {
                ordersSection.classList.remove('d-none');
                ordersMenu.closest('li').classList.add('active');
                $("#profile-order-table_wrapper").append(`

                `)
            } else if (section === 'profile') {
                profileSection.classList.remove('d-none');
                profileMenu.closest('li').classList.add('active');
            } else if (section === 'address') {
                addressSection.classList.remove('d-none');
                addressMenu.closest('li').classList.add('active');
            }
        }

        // Click events
        profileMenu.addEventListener('click', () => showSection('profile'));
        ordersMenu.addEventListener('click', () => showSection('orders'));
        addressMenu.addEventListener('click', () => showSection('address'));

        // ON PAGE LOAD (IMPORTANT)
        const hash = window.location.hash.replace('#', '');
        switch (hash) {
            case 'orders':
                showSection('orders');
                break;
            case 'address':
                showSection('address');
                break;
            default:
                showSection('profile'); // FIRST LOAD
        }


        // order cancel btn
        let currentOrderId = null;


        // When a cancel button is clicked

        $(".cancel-btn").on('click', function(e) {
            e.preventDefault();

            currentOrderId = $(this).data('order-id');

            $('#cancelModal').modal('show');

        });


        // When "Yes" is clicked in the modal

        $('#confirm-cancel').on('click', function() {

            if (currentOrderId) {

                $.ajax({

                    url: '<?= base_url("Profile/cancel_order") ?>', // Your backend endpoint (adjust if different)

                    type: 'POST',

                    data: {
                        order_id: currentOrderId
                    }, // Send the order ID
                    dataType: "JSON",
                    success: function(response) {

                        // Handle success (e.g., show a message, reload the page, or update the UI)

                        // alert('Order canceled successfully!'); // Replace with a better notification (e.g., Bootstrap toast)
                        if (response.status === 'success') {
                            $("#response").addClass('success-msg').removeClass('error-msg').html(response.message).fadeIn(200).delay(3000).fadeOut(200);
                            $('#cancelModal').modal('hide'); // Close the modal

                            location.reload(); // Reload the page to reflect changes (or update the table dynamically)
                        } else {
                            $("#response").addClass('error-msg').removeClass('success-msg').html(response.message).fadeIn(200).delay(3000).fadeOut(200);
                        }

                    },

                    error: function(xhr, status, error) {

                        // Handle error

                        // alert('Error canceling order: ' + error); // Replace with better error handling
                        $("#response").addClass('error-msg').removeClass('success-msg').html(error).fadeIn(200).delay(3000).fadeOut(200);

                        $('#cancelModal').modal('hide');

                    }

                });

            }

        });

        // datatble
        // let table = new DataTable('#profile-order-table');
        const totalRows = document.querySelectorAll('#profile-order-table tbody tr').length;

        let lengthMenu = [5, 10, 25];

        if (totalRows <= 10) {
            lengthMenu = [5, totalRows];
        } else if (totalRows <= 25) {
            lengthMenu = [5, 10, totalRows];
        } else if (totalRows <= 50) {
            lengthMenu = [5, 10, 25, totalRows];
        } else {
            lengthMenu = [5, 10, 25, 50, totalRows];
        }

        let table = new DataTable('#profile-order-table', {

            pageLength: lengthMenu[0],
            lengthMenu: lengthMenu,

            order: [
                [1, 'desc']
            ], // Date DESC

            columnDefs: [{
                    targets: [2, 4, 5, 6], // Items & Action
                    orderable: false
                },
                {
                    targets: 3, // Total column (₹ sorting fix)
                    render: function(data, type) {
                        if (type === 'sort' || type === 'type') {
                            return data.replace('₹', '').replace(/,/g, '');
                        }
                        return data;
                    }
                }
            ],

            ordering: true,
            searching: true,
            responsive: true,

            dom: "<'row mb-3 align-items-center'" +
                "<'col-md-4 d-flex align-items-center gap-2'l>" +
                "<'col-md-4 d-flex gap-2 order-filters'>" +
                "<'col-md-4 text-end'f>" +
                ">" +
                "<'row'<'col-12'tr>>" +
                "<'row mt-3'<'col-md-5'i><'col-md-7'p>>",

            language: {
                lengthMenu: "_MENU_ entries per page",
                search: "Search:"
            }
        });

        document.querySelector('.order-filters').innerHTML = `
    <div class="d-flex align-items-center gap-1">
        <select id="paymentFilter" class="form-select form-select-sm">
            <option value="">Payment</option>
            <option value="paid">Paid</option>
            <option value="pending">Pending</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <div class="d-flex align-items-center gap-1">
        <select id="statusFilter" class="form-select form-select-sm">
            <option value="">Status</option>
            <option value="confirmed">Confirmed</option>
            <option value="pending">Pending</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>
`;



        // Payment filter
        document.getElementById('paymentFilter')?.addEventListener('change', function() {
            table.column(4).search(this.value).draw();
        });

        // // Status filter
        document.getElementById('statusFilter')?.addEventListener('change', function() {
            table.column(5).search(this.value).draw();
        });


    });
</script>
