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
                            $output = "";
                            foreach ($category as $cat) {

                                $id = $cat->id;
                                $name = ucfirst($cat->name);
                                $image = $cat->image;
                                // $output .= "
                            ?>
                                <tr class='align-middle'>   
                                    <td><?= $id ?></td>
                                    <td>
                                        <div class='d-block '>
                                            <img src='<?= base_url('assets/uploads/category/'. $image)?>' alt='Preview' class='img-thumbnail rounded shadow-sm d-block'
                                                style='width:150px; height:100px; object-fit:cover;'>
                                        </div>
                                    </td>
                                    <td><?= $name ?></td>

                                    <td class='d-flex align-items-center justify-content-center'>
                                        <a href='<?= site_url('admin/view/') ?>' role='button' class='btn btn-primary btn-sm me-1'><i class='fa-solid fa-eye'></i>
                                        </a>
                                        <a href='<?= site_url('admin/view/') ?>' role='button' class='btn-sm btn btn-warning text-light me-1'><i class='fa-solid fa-edit'></i>
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
</div>