<?php
$cart = $this->session->userdata('cart');
$cart_count = is_array($cart) ? count($cart) : 0;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/lib/lightbox/css/lightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- datatables css  -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <!-- my css  -->
    <link href="<?= base_url('assets/css/myStyle.css') ?>" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="<?= base_url('/') ?>" class="navbar-brand">
                    <h1 class="text-primary display-6">Fruitables</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="<?= base_url() ?>"
                            class="nav-item nav-link <?= ($this->uri->segment(1) == '') ? 'active' : '' ?>">Home</a>

                        <a href="<?= site_url('shop') ?>"
                            class="nav-item nav-link <?= ($this->uri->segment(1) == 'shop') ? 'active' : '' ?>">Shop</a>

                        <!-- <a href="<?= site_url('cart') ?>"
                            class="nav-item nav-link <?= ($this->uri->segment(1) == 'cart') ? 'active' : '' ?>">Shop Cart</a> -->

                        <!-- <a href="<?= site_url('checkout') ?>"
                            class="nav-item nav-link <?= ($this->uri->segment(1) == 'Checkout') ? 'active' : '' ?>">Checkout</a> -->

                        <a href="<?= site_url('contact') ?>"
                            class="nav-item nav-link <?= ($this->uri->segment(1) == 'contact') ? 'active' : '' ?>">Contact</a>
                    </div>

                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        <a href="<?= base_url('cart') ?>" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1 cart-count" id="cart-count" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"><?= $cart_count ?></span>
                        </a>


                        <li class="dropdown-center navbar-icons">
                            <a class="my-auto border border-0 p-0" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (!$this->session->userdata('logged_in')) { ?>

                                    <li><a href="<?= base_url('signup') ?>" class="dropdown-item">Signup</a></li>
                                    <li><a href="<?= base_url('login') ?>" class="dropdown-item">Login</a></li>

                                <?php
                                }
                                if ($this->session->userdata('logged_in')) { ?>
                                    <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                                <?php }
                                ?>
                            </ul>
                        </li>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body d-flex align-items-center">
                    <form action="<?= base_url('shop') ?>" method="POST" class="w-100">
                        <div class="input-group w-75 mx-auto">

                            <input type="search" name="home_search" class="form-control p-3" placeholder="keywords"
                                aria-label="Search">

                            <button type="submit" class="input-group-text p-3 bg-white" style="cursor:pointer;">
                                <i class="fa fa-search"></i>
                            </button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Search End -->
    <main>
