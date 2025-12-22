<div class="container-fluid add-form">
    <h2 class="text-center"><?= $title ?></h2>
    <hr>

    <form action="<?= site_url('/admin/Category/store') ?>" method="post" enctype="multipart/form-data" id="add-category" class=" p-2 rounded">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 error-error">
                <?php if (!empty($category)) { ?>
                    <input type="hidden" name="id" value="<?= $category->id ?>">
                    <input type="hidden" name="old_img" value="<?= $category->image ?>">
                <?php } ?>
                <label for="name" class="form-label">Name <sup>*</sup></label>
                <input type="text" class="form-control mt-2" id="name" name="name" placeholder="Enter Category" value="<?= set_value('name', @$category->name) ?>" />
                <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('name'); ?></span>
            </div>

            <div class="col-12 col-md-6 col-lg-6 error-error">
                <label for="imageInput" class="form-label d-block">Image <sup>*</sup></label>
                <div id="preview">
                    <!-- <img id="previewImage" src="" style="max-width:200px; margin-top:10px; display:none;"> -->
                </div>
                <div class="d-flex">
                    <?php if (!empty($category)) {
                    ?>

                        <div class="update_image_box  position-relative d-inline-block mt-2 me-2" style="width:100px;">
                            <div class="image-box">
                                <div class="product-img">
                                    <img src="<?= base_url('assets/uploads/category/thumb/' . $category->image) ?>" class="img-thumbnail" style="min-width:200px; max-width:200px;height:200px;object-fit:cover;" id="chnage-image-preview">
                                </div>

                                <label class="change-btn translate-middle text-white bg-dark bg-opacity-75 px-2 py-1 rounded"
                                    for="changeImage"
                                    style="position:absolute;top:100px; left:100px; font-size:12px;cursor:pointer;opacity:0;transition:opacity 0.3s;z-index:2;">
                                    Change
                                </label>
                            </div>

                            <div class="error-error">
                                <input type="file" name="changeImage" id="changeImage" class="d-none" accept="image/*">
                                <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('changeImage'); ?></span>
                            </div>
                            <div class="error-show error-error">
                                <input type="text" name="alt_text" class="form-control mt-2" placeholder="Enter alt text for SEO" value="<?= $category->image_alt ?>" style="width:200px;">
                                <span class="error-text" style="width:200px;color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('alt_text'); ?></span>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
                <?php if (empty($category)) { ?>
                    <label for="imageInput" class="upload-box">
                        <div class="upload-box mt-2 border rounded d-flex align-items-center justify-content-center" style="width:100px;height:100px;cursor:pointer;">
                            <i class="bi bi-plus-lg fs-3 text-primary"></i>
                        </div>
                    </label>
                    <input type="file" class="form-control d-none" id="imageInput" name="image" accept="image/*" />
                    <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('image'); ?></span>

                <?php } ?>
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
                                .closest('.error-error')
                                .find('span.error-text')
                                .html(message);
                        });
                        $("#response-msg")
                            .addClass('error-msg')
                            .removeClass('success-msg')
                            .html(response.message || "Validation Faild.")
                            .fadeIn(500)
                            .delay(5000)
                            .fadeOut(500)
                    } else if (response.status === 'success') {
                        $("#add-category")[0].reset();
                        $("#response-msg")
                            .addClass('success-msg')
                            .removeClass('error-msg')
                            .html("Data Successfully Submitted.")
                            .fadeIn(200)
                            .delay(3000)
                            .fadeOut(200);
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else if (response.status === 'update') {
                        $("#response-msg")
                            .addClass('success-msg')
                            .removeClass('error-msg')
                            .html("Data Successfully Updated.")
                            .fadeIn(500)
                            .delay(5000)
                            .fadeOut(500);
                        setTimeout(function() {
                            location.reload();
                        }, 2000);

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

        // change image
        $(document).on('change', "#changeImage", function(e) {
            let file = e.target.files[0];
            const imageBox = $(this).closest('.update_image_box');

            if (file) {
                let reader = new FileReader();

                reader.onload = function(event) {
                    let imgUrl = event.target.result; // base64 URL

                    // Update image preview
                    imageBox.find('.product-img img').attr('src', imgUrl);
                }

                reader.readAsDataURL(file);
            }
        });

        // insert new image 
        $("#imageInput").on('change', function(e) {
            let file = e.target.files[0];
            if (file) {
                let reader = new FileReader();

                reader.onload = function(event) {
                    $(".upload-box").hide();
                    // $("#previewImage").attr("src", event.target.result).show();
                    let imgHtml = `
                    <div class="position-relative d-inline-block mt-2" style="width:100px;">
                    <img src="${event.target.result}" class="img-thumbnail" style="max-width:200px; height:200px;object-fit:cover;">
                            <button type="button" 
                        class="btn btn-sm btn-danger remove-image" 
                        data-type="preview"
                        style="border-radius:50%;  position: absolute; top: 0; right: -100%;">×</button>

                    <div class="error-error">
                      <input type="text" name="alt_text" id="alt-text" class="form-control mt-2" placeholder="Enter alt text for SEO" style="width:200px;">
                      <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('alt_text'); ?></span>
                    </div>
                </div>
                    `;
                    $("#preview").html(imgHtml)
                };

                reader.readAsDataURL(file);
            }
        });

        // Remove image
        $(document).on('click', ".remove-image", function() {
            $("#preview img").attr("src", "");
            $("#preview").hide();
            $("#imageInput").val(""); // Clear file input
            $("#alt-text").val(""); // Clear alt text input
            $(".upload-box").show();

        });
    });
</script>