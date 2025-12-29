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
            background: linear-gradient(135deg, #020617, #0f172a);
        }


        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translate3d(-30px, 0, 0);
                /* ← start from left */
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
                /* center */
            }
        }

        .card {
            animation: fadeSlide 0.6s ease-out;
            will-change: transform, opacity;
            transform: translateZ(0);
        }


        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>


<body>




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