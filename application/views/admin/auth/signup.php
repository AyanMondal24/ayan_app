<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    body {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #0f172a;
        /* dark tech background */
        overflow: hidden;
    }

    .tech-bg {
        position: fixed;
        inset: 0;
        z-index: -1;
        overflow: hidden;
        background: radial-gradient(circle at top, #020617, #020617 40%, #000);
    }

    .tech-bg span {
        position: absolute;
        width: 2px;
        height: var(--h);
        left: var(--x);
        top: -150px;
        background: linear-gradient(transparent,
                rgba(56, 189, 248, 0.9),
                transparent);
        animation: techMove var(--t) linear infinite;
        filter: drop-shadow(0 0 6px #38bdf8);
        opacity: 0.8;
    }

    @keyframes techMove {
        0% {
            transform: translateY(-150px) translateX(0) rotate(0deg);
            opacity: 0;
        }

        20% {
            opacity: 1;
        }

        100% {
            transform: translateY(120vh) translateX(60px) rotate(8deg);
            opacity: 0;
        }
    }

    @keyframes float {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }

        100% {
            transform: translateY(0);
        }
    }

    .card {
        animation: float 6s ease-in-out infinite;
    }

    .error {
        color: red;
        font-size: 14px;
    }
</style>

<body>
    <div class="tech-bg">
        <span style="--x:5%; --h:140px; --t:5s"></span>
        <span style="--x:15%; --h:220px; --t:7s"></span>
        <span style="--x:30%; --h:180px; --t:6s"></span>
        <span style="--x:45%; --h:260px; --t:9s"></span>
        <span style="--x:60%; --h:200px; --t:6.5s"></span>
        <span style="--x:75%; --h:300px; --t:10s"></span>
        <span style="--x:85%; --h:160px; --t:5.5s"></span>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-lg p-4 rounded-4">
                    <h3 class="text-center mb-4">Create an Account</h3>

                    <form method="POST" enctype="multipart/form-data" id="signup-form" novalidate>

                        <div class="row">
                            <!-- First Name -->
                            <div class="col-md-6 mb-3 error-div">
                                <label class="form-label">First Name *</label>
                                <input type="text" class="form-control" name="first_name" placeholder="Enter first name" id="fname">
                                <span class="error" id="f_name_error"><?= form_error('first_name') ?></span>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6 mb-3 error-div">
                                <label class="form-label">Last Name *</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Enter last name" id="lname">
                                <span class="error" id="l_name_error"><?= form_error('last_name') ?></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3 error-div">
                            <label class="form-label">Phone *</label>
                            <input type="tel" class="form-control" name="phone" placeholder="Enter phone number" id="phone">
                            <span class="error" id="ph_error"><?= form_error('phone') ?></span>
                        </div>

                        <!-- Email -->
                        <div class="mb-3 error-div">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email address" id="email">
                            <span class="error" id="email_error"><?= form_error('email') ?></span>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3 error-div">
                            <label class="form-label">Profile Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*" id="image">
                            <span class="error" id="image_error"><?= form_error('image') ?></span>
                        </div>

                        <!-- Password -->
                        <div class="mb-3 error-div">
                            <label class="form-label">Password *</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password" id="password">
                            <span class="error" id="pass_error"><?= form_error('password') ?></span>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3 error-div">
                            <label class="form-label">Confirm Password *</label>
                            <input type="password" class="form-control" name="cpassword" placeholder="Confirm password" id="cpassword">
                            <span class="error" id="pass_confirm_error"><?= form_error('cpassword') ?></span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                            Sign Up
                        </button>

                        <p class="text-center mt-3">
                            Already have an account?
                            <a href="<?= base_url('admin/auth/login') ?>" class="text-decoration-none">Login</a>
                        </p>

                    </form>
                </div>

                <div id="response-msg"></div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("#signup-form").on("submit", function(e) {
            e.preventDefault();
            const f_name = document.querySelector("#fname");
            const l_name = document.querySelector("#lname");
            const email = document.querySelector("#email");
            const phone = document.querySelector("#phone");
            const image = document.querySelector("#image");
            const password = document.querySelector("#password");
            const pass_confirm = document.querySelector("#cpassword");

            const fields = [{
                    element: f_name,
                    rules: [{
                            rule: "required",
                            message: "First name required"
                        },
                        {
                            rule: "min",
                            value: 2
                        }
                    ],
                    errorSelector: "#f_name_error"
                },
                {
                    element: l_name,
                    rules: [{
                        rule: "required",
                        message: "Last name required"
                    }],
                    errorSelector: "#l_name_error"
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
                    errorSelector: "#ph_error"
                },
                {
                    element: image,
                    rules: [{
                            rule: "required"
                        },
                        {
                            rule: "image"
                        }
                    ],
                    errorSelector: "#image_error"
                },
                {

                    element: password,
                    rules: [{
                            rule: "required"
                        },
                        {
                            rule: "min",
                            value: 8,
                            message: "Password must be at least 8 characters"
                        },
                        {
                            rule: "custom",
                            func: (value) => /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/.test(value),
                            message: "Must contain uppercase, lowercase, number & special character"
                        }
                    ],
                    errorSelector: "#pass_error"
                },
                {
                    element: pass_confirm,
                    rules: [{
                            rule: "required"
                        },
                        {
                            rule: "custom",
                            message: "Password does not match",
                            func: val => val === password.value
                        }
                    ],
                    errorSelector: "#pass_confirm_error",
                }
            ];
            let is_validate = validate(fields);

            if (!is_validate)
                return;

            $.ajax({
                url: "<?= base_url('admin/Auth/storeSignup') ?>",
                type: "POST",
                data: new FormData(this),
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response)
                    $(".error").html('')

                    if (response.status === 'validation_error') {
                        $.each(response.data, function(field, msg) {
                            $(`input[name="${field}"]`).closest('.error-div').find('span.error').html(msg)
                        });
                        return;
                    }
                    set_page(response)
                }
            })
        });
    });

    function set_page(response) {
        if (response.status === 'success') {
            $("#response-msg").addClass('success-msg').removeClass('error-msg').html(response.message).fadeIn(200).delay(3000).fadeOut(200);
            setTimeout(() => {
                window.location.href = response.redirect;
            }, 2000);
        } else {
            $("#response-msg").addClass('error-msg').removeClass('success-msg').html(response.message).fadeIn(200).delay(3000).fadeOut(200);
        }
    }
</script>