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
            margin: auto;
            font-size: 14px;
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
            width: 60%;
        }

        .right {
            width: 40%;
            /* text-align: right; */
        }

        .small {
            font-size: 12px;
        }

        .qr {
            width: 110px;
        }

        .invoice-box {
            border: 1px dashed #000;
            padding: 6px 10px;
            margin-top: 10px;
            display: inline-block;
            font-weight: bold;
        }

        hr {
            border: none;
            border-top: 2px solid #777;
            margin: 15px 0;
        }

        .info {
            display: flex !important;
        }

        .order {
            float: left;
            width: 40%;
        }

        .order p {
            font-size: 12px !important;
        }

        .billing {
            width: 60%;
        }

        .billing p {
            font-size: 12px !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        thead th {
            border: 1px solid #000;
            padding: 6px 5px;
            line-height: 1.1;
            height: auto;
            vertical-align: middle;
            text-align: center;
            font-weight: bold;
            background-color: #f2f2f2;
            border-bottom: 2px solid #000;
        }

        tbody td {
            border: 1px solid #000;
            padding: 6px 5px;
            line-height: 1.1;
            vertical-align: middle;
            text-align: center;
        }


        td:first-child {
            text-align: left;
        }

        .total td {
            font-weight: bold;
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

        .summary-box {
            width: 40%;
            float: right;
            margin-top: 15px;
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
            font-size: 14px;
            padding-top: 8px;
        }
    </style>
</head>

<body>

    <div class="invoice">

        <!-- TITLE -->
        <div class="title">Tax Invoice</div>

        <!-- HEADER -->
        <div class="top">
            <div class="left">
                <p><b>Sold By:</b> Ayan Internet Private Limited ,</p>
                <?php
                $address = '';
                if (!empty($order)) {
                    if ($order->is_shipping_same == 0) {
                        $address = $order->s_country . "," . $order->s_state . "," . $order->s_city . "," . $order->s_address . ", Pin - " . $order->s_pin;
                    } else {
                        $address = $order->b_country . "," . $order->b_state . "," . $order->b_city . "," . $order->b_address . ", Pin - " . $order->b_pin;
                    }
                    $formatted = date("d M Y, h:i A", strtotime($order->order_created));
                }

                ?>
                <p class="small">
                    <b>Ship-from Address:</b> <?= $address ?>
                    <!-- <b>CIN:</b> U51109KA2012PTC066107 -->
                </p>
                <p><b>GSTIN :</b> 29AACCF0683K1ZD</p>
            </div>

            <div class="right">
                <img src="qr.png" class="qr">
                <div class="invoice-box">
                    Invoice # BFF4025005897334
                </div>
            </div>
        </div>

        <hr>

        <!-- ORDER + BILLING -->
        <div class="info">
            <div class="order">
                <p><b>Order ID:</b> <?= $order->order_number ?></p>
                <p><b>Order Date:</b> <?= $formatted ?></p>
                <p><b>Invoice Date:</b> 08-02-2025</p>
            </div>

            <div class="billing">
                <p><b>Billing Address</b></p>
                <p><?= $order->b_fname . " " . $order->b_lname ?></p>
                <p>Address: <?= $order->b_country . "," . $order->b_state . "," . $order->b_city . "," . $order->b_address  ?></p>
                <p>Landmark: <?= $order->b_landmark ?></p>
                <p>Pin: <?= $order->b_pin ?></p>
            </div>
        </div>

        <hr>

        <!-- TABLE -->


        <table>

            <tbody>
                <tr>
                    <td>#</td>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Total</td>
                </tr>

                <?php
                $i = 1;
                foreach ($order_details as $item) {
                    $subtotal += $item->quantity * $item->price;
                    $total = (float) $item->quantity * (float) $item->price;
                ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $item->product_name ?></td>
                        <td><?= $item->quantity ?></td>
                        <td><?= $item->price ?></td>
                        <td><?= number_format($total, 2)  ?></td>
                    </tr>

                <?php     }
                ?>
            </tbody>
        </table>


        <hr>

        <!-- GRAND TOTAL -->
        <!-- <div class="grand">
            <span>Grand Total</span>
            <span>₹ </span>
        </div> -->
        <?php $grandTotal = $subtotal - $discount ?>
        <div class="summary-box">

            <div class="summary-row">
                <span>Total</span>
                <span>₹ <?= number_format($subtotal, 2) ?></span>
            </div>

            <?php if (!empty($order->coupon_code)) { ?>
                <div class="summary-row">
                    <span>Discount</span>
                    <span>- ₹ <?= number_format($discount, 2) ?></span>
                </div>
            <?php } ?>
            <div class="summary-row grand">
                <span>Grand Total</span>
                <span>₹ <?= number_format($grandTotal, 2) ?></span>
            </div>

        </div>

        <!-- SIGN -->
        <div style="clear: both;"></div>
        <div class="sign">
            <p>Ayan Internet Private Limited</p>
            <img src="sign.png">
            <p class="small">Authorized Signatory</p>
        </div>

    </div>

</body>

</html>