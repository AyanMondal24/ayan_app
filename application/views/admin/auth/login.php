<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
</head>


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
            <div class="col-md-5">

                <div class="card shadow-lg p-4 rounded-4">
                    <h3 class="text-center mb-4">Login</h3>
                    <hr>
                    <form method="POST" id="login-form" novalidate>

                        <!-- Email -->
                        <div class="mb-3 error-error">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                            <span class="error" id="email_error"><?= form_error('email') ?></span>
                        </div>

                        <!-- Password -->
                        <div class="mb-3 error-error">
                            <label class="form-label">Password *</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                            <span class="error" id="pass_error"><?= form_error('password') ?></span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                            Login
                        </button>

                        <p class="text-center mt-3">
                            Don't have an account?
                            <a href="<?= base_url('admin/auth/signup') ?>" class="text-decoration-none">Sign Up</a>
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
    document.addEventListener('DOMContentLoaded', function(e) {
        $("#login-form").on('submit', function(e) {
            e.preventDefault();
            const email = document.querySelector("#email");
            const password = document.querySelector("#password");

            const fields = [{
                    element: email,
                    rules: [{
                        rule: "required",
                        message: "Email field required"
                    }, {
                        rule: "email"
                    }],
                    errorSelector: "#email_error"
                },
                {
                    element: password,
                    rules: [{
                        rule: "required"
                    }],
                    errorSelector: "#pass_error"
                }
            ];
            let is_validation = validate(fields)
            if (!is_validation) return

            $.ajax({
                url: "<?= base_url('admin/auth/checkLogin') ?>",
                type: "POST",
                data: $("#login-form").serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status === 'error') {
                        $.each(response.errors, function(field, msg) {
                            $(`input[name="${field}"]`).closest('.error-error').find('span.error').html(msg)
                        });
                        return;
                    }
                    if (response.status === 'success') {
                        $("#response-msg").addClass('success-msg').removeClass('error-msg').html(response.message).fadeIn(200).delay(3000).fadeOut(200);

                        window.location.href = response.redirect;


                    } else {
                        $("#response-msg").addClass('error-msg').removeClass('success-msg').html(response.message).fadeIn(200).delay(3000).fadeOut(200);
                    }
                }
            })

        })
    });
</script>