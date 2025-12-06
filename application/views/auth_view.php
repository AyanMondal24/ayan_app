<div class="login-container ">
    <div class="form-box">
        <h2 class="title ">Connect With Us</h2>

        <div class="tabs">
            <button class="tab" onclick="switchTab('login')">Login</button>
            <button class="tab" onclick="switchTab('signup')">Signup</button>
        </div>

        <!-- Login Form -->
        <form id="login" class="form" method="POST" enctype="multipart/form-data">
            <input type="email" placeholder="Email Address" name="email" required>
            <input type="password" placeholder="Password" name="password" required>

            <a href="#" class="forgot">Forgot password?</a>

            <!-- <button class="btn gradient">Login</button> -->
            <input type="submit" class="btn gradient" id="login-btn" value="Login">
        </form>

        <p class="switch-text">
            Not a member? <a href="#" onclick="switchTab('signup')">Signup now</a>
        </p>


        <!-- Signup Form -->
        <form id="signup" class="form" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input id="f_name" type="text" placeholder="First Name" name="firstname">
                    <span class="error" id="f_name_error" data-callback=check1></span>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input id="l_name" type="text" placeholder="Last Name" name="lastname">
                    <span class="error" id="l_name_error"></span>
                </div>

                <div class="col-md-12 col-lg-12 col-sm-12">
                    <input id="email" type="text" placeholder="Email Address" name="email">
                    <span class="error" id="email_error"></span>
                </div>

                <div class="col-md-12 col-lg-12 col-sm-12">
                    <input id="ph" type="text" placeholder="Phone No." name="phone">
                    <span class="error" id="ph_error"></span>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input id="pass" type="password" placeholder="Password" name="password">
                    <span class="error" id="pass_error"></span>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input id="pass_confirm" type="password" placeholder="Confirm Password" name="cpassword">
                    <span class="error" id="pass_confirm_error"></span>
                </div>
            </div>

            <button type="submit" class="btn gradient" id="signup-form">Sign up</button>
        </form>

        <p class="switch-text">
            Already a member? <a href="#" onclick="switchTab('login')">Login now</a>
        </p>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const f_name = document.querySelector("#f_name");
        const l_name = document.querySelector("#l_name");
        const email = document.querySelector("#email");
        const phone = document.querySelector("#ph");
        const password = document.querySelector("#pass");
        const pass_confirm = document.querySelector("#pass_confirm");
        $("#signup").on("submit", function(e) {
            e.preventDefault();

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
                    element: password,
                    rules: [{
                            rule: "required"
                        },
                        {
                            rule: "min",
                            value: 6,
                            message: "Password must be 6+ chars"
                        }
                    ],
                    errorSelector: "#pass_error"
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


            $.ajax({
                url: "<?= base_url('Auth/addUser') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    // console.log(response.status)
                    set_page(response)
                }
            })
        });

        $("#login").on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url('Auth/loginUser') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {

                    console.log(response);

                    if (response.status === 'success') {
                        console.log(response.message);
                        window.location.href = response.redirect;
                    } else {
                        alert(response.message);
                    }
                }
            });
        });

    }); //main div
    function set_page(response) {
        if (response.status === 'success') {
            window.location.href = response.redirect;
        } else {
            console.log("inside error")
        }
    }

    function switchTab(tab) {
        document.getElementById("login").classList.remove("active");
        document.getElementById("signup").classList.remove("active");
        document.querySelectorAll(".tab").forEach(btn => btn.classList.remove("active"));

        document.getElementById(tab).classList.add("active");

        if (tab === "login") {
            document.querySelectorAll(".tab")[0].classList.add("active");
        } else {
            document.querySelectorAll(".tab")[1].classList.add("active");
        }
    }

    // 👇 Run correct tab based on PHP variable
    let activeTab = "<?= $active ?>";
    switchTab(activeTab);
</script>