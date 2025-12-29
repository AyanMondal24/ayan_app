<div class="container-fluid ">
    <div class="row py-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title ">Products Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body product-view">
                    <table class="table table-bordered table-responsive" id="product-table">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Name</th>
                                <th width="20%">Category</th>
                                <th width="15%">Price</th>
                                <th width="15%" class="quantity">Quantity</th>
                                <th width="20%">Status</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $i = 1;
                            if (!empty($products)) {

                                foreach ($products as $product) {

                                    $store_status = "";
                                    $enc_id = base64_encode($this->encryption->encrypt($product->id));

                                    $name = ucfirst($product->product_name);
                                    // $status=(int) $product->status;
                                    // $is_available=(int) $product->is_available;
                                    $combine_status = $product->status_combine;
                                    // 0/0 means first 0 (active/deactive) and the second 0 (available/unavailable)
                                    if ($product->status == "0" && $product->is_available == "0") {
                                        $store_status .= "
                                    <span class='badge bg-success badge-status'>Active</span>  
                                    <span class='badge bg-success badge-status'>Available</span>";
                                    } else if ($product->status == "1" && $product->is_available == "1") {
                                        $store_status .= "
                                    <span class='badge bg-danger badge-status'>Inactive</span>
                                    <span class='badge bg-danger badge-status'>Unavailable</span>
                                    ";
                                    } else if ($product->status == "0" && $product->is_available == "1") {
                                        $store_status .= "
                                    <span class='badge bg-success badge-status'>Active</span>  
                                    <span class='badge bg-danger badge-status'>Unavailable</span>";
                                    } else if ($product->status == "1" && $product->is_available == "0") {
                                        $store_status .= "
                                    <span class='badge bg-danger badge-status'>Inactive</span>
                                    <span class='badge bg-success badge-status'>Available</span>";
                                    }
                            ?>

                                    <tr class='align-middle'>
                                        <td> <?= $i++ ?></td>
                                        <td> <?= $name ?></td>
                                        <td> <?= $product->category_name ?></td>
                                        <td> <?= $product->price ?>/ <?= $product->short_name ?></td>
                                        <td class="quantity"> <?= $product->quantity ?></td>
                                        <td>
                                            <?= $store_status ?>
                                        </td>
                                        <td class='d-flex align-items-center justify-content-center'>
                                            <a href="<?= base_url('admin/Product/view/' . urlencode($enc_id)) ?>" role='button' class='btn btn-primary btn-sm me-1'><i class='fa-solid fa-eye'></i>
                                            </a>
                                            <a href='<?= site_url('admin/Product/add/' . urlencode($enc_id)) ?>' role='button' class='btn-sm btn btn-warning text-light me-1'><i class='fa-solid fa-edit'></i>
                                            </a>
                                            <a href='' role='button' data-id='<?= urlencode($enc_id) ?>' id='product-delete' class='btn-sm btn btn-danger text-light'><i class='fa-solid fa-trash'></i>
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

        </div>

    </div>
    <div id="response-msg"> </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // add data table 
        const totalRows = document.querySelectorAll('#product-table tbody tr').length;
        let lengthMenu = [5, 10, 25];

        if (totalRows <= 10) {
            lengthMenu = [5, totalRows];
        } else if (totalRows <= 25) {
            lengthMenu = [5, 10, totalRows];
        } else if (totalRows <= 50) {
            lengthMenu = [5, 10, 25, totalRows];
        } else {
            lengthMenu = [5, 10, 25, 50, totalRows];
        }

        let table = new DataTable('#product-table', {
            pageLength: lengthMenu[0], // default first option
            lengthMenu: lengthMenu,
            ordering: true,
            searching: true
        });


        $(document).on('click', "#product-delete", function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            // alert(id)
            $.ajax({
                url: "<?= base_url('admin/Product/delete/') ?>" + id,
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
        });
    });
</script>