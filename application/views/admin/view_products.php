<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Bordered Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body product-view">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Name</th>
                                <th width="15%">Price</th>
                                <th width="15%">Quantity</th>
                                <th width="20%">Status</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $i = $offset + 1;
                            
                            foreach ($products as $product) {

                                $store_status = "";
                                $enc_id =base64_encode($this->encryption->encrypt($product->id));
                                $name = ucfirst($product->name);
                                // $status=(int) $product->status;
                                // $is_available=(int) $product->is_available;
                                $combine_status = $product->status_combine;

                                // 0/0 means first 0 (active/deactive) and the second 0 (available/unavailable)
                                if ($combine_status === "0/0") {
                                    $store_status .= "<span class='badge bg-success'>Active / Available</span>";
                                } else if ($combine_status === "1/1") {
                                    $store_status .= "<span class='badge bg-danger'>Inactive / Unavailable</span>";
                                } else if ($combine_status === "1/0") {
                                    $store_status .= "<span class='badge bg-secondary'>Inactive / Available</span>";
                                } else if ($combine_status ===  "0/1") {
                                    $store_status .= "<span class='badge bg-warning'>Active / Unavailable</span>";
                                }
                                ?>
                         
                        <tr class='align-middle'>
                            <td> <?= $i++ ?></td>
                            <td> <?= $name ?></td>
                            <td> <?= $product->price ?>/ kg</td>
                            <td> <?= $product->quantity ?></td>
                            <td> <?= $store_status ?></td>
                            <td class='d-flex align-items-center justify-content-center'>
                                <a href="<?= base_url('admin/Product/view/' .urlencode($enc_id)) ?>" role='button' class='btn btn-primary btn-sm me-1'><i class='fa-solid fa-eye'></i>
                                </a>
                                <a href='<?= site_url('admin/update/'.$product->id) ?>' role='button' class='btn-sm btn btn-warning text-light me-1'><i class='fa-solid fa-edit'></i>
                                </a>
                                <a href='<?= site_url('admin/delete/') ?>' role='button' class='btn-sm btn btn-danger text-light'><i class='fa-solid fa-trash'></i>
                                </a>
                            </td>
                        </tr>
                                
                          <?php  }
                     
                            ?>


                        </tbody>
                    </table>

                    <div>
                        <?= $links ?>
                    </div>
                   

                </div>
            </div>

        </div>

    </div>
</div>