<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #response {
            text-align: center;

        }

        .error-msg {
            color: red;
            font-size: 16px;
            font-weight: bold;
        }

        .success-msg {
            color: green;
            font-size: 16px;
            font-weight: bold;
        }

        .error {
            display: block;
            color: red;
            font-size: 14px;
            text-align: left !important;
            margin-top: 4px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h4>Reset Password</h4>
                    </div>

                    <div class="card-body">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" id="reset-pass-submit">

                            <!-- Token from URL -->
                            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                            <div class="mb-3 validation">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" id="password" autocomplete="new-password" required>
                                <span class="error"><?= form_error('password') ?></span>
                            </div>

                            <div class="mb-3 validation">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                                <span class="error"> <?= form_error('confirm_password') ?></span>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Reset Password
                            </button>

                        </form>
                        <div id="response"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("#reset-pass-submit").on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url('reset-password-submit') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status === 'success') {
                        $("#response").addClass('success-msg').removeClass('error-msg').html(response.message).fadeIn().delay(4000).fadeOut(200);
                        setTimeout(function() {
                            window.location.href = response.redirect; // change URL
                        }, 4000);
                    } else if (response.validation === 'error') {
                        $.each(response.errors, function(field, message) {
                            $(`[name="${field}"]`)
                                .closest('.validation')
                                .find('span.error')
                                .html(message);
                        });
                    } else {
                        $("#response").addClass('error-msg').removeClass('success-msg').html(response.message).fadeIn(200).delay(4000).fadeOut(200);
                    }
                },
                error: function() {
                    $("#response").addClass('error-msg').removeClass('success-msg').html('Something wrong!').fadeIn(200).delay(10000).fadeOut(200);
                }
            });
        });
    });
</script>
