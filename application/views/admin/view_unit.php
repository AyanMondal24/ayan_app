<div class="container">

<h2 class="text-center m-4">Units Details</h2>
<hr>
<div class="row mt-2">
    <div class="col-12 product-view">
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th scope="col" width="10">#</th>
                    <th scope="col" width="25">Name</th>
                    <th scope="col" width="25">Short Name</th>
                    <th scope="col" width="20">Status</th>
                    <th scope="col" width="20">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                 foreach($units as $unit) { 
                    
                    $enc_id=urlencode(base64_encode($this->encryption->encrypt($unit->id)));
                    ?>
                <tr>
                    <th scope="row" class="text-center"><?= $i++ ?></th>
                    <td><?= $unit->name ?></td>
                    <td><?= $unit->short_name ?></td>
                    <td><?= $unit->status ?></td>
                    <td>
                        <a href="<?= base_url('admin/Units/add/'. $enc_id) ?>" class="btn btn-warning me-1 text-light"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="<?= base_url('admin/Units/delete/'. $enc_id) ?>" data-id="<?= $enc_id ?>" id="deleteBtn" role="button" class=" btn btn-danger me-1 text-light"><i class="fa-solid fa-trash"></i></a>

                    </td>
                </tr>
                <?php    } ?>

            </tbody>
        </table>
    </div>
    <div id="response-msg"></div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
           $(document).on('click', '#deleteBtn', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            $.ajax({
                url: "<?= site_url('admin/units/delete/') ?>" + id,
                type: "POST",
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                            $("#response-msg")
                            .addClass('success-msg')
                            .removeClass('error-msg')
                            .html(response.message)
                            .fadeIn(500)
                            .delay(1000)
                            .fadeOut(500, function() {
                                location.reload(true);
                            });
                    } else {
                         $("#response-msg")
                            .addClass('error-msg')
                            .removeClass('success-msg')
                            .html(response.message)
                            .fadeIn(500)
                            .delay(1000)
                            .fadeOut(500, function() {
                                location.reload(true);
                            });
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    })
</script>