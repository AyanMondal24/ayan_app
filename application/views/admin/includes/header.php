<?php
$CI = &get_instance();
$CI->load->model('admin_model');

$admin = null;
if ($CI->session->userdata('admin_logged_in')) {
    $admin = $CI->admin_model->getAdminById(
        $CI->session->userdata('admin_id')
    );
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Organic Veggies & Fruits</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <!-- <meta name="title" content="AdminLTE | Dashboard v2" /> -->
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <!-- ==========================
     1️⃣ CORE FRAMEWORKS
========================== -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
    <link rel="preload" href="<?= base_url('assets/admin/css/adminlte.css') ?>" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
        media="print"
        onload="this.media='all'" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/adminlte.css') ?>" />
    <!--end::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/style.css') ?>">
    <!-- my css  -->
    <!-- apexcharts -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
        crossorigin="anonymous" />


</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand  bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <!-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li> -->
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Navbar Search-->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>
                    <!--end::Navbar Search-->
                    <!--begin::Messages Dropdown Menu-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-chat-text"></i>
                            <span class="navbar-badge badge text-bg-danger">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img
                                            src="<?= base_url('assets/admin/') ?>img/user1-128x128.jpg"
                                            alt="User Avatar"
                                            class="img-size-50 rounded-circle me-3" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-end fs-7 text-danger"><i class="bi bi-star-fill"></i></span>
                                        </h3>
                                        <p class="fs-7">Call me whenever you can...</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img
                                            src="<?= base_url('assets/admin/') ?>img/user8-128x128.jpg"
                                            alt="User Avatar"
                                            class="img-size-50 rounded-circle me-3" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-end fs-7 text-secondary">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                        </h3>
                                        <p class="fs-7">I got your message bro</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img
                                            src="<?= base_url('assets/admin/') ?>img/user3-128x128.jpg"
                                            alt="User Avatar"
                                            class="img-size-50 rounded-circle me-3" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-end fs-7 text-warning">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                        </h3>
                                        <p class="fs-7">The subject goes here</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <!--end::Messages Dropdown Menu-->
                    <!--begin::Notifications Dropdown Menu-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-bell-fill"></i>
                            <span class="navbar-badge badge text-bg-warning">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-envelope me-2"></i> 4 new messages
                                <span class="float-end text-secondary fs-7">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-people-fill me-2"></i> 8 friend requests
                                <span class="float-end text-secondary fs-7">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                                <span class="float-end text-secondary fs-7">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                        </div>
                    </li>
                    <!--end::Notifications Dropdown Menu-->
                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!-- <?php if ($this->session->userdata('admin_logged_in')): ?>
                        <a href="<?= base_url('admin/Auth/logout') ?>" class="btn btn-primary btn-flat float-end">Logout</a>
                    <?php endif; ?> -->
                    <?php if ($admin): ?>
                        <li class="nav-item dropdown user-menu">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="<?= base_url('assets/uploads/admin_img/' . ($admin->image ?? 'default.png')); ?>"
                                    class="user-image rounded-circle shadow" alt="User Image">
                                <span class="d-none d-md-inline">
                                    <?= $admin->fname . ' ' . $admin->lname ?>
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <li class="user-header text-bg-primary">
                                    <img src="<?= base_url('assets/uploads/admin_img/' . ($admin->image ?? 'default.png')); ?>"
                                        class="rounded-circle shadow" alt="User Image">
                                    <p>
                                        <?= $admin->fname . ' ' . $admin->lname ?>
                                        - <?= ucfirst($CI->session->userdata('role')) ?>
                                        <small>
                                            Member since <?= date("M, Y", strtotime($admin->created_at)) ?>
                                        </small>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <a href="<?= base_url('profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                    <a href="<?= base_url('admin/Auth/logout') ?>"
                                        class="btn btn-default btn-flat float-end">Logout</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>



                    <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="<?= site_url('assets/admin') ?>/index.html" class="brand-link">
                    <!--begin::Brand Image-->
                    <img
                        src="<?= base_url('assets/admin/') ?>img/AdminLTELogo.png"
                        alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-light">AdminLTE 4</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul
                        class="nav sidebar-menu flex-column"
                        data-lte-toggle="treeview"
                        role="navigation"
                        aria-label="Main navigation"
                        data-accordion="false"
                        id="navigation">
                        <li class="nav-item menu-open">
                            <a href="<?= base_url('/admin') ?>" class="nav-link active">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Dashboard
                                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                                </p>
                            </a>


                            <!-- product section start  -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-seam-fill"></i>
                                <p>
                                    Products
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/Product/add') ?>" class="nav-link">
                                        <i class="bi bi-plus-circle-fill"></i>
                                        <p>Add Products</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/Product') ?>" class="nav-link">
                                        <i class="bi bi-eye-fill"></i>
                                        <p>View Products</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- product section end  -->

                        <!-- product CATEGORY section start  -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>
                                    Products Category
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/Category/add') ?>" class="nav-link">
                                        <i class="bi bi-plus-circle-fill"></i>
                                        <p>Add Catgeory</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/Category') ?>" class="nav-link">
                                        <i class="bi bi-eye-fill"></i>
                                        <p>View Category</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- product CATEGORY section end  -->
                        <!-- product unit section start  -->

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-rulers"></i>
                                <p>
                                    Products Unit
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/Units/add') ?>" class="nav-link">
                                        <i class="bi bi-plus-circle-fill"></i>
                                        <p>Add Product Unit</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/Units') ?>" class="nav-link">
                                        <i class="bi bi-eye-fill"></i>
                                        <p>View Product Unit</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- product unit section end  -->

                        <!-- coupon section start  -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-ticket-perforated"></i>
                                <p>
                                    Coupon
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/Coupons/add') ?>" class="nav-link">
                                        <i class="bi bi-plus-circle-fill"></i>
                                        <p>Add Coupon</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/Coupons') ?>" class="nav-link">
                                        <i class="bi bi-eye-fill"></i>
                                        <p>View Coupon</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- coupon section end  -->

                        <!-- order section  -->
                        <li class="nav-item">
                            <a href="<?= base_url('admin/Orders/index') ?>" class="nav-link">
                                <i class="nav-icon bi bi-cart-check"></i>
                                <p>
                                    Orders
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/Users/index') ?>" class="nav-link">
                                <i class="nav-icon bi bi-person"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
