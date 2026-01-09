<div class="login-container auth-box">
    <div class="form-box">
        <h2 class="title ">Connect With Us</h2>

        <div class="tabs">
            <button class="tab" onclick="switchTab('login')">Login</button>
            <button class="tab" onclick="switchTab('signup')">Signup</button>
        </div>

        <!-- Login Form -->
        <div>

            <form id="login" class="form" method="POST" enctype="multipart/form-data" novalidate>

                <input type="hidden" name="redirect_to" value="<?= isset($redirect_to) ? $redirect_to : '' ?>">

                <div class="col-md-12 col-lg-12 col-sm-12 error-div">
                    <input type="email" id="email_login" placeholder="Email Address" name="email">
                    <span class="error" id="email_login_error"><?= form_error('email') ?></span>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 error-div">
                    <input type="password" id="password_login" placeholder="Password" name="password">
                    <span class="error" id="password_login_error"><?= form_error('password') ?></span>
                </div>
                <a href="<?= base_url('forgot-password') ?>" class="forgot">Forgot password?</a>

                <!-- <button class="btn gradient">Login</button> -->
                <input type="submit" class="btn gradient" id="login-btn" value="Login">
            </form>

            <p class="switch-text" id="login-switch-text">
                Not a member? <a href="#" onclick="switchTab('signup')">Signup now</a>
            </p>

        </div>

        <?php if (!empty($check_verification) && $check_verification == 1) { ?>
            <div class="alert alert-success">
                ✅ Email verified successfully. Please login.
            </div>
        <?php } else if (!empty($check_verification) && $check_verification == 'expired_link') { ?>
            <div class="alert alert-warning"> ⏰ Verification link expired. Please request a new one. </div>
        <?php  } else if (!empty($check_verification) && $check_verification == 'expired_link') { ?>
            <div class="alert alert-danger"> ❌ Invalid verification link. </div>
        <?php  } ?>



        <!-- Signup Form -->
        <div>
            <form id="signup" class="form" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 error-div">
                        <input id="f_name" type="text" placeholder="First Name" name="firstname">
                        <span class="error" id="f_name_error"><?= form_error('firstname') ?></span>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 error-div">
                        <input id="l_name" type="text" placeholder="Last Name" name="lastname">
                        <span class="error" id="l_name_error"><?= form_error('lastname') ?></span>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 error-div">
                        <input id="email" type="text" placeholder="Email Address" name="email">
                        <span class="error" id="email_error"><?= form_error('email') ?></span>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 error-div">
                        <input id="ph" type="text" placeholder="Phone No." name="phone">
                        <span class="error" id="ph_error"><?= form_error('phone') ?></span>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 error-div">
                        <input id="pass" type="password" placeholder="Password" name="password">
                        <span class="error" id="pass_error"><?= form_error('password') ?></span>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 error-div">
                        <input id="pass_confirm" type="password" placeholder="Confirm Password" name="cpassword">
                        <span class="error" id="pass_confirm_error"><?= form_error('cpassword') ?></span>
                    </div>
                </div>

                <!-- <button type="submit" class="btn gradient mt-2" id="signup-form">Sign up</button> -->
                <button id="signup-form" class="btn gradient mt-2 btn-forgot w-100">
                    <span class="btn-text">Signup</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>
            </form>

            <p class="switch-text" id="signup-switch-text">
                Already a member? <a href="#" onclick="switchTab('login')">Login now</a>
            </p>
        </div>
        <div id="response"></div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => el.remove());
        }, 5000);
        // $("#signup").on("submit", function(e) {
        $("#signup-form").on("click", function(e) {
            e.preventDefault();

            const f_name = document.querySelector("#f_name");
            const l_name = document.querySelector("#l_name");
            const email = document.querySelector("#email");
            const phone = document.querySelector("#ph");
            const password = document.querySelector("#pass");
            const pass_confirm = document.querySelector("#pass_confirm");

            const fields = [{
                    element: f_name,
                    rules: [{
                        rule: "required",
                        message: "First name required"
                    }],
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
                    // element: password,
                    // rules: [{
                    //         rule: "required"
                    //     },
                    //     {
                    //         rule: "min",
                    //         value: 6,
                    //         message: "Password must be 6+ chars"
                    //     }
                    // ],
                },
                {
                    element: pass_confirm,
                    rules: [{
                        rule: "custom",
                        message: "Password does not match",
                        func: val => val === password.value
                    }],
                    errorSelector: "#pass_confirm_error",
                }
            ];
            let is_validate = validate(fields);

            if (!is_validate)
                return;

            let btn = $(this);

            // UI: loading state
            btn.prop("disabled", true);
            btn.find(".btn-text").text("Sending Verification Link Check Email...");
            btn.find(".spinner-border").removeClass("d-none");

            $.ajax({
                url: "<?= base_url('signup-user') ?>",
                type: "POST",
                data: $("#signup").serialize(),
                dataType: "JSON",
                success: function(response) {
                    $(".error").html('')

                    if (response.validation === 'error') {
                        $.each(response.errors, function(field, msg) {
                            $(`input[name="${field}"]`).closest('.error-div').find('span.error').html(msg)
                        });
                        btn.find(".spinner-border").addClass("d-none");
                        btn.find(".btn-text").text("Signup");
                        btn.prop("disabled", false);
                        return;
                    } else if (response.status === 'success') {
                        // window.location.href = response.redirect;
                        $("#response").addClass('success-msg').removeClass('error-msg').html(response.message).fadeIn(200).delay(4000).fadeOut(200);
                        btn.prop("disabled", true);
                        btn.find(".spinner-border").addClass("d-none");
                        btn.find(".btn-text").text("Send Verification Link Check Email...");

                    } else {
                        $("#response").addClass('error-msg').removeClass('success-msg').html(response.message).fadeIn(200).delay(4000).fadeOut(200);
                        btn.prop("disabled", false);
                        btn.find(".spinner-border").addClass("d-none");
                        btn.find(".btn-text").text("Signup");

                    }
                    // set_page(response)
                }
            });
        });

        $("#login").on("submit", function(e) {
            e.preventDefault();

            const login_email = document.querySelector('#email_login');
            const login_password = document.querySelector('#password_login');
            const fields = [{
                    element: login_email,
                    rules: [{
                            rule: "required"
                        },
                        {
                            rule: "email",
                            message: "Enter a valid email"
                        }
                    ],
                    errorSelector: "#email_login_error"
                },
                {
                    element: login_password,
                    rules: [{
                        rule: "required",
                        message: "Password field required."
                    }],
                    errorSelector: "#password_login_error"
                }
            ]

            let is_validate = validate(fields);
            if (!is_validate) return;

            $.ajax({
                url: "<?= base_url('login-user') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {

                    $(".error").html('')
                    if (response.status === 'error') {
                        $.each(response.errors, function(field, msg) {
                            $(`input[name="${field}"]`).closest('.error-div').find('span.error').html(msg)
                        });
                        return;
                    } else if (response.status === 'success') {
                        window.location.href = response.redirect;
                        $("#response").addClass('success-msg').removeClass('error-msg').html(response.message).fadeIn(200).delay(4000).fadeOut(200);
                    } else {
                        $("#response").addClass('error-msg').removeClass('success-msg').html(response.message).fadeIn(200).delay(4000).fadeOut(200);
                    }
                    // set_page(response);
                    // console.log(response);

                    // if (response.status === 'success') {
                    //     // console.log(response.message);
                    //     window.location.href = response.redirect;
                    // } else {
                    //     alert(response.message);
                    // }
                }
            });
        });

    }); //main div


    function switchTab(tab) {
        // Forms
        document.getElementById("login").classList.remove("active");
        document.getElementById("signup").classList.remove("active");

        // Tabs
        document.querySelectorAll(".tab").forEach(btn => btn.classList.remove("active"));

        // Switch texts
        document.getElementById("login-switch-text").style.display = "none";
        document.getElementById("signup-switch-text").style.display = "none";

        if (tab === "login") {
            document.getElementById("login").classList.add("active");
            document.querySelectorAll(".tab")[0].classList.add("active");
            document.getElementById("login-switch-text").style.display = "block";
        } else {
            document.getElementById("signup").classList.add("active");
            document.querySelectorAll(".tab")[1].classList.add("active");
            document.getElementById("signup-switch-text").style.display = "block";
        }
    }


    // 👇 Run correct tab based on PHP variable
    let activeTab = "<?= $active ?>";
    switchTab(activeTab);
</script>
