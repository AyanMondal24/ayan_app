<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tax Invoice</title>
    <link rel="stylesheet" href="invoice.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #000;
            background: #fff;
        }

        .invoice {
            width: 900px;
            margin: 30px auto;
            font-size: 13px;
            line-height: 1.5;
        }

        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .top {
            display: flex;
            justify-content: space-between;
        }

        .left {
            float: left;
            width: 80%;
        }

        .right {
            width: 20%;
            /* text-align: right; */
        }

        .small {
            font-size: 12px;
        }

        .qr {
            width: 110px;
        }

        .invoice-box {
            width: 100px;
            display: block;
            margin: auto;
            text-align: center;
            background: #000;
            color: #fff;
            padding: 4px 6px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            letter-spacing: 1px;
        }

        .logo-box {
            /* background-color: red; */
            margin-top: 0px !important;
        }

        .logo-box img {
            width: 100px !important;
            height: auto;
        }

        hr {
            border: none;
            border-top: 2px solid #777;
            margin: 15px 0;
        }

        .info {
            display: flex !important;
            justify-content: space-between;
            gap: 20px;
            margin: 20px 0;
            width: 100%;
        }

        .billing {
            float: left;
            width: 45%;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
            background: #fafafa;
        }

        .shipping {
            float: right;
            width: 45%;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
            background: #fafafa;
        }

        .gap {
            width: 10%;
        }

        .billing p,
        .shipping p {
            margin: 3px 0;
            font-size: 12px;
        }

        .billing p:first-child,
        .shipping p:first-child {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 6px;
        }



        .order {
            margin-top: 0px !important;
            float: left;
            width: 40%;
        }

        .order p {
            font-size: 12px !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        thead th {
            background: #f5f5f5;
            border: 1px solid #ccc;
            padding: 8px;
            font-size: 12px;
        }

        tbody td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        tbody td:nth-child(2) {
            text-align: left;
        }

        .grand {
            display: flex;
            justify-content: flex-end;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            gap: 50px;
        }

        .sign {
            text-align: right;
            margin-top: 40px;
        }

        .sign img {
            width: 120px;
            margin-top: 10px;
        }


        .bottom-section {
            display: flex !important;
            justify-content: space-between;
            margin-top: 25px;
            gap: 20px;
        }

        /* .payment-box {
            width: 50%;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
            background: #fafafa;
        } */

        .payment-box tr td {
            font-size: 12px !important;
            margin-bottom: 10px;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            padding: 4px 0;
        }

        .summary-box {
            width: 40%;
            border: 1px solid #000;
            padding: 15px;
            border-radius: 6px;
            font-size: 13px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
        }

        .summary-row.grand {
            border-top: 2px solid #000;
            font-weight: bold;
            font-size: 15px;
            padding-top: 10px;
        }

        .products tbody tr td {
            text-align: center !important;
        }
    </style>
</head>

<body>

    <div class="invoice">

        <!-- TITLE -->
        <!-- <div class="title">Tax Invoice</div> -->

        <!-- HEADER -->
        <div class="invoice-box">
            Invoice
        </div>
        <div class="top">
            <div class="left">
                <p><b>Sold By:</b> Ayan Internet Private Limited ,</p>
                <?php $formatted = date("d M Y, h:i A", strtotime($order->order_created)); ?>
                <div class="order">
                    <p><b>Order ID:</b> <?= $order->order_number ?></p>
                    <p><b>Order Date:</b> <?= $formatted ?></p>
                    <p><b>Invoice Date:</b> 08-02-2025</p>
                </div>
                <!-- <b>CIN:</b> U51109KA2012PTC066107 -->

                <!-- <p><b>GSTIN :</b> 29AACCF0683K1ZD</p> -->
            </div>

            <div class="right">
                <div class="logo-box">
                    <img src="<?= FCPATH ?>assets/img/logo.png" alt="Ayan Ecommerce Pvt. Ltd">
                </div>
            </div>
        </div>

        <hr>

        <!-- ORDER + BILLING -->
        <div class="info">
            <div class="billing">
                <p><b>Billing Address</b></p>
                <p><?= $order->b_fname . " " . $order->b_lname ?></p>
                <p>Address: <?= $order->b_country . "," . $order->b_state . "," . $order->b_city . "," . $order->b_address  ?></p>
                <p>Landmark: <?= $order->b_landmark ?></p>
                <p>Pin: <?= $order->b_pin ?></p>
            </div>

            <div class="gap"></div>
            <?php
            $address = '';
            if (!empty($order)) {
                if ($order->is_shipping_same == 0) {
                    $address = $order->s_country . "," . $order->s_state . "," . $order->s_city . "," . $order->s_address . ", Pin - " . $order->s_pin;
                } else {
                    $address = $order->b_country . "," . $order->b_state . "," . $order->b_city . "," . $order->b_address . ", Pin - " . $order->b_pin;
                }
            }

            ?>
            <?php
            if (!empty($order)) {
                if ($order->is_shipping_same == 0) {
            ?>
                    <div class="shipping">
                        <p><b>Shipping Address</b></p>
                        <p><?= $order->s_fname . " " . $order->s_lname ?></p>
                        <p>Address: <?= $order->s_country . "," . $order->s_state . "," . $order->s_city . "," . $order->s_address  ?></p>
                        <p>Landmark: <?= $order->s_landmark ?></p>
                        <p>Pin: <?= $order->s_pin ?></p>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <hr>

        <!-- TABLE -->
        <table class="products">
            <thead>
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:45%" colspan="2">Product</th>
                    <th style="width:15%">Quantity</th>
                    <th style="width:15%">Price</th>
                    <th style="width:20%">Total</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 1;
                $subtotal = 0;
                foreach ($order_details as $item) {
                    $productUrl = base_url(
                        'category/' . $item->category_slug . '/product/' . $item->slug
                    );
                    $total = $item->quantity * $item->price;
                    $subtotal += $total;
                ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td class="image" style="text-align: center; width:20px !important;"><img src="<?= base_url('assets/uploads/products/thumb/' . $item->image_name) ?>" alt="<?= $item->alt_text ?>" style="width:50px !important; height:50px; border-radius: 10px !important;"></td>
                        <td style="text-align:center;"><a href="<?= $productUrl ?>"
                                target="_blank"
                                style="color:#000; text-decoration:none;">
                                <?= htmlspecialchars($item->product_name) ?>
                            </a></td>
                        <td><?= $item->quantity ?> / <?= strtolower($item->unit_name) ?></td>
                        <td>₹ <?= number_format($item->price, 2) ?></td>
                        <td>₹ <?= number_format($total, 2) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>



        <hr>


        <?php $grandTotal = $subtotal - $discount ?>

        <table width="100%" cellpadding="0" cellspacing="0" border="0"
            style="border:0; border-collapse:collapse; background:transparent;">


            <tr style="border:0;" valign="top">
                <!-- PAYMENT DETAILS -->
                <td width="55%" style="border:0; background:transparent;">
                    <table width="100%" cellpadding="8" cellspacing="0"
                        style="border:1px solid #ddd; border-radius:6px; background:#fafafa;" class="payment-box">
                        <tr>
                            <td colspan="2" style="font-weight:bold;">Payment Details</td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td align="right"><?= strtoupper($order->payment_method) ?></td>
                        </tr>
                        <?php if (strtoupper($order->payment_method) === 'CARD') { ?>
                            <tr>
                                <td>Status</td>
                                <td align="right"><?= ucfirst($order->payment_status) ?></td>
                            </tr>

                            <tr>
                                <td>Transaction ID</td>
                                <td align="right"><?= $order->transaction_id ?></td>
                            </tr>

                            <tr>
                                <td>Paid On</td>
                                <td align="right">
                                    <?= date('d M Y, h:i A', strtotime($order->paid_at)) ?>
                                </td>
                            </tr>
                        <?php     }
                        ?>
                    </table>
                </td>

                <td width="5%" style="border:0;"></td>

                <!-- SUMMARY -->
                <td width="40%" style="border:0; background:transparent;">
                    <table width="100%" cellpadding="8" cellspacing="0"
                        style="border:1px solid #ddd; border-radius:6px; background:#fafafa;">
                        <tr>
                            <td>Subtotal</td>
                            <td align="right">₹ <?= number_format($subtotal, 2) ?></td>
                        </tr>

                        <?php if (!empty($order->coupon_code)) { ?>
                            <tr>
                                <td>Discount</td>
                                <td align="right">- ₹ <?= number_format($discount, 2) ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td colspan="2">
                                <hr style="border:1px solid #000;">
                            </td>
                        </tr>

                        <tr style="font-weight:bold; font-size:15px;">
                            <td>Grand Total</td>
                            <td align="right">
                                ₹ <?= number_format($subtotal - $discount, 2) ?>
                            </td>
                        </tr>
                    </table>
                </td>

            </tr>
        </table>


    </div>

</body>

</html>
