<div class="forgot-pass-container">
    <div class="box">
        <h2>Forgot Password</h2>
        <p>Enter your email to receive password reset link</p>

        <form method="POST" action="" id="forgot_password" novalidate>
            <input type="email" class="form-control mb-4" id="email" placeholder="Enter Email Address" name="email" required>
            <button id="forgot-submit" class="btn btn-forgot w-100">
                <span class="btn-text">Send Reset Link</span>
                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
            </button>

        </form>

        <a class="back-login" href="<?= base_url('Auth/login') ?>">← Back to Login</a>

        <div id="response" class="mt-2"></div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // $("#forgot_password").on('submit', function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: "<?= base_url('Auth/forgot_password') ?>",
        //         type: "POST",
        //         dataType: "JSON",
        //         data: {
        //             email: $("#email").val()
        //         },
        //         success: function(response) {
        //             if (response.status === 'success') {
        //                 $("#response").addClass("success-msg").removeClass("error-msg").html(response.message).fadeIn(200).delay(2000).fadeOut(200);
        //                 $("#forgot-submit").prop('disable', true);
        //             } else {
        //                 $("#response").addClass("error-msg").removeClass("success-msg").html(response.message).fadeIn(200).delay(2000).fadeOut(200);

        //             }
        //         }
        //     });
        // });
        $("#forgot-submit").on("click", function(e) {
            e.preventDefault();

            let btn = $(this);

            // UI: loading state
            btn.prop("disabled", true);
            btn.find(".btn-text").text("Sending...");
            btn.find(".spinner-border").removeClass("d-none");

            $.ajax({
                url: "<?= base_url('Auth/forgot_password') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    email: $("#email").val()
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $("#response")
                            .removeClass("error-msg")
                            .addClass("success-msg")
                            .html(response.message)
                            .fadeIn(200)
                            .delay(2000)
                            .fadeOut(200);

                        // keep disabled after success (optional)
                        btn.prop("disabled", true);
                    } else {
                        $("#response")
                            .removeClass("success-msg")
                            .addClass("error-msg")
                            .html(response.message)
                            .fadeIn(200)
                            .delay(2000)
                            .fadeOut(200);

                        // re-enable on error
                        btn.prop("disabled", false);
                    }
                },

                error: function() {
                    $("#response")
                        .removeClass("success-msg")
                        .addClass("error-msg")
                        .html("Something went wrong. Please try again.")
                        .fadeIn(200)
                        .delay(2000)
                        .fadeOut(200);

                    btn.prop("disabled", false);
                },

                complete: function() {
                    // restore button UI
                    btn.find(".btn-text").text("Send Reset Link");
                    btn.find(".spinner-border").addClass("d-none");
                }
            });
        });

    });
</script>
