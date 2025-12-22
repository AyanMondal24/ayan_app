<div class="container add-form ">
    <h2 class="text-center"><?= $title ?></h2>
    <hr>
    <form action="<?= base_url('admin/Units/store') ?>" method="POST" enctype="multipart/form-data" id="unit-form">
        <input type="hidden" name="id" id="id" value="<?= isset($unit->id) ? $unit->id : '' ?>">
        <div class="row p-2">
            <div class="col-lg-6 col-md-6 col-sm-12 error-error">
                <label for="name">Name <sup>*</sup></label>
                <input type="text" name="name" id="name" placeholder="Unit Full Name...." class="form-control" value="<?= set_value('name', isset($unit->name) ? $unit->name : '') ?>">
                <span class="error-text"></span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 error-error">
                <label for="sname">Short Name <sup>*</sup></label>
                <input type="text" name="short_name" id="sname" placeholder="Unit Short Name...." class="form-control" value="<?= set_value('short_name', isset($unit->short_name) ? $unit->short_name : '') ?>">
                <span class="error-text"></span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 error-error">
                <label for="status">Status <sup>*</sup></label>
                <select class="form-select mb-2" aria-label="Default select example" name="status" id="status">
                    <?php $current_status = set_value('status', isset($unit->status) ? $unit->status : ''); ?>
                    <option value="">Choose Status</option>
                    <option value="active" <?= $current_status == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $current_status == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
                <span class="error-text"></span>
            </div>

            <div class="col-12">
                <input type="submit" name="submit" id="submit" value="Submit" class="w-25 text-light fs-18 btn btn-primary">
            </div>
        </div>
    </form>
    <div id="response-msg"></div>
</div>

<script>
    window.CKEDITOR && (CKEDITOR.config.versionCheck = false);
    document.addEventListener('DOMContentLoaded', function() {



        $("#unit-form").on('submit', function(e) {
            e.preventDefault();


            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: new FormData(this),
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response)
                    if (response.status == 'error') {

                        $.each(response.errors, function(field, message) {
                            $(`[name="${field}"]`).closest('.error-error').find('span.error-text').html(message);
                        });
                        $("#response-msg")
                            .addClass('error-msg')
                            .removeClass('success-msg')
                            .html(response.message)
                            .fadeIn(200)
                            .delay(1000)
                            .fadeOut(200)
                    } else if (response.status === 'success') {
                        $("#unit-form")[0].reset();

                        $("#response-msg")
                            .addClass('success-msg')
                            .removeClass('error-msg')
                            .html(response.message)
                            .fadeIn(500)
                            .delay(1000)
                            .fadeOut(500, function() {
                                location.reload(true);
                            });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.log(xhr.responseText);
                    $("#response-msg")
                        .addClass('error-msg')
                        .removeClass('success-msg')
                        .html("AJAX failed. Check console.")
                        .fadeIn(300)
                        .delay(4000)
                        .fadeOut(500);
                }
            })
        });
     

    });
</script>