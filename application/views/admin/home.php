<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Organic Veggies & Fruits</h3>
                </div>
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard v2</li>
                            </ol> -->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Info boxes -->
            <?php
            $totalProducts = $total_products; // from DB COUNT(*)

            if ($totalProducts == 0) {
                $icon = 'bi-box-seam';
            } elseif ($totalProducts <= 50) {
                $icon = 'bi-basket';
            } elseif ($totalProducts <= 200) {
                $icon = 'bi-box';
            } elseif ($totalProducts <= 500) {
                $icon = 'bi-boxes';
            } elseif ($totalProducts <= 1000) {
                $icon = 'bi-truck';
            } else {
                $icon = 'bi-building';
            }
            ?>

            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-primary shadow-sm">
                            <i class="bi <?= $icon ?>"></i>

                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Available Porducts</span>
                            <span class="info-box-number">
                                <?= $total_products ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-danger shadow-sm">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- fix for small devices only -->
                <!-- <div class="clearfix hidden-md-up"></div> -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm">
                            <i class="bi bi-cart-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number"><?= $total_orders ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">New Members</span>
                            <span class="info-box-number"><?= $members ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Monthly Recap Report</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <div class="btn-group">
                                    <button
                                        type="button"
                                        class="btn btn-tool dropdown-toggle"
                                        data-bs-toggle="dropdown">
                                        <i class="bi bi-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" role="menu">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item"> Something else here </a>
                                        <a class="dropdown-divider"></a>
                                        <a href="#" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center">
                                        <strong>Sales: 1 Jan, 2023 - 30 Jul, 2023</strong>
                                    </p>
                                    <div id="sales-chart"></div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <p class="text-center"><strong>Goal Completion</strong></p>
                                    <div class="progress-group">
                                        Add Products to Cart
                                        <span class="float-end"><b>160</b>/200</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar text-bg-primary" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        Complete Purchase
                                        <span class="float-end"><b>310</b>/400</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar text-bg-danger" style="width: 75%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">Visit Premium Page</span>
                                        <span class="float-end"><b>480</b>/800</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar text-bg-success" style="width: 60%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        Send Inquiries
                                        <span class="float-end"><b>250</b>/500</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar text-bg-warning" style="width: 50%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-md-3 col-6">
                                    <div class="text-center border-end">
                                        <span class="text-success">
                                            <i class="bi bi-caret-up-fill"></i> 17%
                                        </span>
                                        <h5 class="fw-bold mb-0">$35,210.43</h5>
                                        <span class="text-uppercase">TOTAL REVENUE</span>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-6">
                                    <div class="text-center border-end">
                                        <span class="text-info"> <i class="bi bi-caret-left-fill"></i> 0% </span>
                                        <h5 class="fw-bold mb-0">$10,390.90</h5>
                                        <span class="text-uppercase">TOTAL COST</span>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-6">
                                    <div class="text-center border-end">
                                        <span class="text-success">
                                            <i class="bi bi-caret-up-fill"></i> 20%
                                        </span>
                                        <h5 class="fw-bold mb-0">$24,813.53</h5>
                                        <span class="text-uppercase">TOTAL PROFIT</span>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-6">
                                    <div class="text-center">
                                        <span class="text-danger">
                                            <i class="bi bi-caret-down-fill"></i> 18%
                                        </span>
                                        <h5 class="fw-bold mb-0">1200</h5>
                                        <span class="text-uppercase">GOAL COMPLETIONS</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <!-- Start col -->
                <div class="col-md-8">
                    <!--begin::Row-->
                    <div class="row g-4 mb-4">
                        <div class="col-md-7">
                            <!-- DIRECT CHAT -->
                            <div class="card direct-chat direct-chat-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Direct Chat</h3>
                                    <div class="card-tools">
                                        <span title="3 New Messages" class="badge text-bg-warning"> 3 </span>
                                        <button
                                            type="button"
                                            class="btn btn-tool"
                                            data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-tool"
                                            title="Contacts"
                                            data-lte-toggle="chat-pane">
                                            <i class="bi bi-chat-text-fill"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages">
                                        <!-- Message. Default to the start -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-start"> Alexander Pierce </span>
                                                <span class="direct-chat-timestamp float-end"> 23 Jan 2:00 pm </span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img
                                                class="direct-chat-img"
                                                src="<?= base_url('assets/admin/') ?>img/user1-128x128.jpg"
                                                alt="message user image" />
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                Is this template really for free? That's unbelievable!
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                        <!-- Message to the end -->
                                        <div class="direct-chat-msg end">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-end"> Sarah Bullock </span>
                                                <span class="direct-chat-timestamp float-start">
                                                    23 Jan 2:05 pm
                                                </span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img
                                                class="direct-chat-img"
                                                src="<?= base_url('assets/admin/') ?>img/user3-128x128.jpg"
                                                alt="message user image" />
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">You better believe it!</div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                        <!-- Message. Default to the start -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-start"> Alexander Pierce </span>
                                                <span class="direct-chat-timestamp float-end"> 23 Jan 5:37 pm </span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img
                                                class="direct-chat-img"
                                                src="<?= base_url('assets/admin/') ?>img/user1-128x128.jpg"
                                                alt="message user image" />
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                Working with AdminLTE on a great new app! Wanna join?
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                        <!-- Message to the end -->
                                        <div class="direct-chat-msg end">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-end"> Sarah Bullock </span>
                                                <span class="direct-chat-timestamp float-start">
                                                    23 Jan 6:10 pm
                                                </span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img
                                                class="direct-chat-img"
                                                src="<?= base_url('assets/admin/') ?>img/user3-128x128.jpg"
                                                alt="message user image" />
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">I would love to.</div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                    </div>
                                    <!-- /.direct-chat-messages-->
                                    <!-- Contacts are loaded here -->
                                    <div class="direct-chat-contacts">
                                        <ul class="contacts-list">
                                            <li>
                                                <a href="#">
                                                    <img
                                                        class="contacts-list-img"
                                                        src="<?= base_url('assets/admin/') ?>img/user1-128x128.jpg"
                                                        alt="User Avatar" />
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Count Dracula
                                                            <small class="contacts-list-date float-end"> 2/28/2023 </small>
                                                        </span>
                                                        <span class="contacts-list-msg">
                                                            How have you been? I was...
                                                        </span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img
                                                        class="contacts-list-img"
                                                        src="<?= base_url('assets/admin/') ?>img/user7-128x128.jpg"
                                                        alt="User Avatar" />
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Sarah Doe
                                                            <small class="contacts-list-date float-end"> 2/23/2023 </small>
                                                        </span>
                                                        <span class="contacts-list-msg"> I will be waiting for... </span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img
                                                        class="contacts-list-img"
                                                        src="<?= base_url('assets/admin/') ?>img/user3-128x128.jpg"
                                                        alt="User Avatar" />
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Nadia Jolie
                                                            <small class="contacts-list-date float-end"> 2/20/2023 </small>
                                                        </span>
                                                        <span class="contacts-list-msg"> I'll call you back at... </span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img
                                                        class="contacts-list-img"
                                                        src="<?= base_url('assets/admin/') ?>img/user5-128x128.jpg"
                                                        alt="User Avatar" />
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Nora S. Vans
                                                            <small class="contacts-list-date float-end"> 2/10/2023 </small>
                                                        </span>
                                                        <span class="contacts-list-msg"> Where is your new... </span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img
                                                        class="contacts-list-img"
                                                        src="<?= base_url('assets/admin/') ?>img/user6-128x128.jpg"
                                                        alt="User Avatar" />
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            John K.
                                                            <small class="contacts-list-date float-end"> 1/27/2023 </small>
                                                        </span>
                                                        <span class="contacts-list-msg"> Can I take a look at... </span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img
                                                        class="contacts-list-img"
                                                        src="<?= base_url('assets/admin/') ?>img/user8-128x128.jpg"
                                                        alt="User Avatar" />
                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Kenneth M.
                                                            <small class="contacts-list-date float-end"> 1/4/2023 </small>
                                                        </span>
                                                        <span class="contacts-list-msg"> Never mind I found... </span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                        </ul>
                                        <!-- /.contacts-list -->
                                    </div>
                                    <!-- /.direct-chat-pane -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                name="message"
                                                placeholder="Type Message ..."
                                                class="form-control" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-warning">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!-- /.direct-chat -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-5">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Latest Members</h3>
                                    <div class="card-tools">
                                        <!-- <span class="badge text-bg-danger"> 8 New Members </span> -->
                                        <button
                                            type="button"
                                            class="btn btn-tool"
                                            data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="row text-center m-1">
                                        <div class="col-3 p-2">
                                            <table class="table table-hover align-middle mb-0" style="width: 100% !important;">
                                                <thead class="table-light w-100">
                                                    <tr>
                                                        <th style="width: 5px !important;">User</th>
                                                        <th>Name</th>
                                                        <th style="width: 20px !important;">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($latest_users)) {
                                                        foreach ($latest_users as $user) {
                                                            $created = strtotime($user->created_at);
                                                            $today = strtotime(date('Y-m-d'));
                                                            $yesterday = strtotime(date('Y-m-d', strtotime('-1 day')));

                                                            if (date('Y-m-d', $created) == date('Y-m-d', $today)) {
                                                                $date = 'Today';
                                                            } elseif (date('Y-m-d', $created) == date('Y-m-d', $yesterday)) {
                                                                $date = 'Yesterday';
                                                            } else {
                                                                $date = date('d M', $created); // 12 Jan
                                                            }
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <i class="fa-solid fa-user"></i>
                                                                </td>
                                                                <td><?= ucfirst($user->fname) . " " . ucfirst($user->lname) ?></td>

                                                                <td><?= $date ?></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                    <!-- User without image -->


                                                    <!-- User with image -->

                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a
                                        href="<?= base_url('admin/Users/index')  ?>"
                                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View All Users</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                    <!--begin::Latest Order Widget-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Orders</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Item</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($orders)) {
                                            foreach ($orders as $order) {
                                                $enc_id = urlencode(base64_encode($this->encryption->encrypt($order->order_id)));
                                                if ($order->order_status == 'cancelled') {
                                                    $change_badge = 'text-bg-danger';
                                                } elseif ($order->order_status == 'confirmed') {
                                                    $change_badge = 'text-bg-success';
                                                } else {
                                                    $change_badge = 'text-bg-primary';
                                                }
                                        ?>
                                                <tr>
                                                    <td>
                                                        <a
                                                            href="<?= base_url('pdf/index/' . $enc_id) ?>"
                                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><?= $order->order_number ?></a>
                                                    </td>
                                                    <td><?= $order->products ?></td>
                                                    <td><span class="badge <?= $change_badge ?>"> <?= $order->order_status ?> </span></td>
                                                </tr>
                                        <?php  }
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-primary float-start">
                                Place New Order
                            </a> -->
                            <a href="<?= base_url('admin/orders/index') ?>" class="btn btn-sm btn-secondary float-end">
                                View All Orders
                            </a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <!-- Info Boxes Style 2 -->
                    <!-- <div class="info-box mb-3 text-bg-warning">
                        <span class="info-box-icon"> <i class="bi bi-tag-fill"></i> </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Inventory</span>
                            <span class="info-box-number">5,200</span>
                        </div>
                    </div> -->
                    <!-- /.info-box -->
                    <!-- <div class="info-box mb-3 text-bg-success">
                        <span class="info-box-icon"> <i class="bi bi-heart-fill"></i> </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mentions</span>
                            <span class="info-box-number">92,050</span>
                        </div>
                    </div> -->
                    <!-- /.info-box -->
                    <!-- <div class="info-box mb-3 text-bg-danger">
                        <span class="info-box-icon"> <i class="bi bi-cloud-download"></i> </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Downloads</span>
                            <span class="info-box-number">114,381</span>
                        </div>
                    </div> -->
                    <!-- /.info-box -->
                    <!-- <div class="info-box mb-3 text-bg-info">
                        <span class="info-box-icon"> <i class="bi bi-chat-fill"></i> </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Direct Messages</span>
                            <span class="info-box-number">163,921</span>
                        </div>
                    </div> -->

                    <!-- /.info-box -->

                    <!-- /.card -->
                    <!-- PRODUCT LIST -->
                    <div class="card" >
                        <div class="card-header">
                            <h3 class="card-title">Recently Added Products</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="px-2">
                                <?php
                                if (!empty($products)) {
                                    foreach ($products as $product) {
                                        $limit = 50;
                                        $desc = strip_tags($product->description);

                                        $shortDesc = (strlen($desc) > $limit)
                                            ? substr($desc, 0, $limit) . '...'
                                            : $desc;
                                ?>
                                        <div class="row border-top py-2 px-1 align-items-start">

                                            <div class="col-2">
                                                <img
                                                    src="<?= base_url('assets/uploads/products/thumb/' . $product->image) ?>"
                                                    alt="<?= $product->alt_text ?>"
                                                    class="img-size-50" />
                                            </div>
                                            <div class="col-10">
                                                <a href="javascript:void(0)" class="fw-bold">
                                                    <?= $product->product_name ?>
                                                    <span class="badge text-bg-warning float-end">
                                                        ₹<?= number_format((float)$product->price, 2) ?>
                                                    </span>

                                                </a>
                                                <div class="text-truncate"><?= $shortDesc  ?></div>
                                                <!-- <div class="text-truncate">Samsung 32" 1080p 60Hz LED Smart HDTV.</div> -->
                                            </div>
                                        </div>
                                <?php    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="<?= base_url('admin/product/index') ?>" class="uppercase"> View All Products </a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->
