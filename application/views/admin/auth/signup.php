<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>

    <!-- 🔥 CRITICAL: prevents sidebar flash BEFORE first paint -->
    <style>
        html, body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden !important;
        }

        /* Permanent sidebar removal */
        .sidebar, #sidebar, aside, .side-nav, .offcanvas, .drawer {
            display: none !important;
            visibility: hidden !important;
            width: 0 !important;
            height: 0 !important;
            overflow: hidden !important;
        }

        /* Hide any Bootstrap or common sidebar classes */
        .col-sidebar, .sidebar-col, .nav-sidebar {
            display: none !important;
        }

        /* Ensure main content takes full width */
        .main-content, .content-area {
            width: 100% !important;
            margin-left: 0 !important;
            padding-left: 0 !important;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
    </style>

    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #020617, #0f172a);
            position: relative;
        }

      @keyframes fadeSlide {
    from {
        opacity: 0;
        transform: translate3d(-30px, 0, 0); /* ← start from left */
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);    /* center */
    }
}

        .card {
    animation: fadeSlide 0.6s ease-out;
    will-change: transform, opacity;
    transform: translateZ(0);
}


        .container,
        .row {
            max-width: 100%;
            overflow-x: hidden;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        #app-wrapper {
            width: 100%;
            overflow-x: hidden;
            position: relative;
        }
    </style>
</head>

<body>
    <div id="app-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg p-4 rounded-4">
                        <h3 class="text-center mb-4">Create an Account</h3>

                        <form method="POST" enctype="multipart/form-data" id="signup-form" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3 error-div">
                                    <label class="form-label">First Name *</label>
                                    <input type="text" class="form-control" name="first_name" id="fname">
                                    <span class="error" id="f_name_error"></span>
                                </div>

                                <div class="col-md-6 mb-3 error-div">
                                    <label class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" name="last_name" id="lname">
                                    <span class="error" id="l_name_error"></span>
                                </div>
                            </div>

                            <div class="mb-3 error-div">
                                <label class="form-label">Phone *</label>
                                <input type="tel" class="form-control" name="phone" id="phone">
                                <span class="error" id="ph_error"></span>
                            </div>

                            <div class="mb-3 error-div">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control" name="email" id="email">
                                <span class="error" id="email_error"></span>
                            </div>

                            <div class="mb-3 error-div">
                                <label class="form-label">Profile Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                                <span class="error" id="image_error"></span>
                            </div>

                            <div class="mb-3 error-div">
                                <label class="form-label">Password *</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <span class="error" id="pass_error"></span>
                            </div>

                            <div class="mb-3 error-div">
                                <label class="form-label">Confirm Password *</label>
                                <input type="password" class="form-control" name="cpassword" id="cpassword">
                                <span class="error" id="pass_confirm_error"></span>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                                Sign Up
                            </button>

                            <p class="text-center mt-3">
                                Already have an account?
                                <a href="<?= base_url('admin/auth/login') ?>">Login</a>
                            </p>
                        </form>
                    </div>

                    <div id="response-msg"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>

    <script>
        (function () {
            document.documentElement.style.overflowX = 'hidden';
            document.body.style.overflowX = 'hidden';
        })();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hard-lock overflow
            document.documentElement.style.overflowX = 'hidden';
            document.body.style.overflowX = 'hidden';

            // Permanently remove any sidebar elements
            const sidebars = document.querySelectorAll('.sidebar, #sidebar, aside, .side-nav, .offcanvas, .drawer, .col-sidebar, .sidebar-col, .nav-sidebar');
            sidebars.forEach(el => el.remove());

            // Observer to prevent reappearance
            const observer = new MutationObserver(() => {
                if (document.documentElement.style.overflowX !== 'hidden') {
                    document.documentElement.style.overflowX = 'hidden';
                }
                if (document.body.style.overflowX !== 'hidden') {
                    document.body.style.overflowX = 'hidden';
                }

                // Re-remove sidebars if they reappear
                const newSidebars = document.querySelectorAll('.sidebar, #sidebar, aside, .side-nav, .offcanvas, .drawer, .col-sidebar, .sidebar-col, .nav-sidebar');
                newSidebars.forEach(el => el.remove());
            });

            observer.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['style'],
                childList: true,
                subtree: true
            });
        });
    </script>

    <script>
        window.addEventListener('resize', () => {
            document.documentElement.style.width = '100%';
            document.body.style.width = '100%';
        });
    </script>
</html>