<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Category Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body category-view">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="6%">Image</th>
                                <th width="20%">Name</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $serial_no =$offset + 1;
                            $output = "";
                            foreach ($category as $cat) {
                                $enc_id=urlencode(base64_encode($this->encryption->encrypt($cat->id)));

                                $id = $cat->id;
                                $name = ucfirst($cat->name);
                                $image = $cat->image;
                                // $output .= "
                            ?>
                                <tr class='align-middle'>   
                                    <td><?= $serial_no++ ?></td>
                                    <td>
                                        <div class='d-block '>
                                            <img src='<?= base_url('assets/uploads/category/'. $image)?>' alt='Preview' class='img-thumbnail rounded shadow-sm d-block'
                                                style='width:150px; height:100px; object-fit:cover;'>
                                        </div>
                                    </td>
                                    <td><?= $name ?></td>

                                    <td class='align-middle text-center'>
                                        <a href='<?= site_url('admin/Category/view/'. $enc_id) ?>' role='button' class='btn btn-primary btn-sm me-1'><i class='fa-solid fa-eye'></i>
                                        </a>
                                        <a href='<?= site_url('admin/Category/add/' . $enc_id) ?>' role='button' class='btn-sm btn btn-warning text-light me-1'><i class='fa-solid fa-edit'></i>
                                        </a>
                                        <a href='<?= site_url('admin/view/') ?>' role='button' class='btn-sm btn btn-danger text-light'><i class='fa-solid fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php      // ";
                            }
                            echo $output;
                            ?>


                        </tbody>
                    </table>

                    <?= $links ?>

                </div>
            </div>

        </div>

    </div>
</div>