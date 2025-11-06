<div class="container-fluid add-form">
    <h2 class="text-center">Adding Category</h2>
    <hr>

    <form action="<?= site_url('/admin/save-category') ?>" method="post" enctype="multipart/form-data" id="add-category" class=" p-2 rounded">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <label for="name" class="form-label">Name <sup>*</sup></label>
                <input type="text" class="form-control" id="name" name="name" />
                <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('name'); ?></span>

            </div>

            <div class="col-12 col-md-6 col-lg-6">
                <label for="image" class="form-label">Image <sup>*</sup></label>
                <input type="file" class="form-control" id="image" name="image" />
                <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('image'); ?></span>

            </div>

        </div>
        <!-- <input type="file" name="testimg" id="" accept="image/*"> -->
        <div class="mt-2 mb-2 col-12">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary w-25 text-light">
        </div>
    </form>
  <div id="response-msg"> </div>

</div>

<script>
    // $(document).ready(function() {
    document.addEventListener('DOMContentLoaded', function() {
        $("#add-category").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: new FormData(this),
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(response) {
                    $('span.error-text').html('');
                    if (response.status === 'error') {
                        $.each(response.errors, function(field, message) {
                            $(`[name="${field}"]`)
                            .closest('.col-12, .col-md-6, .col-lg-6')
                            .find('span')
                            .html(message);
                        });
                    } else if (response.status === 'success') {
                        $("#add-category")[0].reset();
                        $("#response-msg")
                            .addClass('success-msg')
                            .removeClass('error-msg')
                            .html("Data Successfully Submitted.")
                            .fadeIn(500)
                            .delay(5000)
                            .fadeOut(500);

                    } else {
                        $("#response-msg")
                            .addClass('error-msg')
                            .removeClass('success-msg')
                            .html("Data Not Submitted.")
                            .fadeIn(500)
                            .delay(5000)
                            .fadeOut(500)
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            })
        });
    });
</script>