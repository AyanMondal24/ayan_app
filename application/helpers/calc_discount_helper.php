 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
 function calculate_discount($subtotal, $coupon)
    {
        // Percentage or fixed discount
        if ($coupon->discount_type === 'percentage') {
            $discount = ($subtotal * $coupon->discount_value) / 100;
        } else {
            $discount = $coupon->discount_value;
        }

        // Ensure discount never exceeds subtotal
        if ($discount > $subtotal) {
            $discount = $subtotal;
        }

        return $discount;
    }