<div class="container">
    <h2 id="statusText">⏳ Payment Processing</h2>
    <p>Please wait a moment...</p>
</div>
<?php $order_enc_id =urlencode(base64_encode($this->encryption->encrypt($order->order_id)))?>
<script>
let interval = setInterval(() => {

    fetch(`<?= base_url('Payment/check/'.$order_enc_id) ?>`)
        .then(res => res.json())
        .then(data => {
            if (data.payment_status === 'paid') {
                document.getElementById('statusText').innerHTML = "✅ Payment Successful";
                clearInterval(interval);

                // Redirect after success
                setTimeout(() => {
                    window.location.href = `<?= base_url('Thank_you/index/'.$order_enc_id) ?>`;
                }, 1500);
            }

        });

}, 3000); // every 3 seconds
</script>
