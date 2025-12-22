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
                            $serial_no = $offset + 1;
                            $output = "";
                            foreach ($category as $cat) {
                                $enc_id = urlencode(base64_encode($this->encryption->encrypt($cat->id)));

                                $id = $cat->id;
                                $name = ucfirst($cat->name);
                                $image = $cat->image;
                                // $output .= "
                            ?>
                                <tr class='align-middle'>
                                    <td><?= $serial_no++ ?></td>
                                    <td>
                                        <div class='d-block category-view-image'>
                                            <img src='<?= base_url('assets/uploads/category/thumb/' . $image) ?>' alt='<?= $cat->image_alt ?>' class='img-thumbnail rounded shadow-sm d-block'>
                                        </div>
                                    </td>
                                    <td><?= $name ?></td>

                                    <td class='align-middle text-center'>
                                        <a href='<?= site_url('admin/Category/add/' . $enc_id) ?>' role='button' class='btn-sm btn btn-warning text-light me-1'><i class='fa-solid fa-edit'></i>
                                        </a>
                                        <a href='<?= site_url('admin/Category/delete/' . $enc_id) ?>' role='button' class='btn-sm btn btn-danger text-light' data-file="<?= $image ?>" data-id="<?= $enc_id ?>" id="deleteBtn"><i class='fa-solid fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php      // ";
                            }
                            // echo $output;
                            ?>


                        </tbody>
                    </table>

                    <?= $links ?>

                </div>
            </div>

        </div>
        <div id="response-msg"> </div>


    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(document).on('click', '#deleteBtn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let file = $(this).data('file');

            $.ajax({
                url: "<?= base_url('admin/Category/delete/'); ?>"+ id,
                type: "POST",
                data:{file:file},
                dataType:"JSON",
                success: function(response) {
                    // let res = JSON.parse(response);

                    if (response.status === "success") {
                    $("#response-msg")
                            .addClass("success-msg")
                            .removeClass("error-msg")
                            .html("Successfully Deleted.")
                            .fadeIn(200)
                            .delay(3000)
                            .fadeOut(200);
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                    } else {
                        $("#response-msg")
                            .addClass("error-msg")
                            .removeClass("success-msg")
                            .html("Failed to delete image")
                            .fadeIn(200)
                            .delay(3000)
                            .fadeOut(200);
                    }
                }
            });
        })
    });
</script>