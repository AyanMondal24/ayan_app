<div class="login-container bg-danger ">
    <div class="form-box">
        <h2 class="title ">Connect With Us</h2>

        <div class="tabs">
            <button class="tab active" onclick="switchTab('login')">Login</button>
            <button class="tab" onclick="switchTab('signup')">Signup</button>
        </div>

        <!-- Login Form -->
        <form id="login" class="form active">
            <input type="email" placeholder="Email Address" name="email" required>
            <input type="password" placeholder="Password" name="password" required>

            <a href="#" class="forgot">Forgot password?</a>

            <button class="btn gradient">Login</button>

            <p class="switch-text">
                Not a member? <a href="#" onclick="switchTab('signup')">Signup now</a>
            </p>
        </form>


        <!-- Signup Form -->
        <form id="signup" class="form">
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
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <input type="password" placeholder="Confirm Password" required>
                </div>
            </div>

            <button class="btn gradient">Signup</button>

            <p class="switch-text">
                Already a member? <a href="#" onclick="switchTab('login')">Login now</a>
            </p>
        </form>

    </div>
</div>
<script>
    function switchTab(tab) {
        // hide both forms
        document.getElementById("login").classList.remove("active");
        document.getElementById("signup").classList.remove("active");

        // remove active from both buttons
        document.querySelectorAll(".tab").forEach(btn => btn.classList.remove("active"));

        // show selected form
        document.getElementById(tab).classList.add("active");

        // const titleEl = document.querySelector('.title');
        // add active class to correct tab button
        if (tab === "login") {
            document.querySelectorAll(".tab")[0].classList.add("active");
        } else {
            //    titleEl.style.display = 'block';
            document.querySelectorAll(".tab")[1].classList.add("active");
        }
    }
</script>