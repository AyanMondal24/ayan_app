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
                    <!-- <a href="<?= base_url('Profile/index') ?>" class="menu-link"> -->
                    <a href="#profile" class="menu-link" id="profileMenu">
                        <span class="icon">👤</span>
                        <span class="text">My Profile</span>
                    </a>
                </li>

                <li class="<?= ($this->uri->segment(1) == 'Profile' && $this->uri->segment(2) == 'Orders') ? 'active' : '' ?>">
                    <!-- <a href="<?= base_url('Profile/Orders') ?>" class="menu-link"> -->
                    <a href="#orders" class="menu-link" id="ordersMenu">
                        <span class="icon">📦</span>
                        <span class="text">Orders</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('Profile/Addresses') ?>" class="menu-link">
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
                    <a href="<?= base_url('Auth/logout') ?>" class="menu-link">
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
                        <button type="button" class="btn profile-edit-btn" id="editBtn">
                            Edit Profile
                        </button>

                        <button type="submit" class="btn profile-save-btn d-none" id="saveBtn">
                            Save Changes
                        </button>
                    </form>

                    <div id="response-msg" class="text-center py-2"></div>
                </div>

            </div>
        </div>

        <!-- orders  -->
        <div class="profile-orders d-none" id="ordersSection">

            <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : ?>
                    <?php $order_id =urlencode(base64_encode($this->encryption->encrypt($order->order_id))) ?>
                    <div class="order-card">
                        <div class="order-content">

                            <!-- Product Names (COMMA SEPARATED) -->
                            <div class="product-details">
                                <h4><a class="text-dark" href="<?= base_url('Profile/order_details/'.$order_id) ?>"><?= $order->product_names ?></a></h4>
                            </div>

                            <!-- Price -->
                            <div class="product-price">
                                ₹<?= number_format($order->final_amount, 2) ?>
                            </div>

                            <!-- Status -->
                            <div class="delivery-status">
                                <div class="status-line <?= $order->order_status ?>">
                                    <span class="dot"></span>
                                    <strong><?= ucfirst($order->order_status) ?></strong>
                                </div>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else : ?>
                <p>No orders found.</p>
            <?php endif; ?>

        </div>



        <!-- end  -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

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

        const profileSection = document.getElementById('profileSection');
        const ordersSection = document.getElementById('ordersSection');

        function showSection(section) {
            profileSection.classList.add('d-none');
            ordersSection.classList.add('d-none');

            document.querySelectorAll('.menu li').forEach(li => {
                li.classList.remove('active');
            });

            if (section === 'orders') {
                ordersSection.classList.remove('d-none');
                ordersMenu.closest('li').classList.add('active');
            } else {
                profileSection.classList.remove('d-none');
                profileMenu.closest('li').classList.add('active');
            }
        }

        // Click events
        profileMenu.addEventListener('click', () => showSection('profile'));
        ordersMenu.addEventListener('click', () => showSection('orders'));

        // 🔥 ON PAGE LOAD (IMPORTANT)
        const hash = window.location.hash.replace('#', '');
        showSection(hash === 'orders' ? 'orders' : 'profile');
    });
</script>
