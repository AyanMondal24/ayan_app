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
                    <input type="text" placeholder="First Name" name="firstname" required>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="text" placeholder="Last Name" name="lastname" required>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <input type="email" placeholder="Email Address" name="email" required>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <input type="text" placeholder="Phone No." name="phone" required>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="password" placeholder="Confirm Password" name="cpassword" required>
                </div>
            </div>

            <!-- <button class="btn gradient" type="submit" id="signup-form">Signup</button> -->
            <input type="submit" class="btn gradient" id="signup-form" value="Signup">
        </form>
        <p class="switch-text">
            Already a member? <a href="#" onclick="switchTab('login')">Login now</a>
        </p>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("#signup").on("submit", function(e) {
            e.preventDefault();
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