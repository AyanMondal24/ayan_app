<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Coupons Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body product-view">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Coupon Code</th>
                                <th width="20%">Discount</th>
                                <th width="15%">Min Purchase</th>
                                <th width="20%">Status</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $i =  1;
                            if (!empty($coupons)) {

                                foreach ($coupons as $coupon) {
                                    $enc_id = urlencode(base64_encode($this->encryption->encrypt($coupon->id)));

                                    if ($coupon->discount_type === 'percentage') {
                                        $discount = $coupon->discount_value . "%";
                                    } else {
                                        $discount = "Flat " . $coupon->discount_value;
                                    }
                                    if ($coupon->status === '1') {
                                        $status = "Active";
                                    } else {
                                        $status = "Inactive";
                                    }
                            ?>

                                    <tr class='align-middle'>
                                        <td> <?= $i++ ?></td>
                                        <td> <?= $coupon->code ?></td>
                                        <td> <?= $discount ?></td>
                                        <td> <?= "&#8377;" . $coupon->min_purchase ?></td>
                                        <td> <?= $status ?></td>

                                        <td class='d-flex align-items-center justify-content-center'>
                                          
                                            <a href='<?= base_url('admin/Coupons/add/' . $enc_id) ?>' role='button' class='btn-sm btn btn-warning text-light me-1'><i class='fa-solid fa-edit'></i>
                                            </a>
                                            <a href='' role='button' data-id='<?= $enc_id ?>' id='coupon-delete' class='btn-sm btn btn-danger text-light'><i class='fa-solid fa-trash'></i>
                                            </a>
                                        </td>
                                    </tr>

                            <?php  }
                            }


                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
            <div id="response-msg"></div>

        </div>

    </div>
    <div id="response-msg"> </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(document).on('click', "#coupon-delete", function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            // alert(id)
            $.ajax({
                url: "<?= base_url('admin/Coupons/delete/') ?>" + id,
                type: 'POST',
                // data: {id:id},
                dataType: 'JSON',
                success: function(response) {

                    if (response.status === 'success') {
                        $("#response-msg")
                            .addClass('success-msg')
                            .removeClass('error-msg')
                            .html('Successfully Deleted.')
                            .fadeIn(500)
                            .delay(1000)
                            .fadeOut(500);

                        setTimeout(() => location.reload(), 1000);
                    } else {
                        $("#response-msg")
                            .addClass('error-msg')
                            .removeClass('success-msg')
                            .html('Product Not Deleted.')
                            .fadeIn(500)
                            .fadeOut(500)
                    }
                }
            })
        })
    });
</script>