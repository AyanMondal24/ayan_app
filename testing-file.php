<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body product-view bg-danger">
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
                            $output = "";
                            foreach ($products as $product) {
                                $store_status = "";
                                $id = $product->id;
                                $name = ucfirst($product->name);
                                // $status=(int) $product->status;
                                // $is_available=(int) $product->is_available;
                                $combine_status = $product->status_combine;

                                if($combine_status === "0/0"){
                                    $store_status .= "<span class='badge bg-success'>Active / Available</span>";
                                }
                                else if($combine_status === "1/1"){
                                    $store_status .= "<span class='badge bg-danger'>Inactive / Unavailable</span>";
                                }
                                else if($combine_status === "1/0"){
                                    $store_status .= "<span class='badge bg-secondary'>Inactive / Available</span>";
                                }else if($combine_status ===  "0/1"){
                                    $store_status .= "<span class='badge bg-warning'>Active / Unavailable</span>";
                                }
                                $output .= "
                        <tr class='align-middle'>
                            <td>" . $id . "</td>
                            <td>" . $name . "</td>
                            <td>" . $product->price . "/ kg</td>
                            <td>" . $product->quantity . "</td>
                            <td>" . $store_status . "</td>
                            <td class='d-flex align-items-center justify-content-center'>
                                <a href='" . site_url('admin/view/') . "' role='button' class='btn btn-primary btn-sm me-1'><i class='fa-solid fa-eye'></i>
                                </a>
                                <a href='" . site_url('admin/view/') . "' role='button' class='btn-sm btn btn-warning text-light me-1'><i class='fa-solid fa-edit'></i>
                                </a>
                                <a href='" . site_url('admin/view/') . "' role='button' class='btn-sm btn btn-danger text-light'><i class='fa-solid fa-trash'></i>
                                </a>
                            </td>
                        </tr>
                                ";
                            }
                            echo $output;
                            ?>


                        </tbody>
                    </table>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div> -->
                
            </div>
        </div>

    </div>

</div>