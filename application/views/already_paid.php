<div class="container mt-5">
    <div class="card shadow-lg border-0 text-center">
        <div class="card-body p-5">

            <div class="mb-4">
                <i class="fa fa-check-circle text-success" style="font-size: 64px;"></i>
            </div>

            <h2 class="text-success mb-3">Payment Already Completed</h2>

            <p class="text-muted">
                This order has already been paid successfully.
                <br>
                No further action is required.
            </p>

            <hr>

            <div class="d-flex justify-content-center gap-3">
                <a href="<?= base_url('profile/order/details/' . $enc_order_id) ?>" class="btn btn-outline-primary">
                    View My Orders
                </a>

                <a href="<?= base_url('/') ?>" class="btn btn-primary">
                    Go to Home
                </a>
            </div>

        </div>
    </div>
</div>
