<div class="thank-you-container">
    <?php 
        if(!empty($order)){ 
            $order_enc_id=urlencode(base64_encode($this->encryption->encrypt($order->order_id)));
            ?>
    <div class="box">
        <h1>Thank You!</h1>
        <p>Your order id is <?= (isset($order) ? $order->order_number : '') ?></p>
        <?php 
        if(!empty($order->payment_method) && !($order->payment_method === 'Cash On Delivery')){ ?>

            <p>Your transaction id is <?= (isset($order) ? $order->transaction_id : '') ?></p>
            <p>Your order has been placed successfully.</p>
     <?php   }
        
        ?>
        
        <a href="<?= base_url('pdf/index/'.$order_enc_id) ?>" role="button" class="btn btn-warning text-light d-block">Download Invoice</a>
        <a href="<?= base_url('/Shop') ?>" class="text-underline">Shop More</a>
    </div>
      <?php  }else{ ?>
        <div class="box">
            No order found
        </div>
     <?php }
        ?>
</div>
