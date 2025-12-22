<div class="container add-products add-form">
  <h2 class="text-center"><?= $title ?></h2>
  <hr>
  <form action="<?= site_url('/admin/Product/store') ?>" method="post" enctype="multipart/form-data" id="add-product" class=" p-2 rounded">
    <?php
    if (!empty($product)) { ?>
      <input type="hidden" name="id" value="<?= $product->id ?>">
    <?php }
    ?>

    <div class="row">
      <div class="col-12 col-md-6 col-lg-4 error-show">
        <label for="name" class="form-label">Name <sup>*</sup></label>
        <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name', @$product->name) ?>" />
        <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('name'); ?></span>
      </div>

      <div class="col-12 col-md-6 col-lg-4 error-show">
        <label for="price" class="form-label">Price <sup>*</sup></label>
        <input type="text" class="form-control" id="price" name="price" value="<?= set_value('price', @$product->price) ?>" />
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('price'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4  d-flex">
        <div class="col-6 me-1 error-show">
          <label for="quantity" class="form-label">Quantity <sup>*</sup></label>
          <input type="text" class="form-control" id="quantity" name="quantity" value="<?= set_value('quantity', @$product->quantity) ?>" />
          <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('quantity'); ?></span>
        </div>
        <div class="col-6 error-show">
          <label for="unit" class="form-label">Unit <sup>*</sup></label>
          <select class="form-select" aria-label="Default select example" name="unit">
            <option value="">Choose Unit</option>
            <?php foreach ($units as $unit) { ?>
              <option value="<?= $unit->id ?>"
                <?= set_select('unit', $unit->id, @$product->unit_id == $unit->id) ?>>
                <?= $unit->short_name ?></option>
            <?php } ?>
          </select>
          <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('unit'); ?></span>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4 error-show">
        <label for="category" class="form-label">Category <sup>*</sup></label>
        <select class="form-select" aria-label="Default select example" name="category">
          <option value="">Choose Category</option>
          <?php
          foreach ($category as $cat) { ?>
            <option value="<?= $cat->id ?>"
              <?= set_select('category', $cat->id, @$product->category == $cat->id) ?>>
              <?= $cat->name ?>
            </option>
          <?php }
          ?>
        </select>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('category'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4 error-show">
        <label for="status" class="form-label">Active Or Deactive <sup>*</sup></label>
        <select class="form-select" aria-label="Default select example" name="status">
          <option value="">Choose Status</option>
          <option value="0" <?= set_select('status', '0', (@$product->status == '0')) ?>>Active</option>
          <option value="1" <?= set_select('status', '1', (@$product->status == '1')) ?>>Deactive</option>

        </select>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('status'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4 error-show">
        <label for="status" class="form-label">Available Or Not <sup>*</sup></label>
        <select class="form-select" aria-label="Default select example" name="is_available">
          <option value="">Choose Status</option>
          <option value="0" <?= set_select('is_available', '0', (@$product->is_available == '0')) ?>>Available</option>
          <option value="1" <?= set_select('is_available', '1', (@$product->is_available == '1')) ?>>Unavailable</option>
        </select>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('is_available'); ?></span>
      </div>
      <div class="col-12 error-show mt-2 mb-2">
        <label for="description" class="form-label">Description <sup>*</sup></label>
        <textarea class="form-control" aria-label="With textarea" name="description" rows="3" id="description"><?= set_value('description', @$product->description) ?></textarea>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('description'); ?></span>
      </div>

      <div class=" col-12 col-md-6 col-lg-6 d-block">
        <label class="form-label">Featured Images <span class="text-danger">*</span></label>
        <div id="image-wrapper-featured" class="d-flex flex-wrap gap-3">



          <div class="d-flex">
            <?php if (!empty($product->id)) {
              if (!empty($featuredimage)) {
                if ($featuredimage->is_featured == "0") {
            ?>
                  <input type="hidden" name="oldfeaturedimage" value="<?= $featuredimage->image_name ?>">
                  <input type="hidden" name="featured_image_id" value="<?= $featuredimage->id ?>">

                  <div class="update_image_box  position-relative d-inline-block mt-2 me-2" style="width:100px;">
                    <div class="image-box">
                      <div class="featured-product-img">
                        <img src="<?= base_url('assets/uploads/products/thumb/' . $featuredimage->image_name) ?>" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                      </div>

                      <label class="change-btn translate-middle text-white bg-dark bg-opacity-75 px-2 py-1 rounded"
                        for="updateImageInput_<?= $featuredimage->id ?>"
                        style="position:absolute;top:50px; left:50px; font-size:12px;cursor:pointer;opacity:0;transition:opacity 0.3s;z-index:2;">
                        Change
                      </label>
                    </div>
                    <input type="file" class="updateImageInput d-none" data-checkname="featured" id="updateImageInput_<?= $featuredimage->id ?>" name="uploadedfeaturedimage" accept="image/*">



                    <div class="error-show">
                      <input type="text" name="uploaded_alt_featured_text" class="form-control mt-2" placeholder="Enter alt text for SEO" value="<?= $featuredimage->alt_text ?>">
                      <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('uploaded_alt_featured_text'); ?></span>
                    </div>


                  </div>
            <?php

                }
              }
            }
            ?>
          </div>
        </div>
        <!-- add featured image  -->
        <?php if (empty($product->id)) {
        ?>
          <div class="image-upload-box " id="featured-upload-box">
            <label for="imageInputFeatured" class="upload-box">
              <div class="upload-box mt-4 border rounded d-flex align-items-center justify-content-center" style="width:100px;height:100px;cursor:pointer;">
                <i class="bi bi-plus-lg fs-3 text-primary"></i>
              </div>
            </label>
            <div class="error-show">
              <input type="file" id="imageInputFeatured" data-checkname="featured" name="is_featured" class="d-none imageuploadtemp" accept="image/*">

              <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('is_featured'); ?></span>
            </div>
          </div>
        <?php  } ?>
      </div>

      <div class="mb-3 col-12 col-md-6 col-lg-6">
        <label class="form-label">Others Images <span class="text-danger">*</span></label>
        <div id="image-wrapper" class="d-flex flex-wrap gap-3">
          <!-- The "+" box -->
          <div class="image-upload-box ">

            <div class="d-flex">
              <?php if (!empty($product->id)) {
                if (!empty($images)) {
                  foreach ($images as $img) {
                    if ($img->is_featured == "1") {

              ?>

                      <div class="update_image_box  position-relative d-inline-block mt-2 me-2" style="width:100px;">
                        <div class="image-box">
                          <div class="product-img">
                            <img src="<?= base_url('assets/uploads/products/thumb/' . $img->image_name) ?>" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                          </div>

                          <label class="change-btn translate-middle text-white bg-dark bg-opacity-75 px-2 py-1 rounded"
                            for="updateImageInput_<?= $img->id ?>"
                            style="position:absolute;top:50px; left:50px; font-size:12px;cursor:pointer;opacity:0;transition:opacity 0.3s;z-index:2;">
                            Change
                          </label>
                        </div>
                        <input type="file" class="updateImageInput d-none" data-checkname="others" id="updateImageInput_<?= $img->id ?>" name="uploadchangeimage[]" accept="image/*">

                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image" data-file="<?= $img->image_name ?>" data-id="<?= $img->id ?>" style="border-radius:50%;">×</button>

                        <input type="hidden" name="uploaded_temp[]" value="<?= $img->image_name ?>">
                        <input type="hidden" name="image_id[]" value="<?= $img->id ?>">

                        <div class="error-show">
                          <input type="text" name="alt_text[]" class="form-control mt-2" placeholder="Enter alt text for SEO" value="<?= $img->alt_text ?>">
                          <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('alt_text'); ?></span>
                        </div>

                        <button class="btn btn-danger text-light make-featured-btn"
                          data-image-id="<?= $img->id ?>"
                          data-product-id="<?= $product->id ?>">
                          Make Featured
                        </button>

                      </div>
              <?php

                    }
                  }
                }
              } ?>
            </div>
            <label for="imageInput" class="upload-box">
              <div class="upload-box mt-4 border rounded d-flex align-items-center justify-content-center" style="width:100px;height:100px;cursor:pointer;">
                <i class="bi bi-plus-lg fs-3 text-primary"></i>
              </div>
            </label>
            <div class="error-show">
              <input type="file" id="imageInput" name="images[]" data-checkname="others" class="d-none imageuploadtemp" multiple accept="image/*">
              <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('images'); ?></span>
            </div>

          </div>
        </div>

      </div>
      <div class="form-group">
        <label>
          <input type="checkbox"
            name="is_featured"
            value="0"
            <?= (isset($product) ? ($product->is_featured == '0') ? 'checked' : '' : '') ?>>
          Featured Product
        </label>
      </div>
    </div>

    <div class="mt-2 mb-2 col-12">
      <input type="submit" name="submit" value="Submit" class="btn btn-primary w-25 text-light">
    </div>
  </form>

  <div id="response-msg"> </div>
  <?php if (isset($product->id)) { ?>

    <a href="<?= base_url('admin/Product') ?>" class="btn btn-outline-primary float-end mt-2">Back to List</a>
  <?php }

  ?>
</div>

<script>
  function initCKEditor() {
    if (CKEDITOR.instances['description']) {
      CKEDITOR.instances['description'].destroy(true);
    }
    CKEDITOR.replace('description');
  }
  document.addEventListener('DOMContentLoaded', function() {
    // Destroy existing instance if already created (prevents duplicate init)
    $(function() {
      initCKEditor();
      // Disable security warning
      window.CKEDITOR && (CKEDITOR.config.versionCheck = false);
      CKEDITOR.replace('description');
    });

    $('#add-product').on('submit', function(e) {
      e.preventDefault();

      // ✅ Sync CKEditor data to textarea
      for (const instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
      }

      const form = new FormData(this);

      $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
          console.log('Server Response:', response);

          // Clear old errors
          $('span.error-text').html('');

          if (response.status === 'error') {
            // console.log(response.message)
            if (response.errors) {
              $.each(response.errors, function(field, msg) {
                // console.log('Processing field:', field, 'Msg:', msg); // DEBUG
                // Handle indexed fields (e.g., alt_text[0], image_type[1])
                let indexMatch = field.match(/\[(\d+)\]/); // FIXED: Use square brackets
                let index = indexMatch ? parseInt(indexMatch[1]) : null;
                let normalized = field.replace(/\[\d+\]/, '[]'); // FIXED: Use square brackets
                // console.log('Index:', index, 'Normalized:', normalized); // DEBUG
                if (index !== null) {
                  // Target the specific indexed element in the array
                  let element = $(`[name="${normalized}"]`).eq(index);
                  // console.log('Element found:', element.length > 0, 'Element:', element); // DEBUG
                  if (element.length) {
                    let errorSpan = element.closest('.error-show').find('.error-text');
                    // console.log('Error span found:', errorSpan.length > 0, 'Span:', errorSpan); // DEBUG
                    errorSpan.html(msg); // Or .text(msg) if you stripped tags
                  } else {
                    console.warn(`Element not found for ${field} at index ${index}`);
                  }
                } else {
                  // Handle non-indexed fields (e.g., 'name', 'price')
                  let errorSpan = $(`[name="${field}"]`).closest('.error-show').find('.error-text');
                  // console.log('Non-indexed span found:', errorSpan.length > 0); // DEBUG
                  errorSpan.html(msg);
                }
              });
            }

            $("#response-msg")
              .addClass('error-msg')
              .removeClass('success-msg')
              .html(response.message || "Validation failed.")
              .fadeIn(200)
              .delay(3000)
              .fadeOut(200);

            //Re-init CKEditor after error (in case it disappears)
            setTimeout(() => {
              if (!CKEDITOR.instances['description']) {
                initCKEditor();
              }
            }, 200);
          } else if (response.status === 'success' || response.status === 'update') {
            $("#add-product")[0].reset();
            if (CKEDITOR.instances['description']) {
              CKEDITOR.instances['description'].setData('');
            }

            $("#response-msg")
              .addClass('success-msg')
              .removeClass('error-msg')
              .html(response.message || "Saved successfully!")
              .fadeIn(200)
              .delay(2000)
              .fadeOut(200, function() {
                location.reload(true);
              });
          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', status, error);
          console.log(xhr.responseText);

          let message = "Something went wrong. Please try again.";

          // Check HTTP status codes
          if (xhr.status === 0) {
            message = "Network error. Please check your internet connection.";
          } else if (xhr.status >= 400 && xhr.status < 500) {
            message = "Client error (" + xhr.status + "): " + (xhr.responseJSON?.message || error);
          } else if (xhr.status >= 500) {
            message = "Server error (" + xhr.status + "). Try again later.";
          }

          // Optional: if server sends a message in JSON format
          if (xhr.responseJSON && xhr.responseJSON.message) {
            message = xhr.responseJSON.message;
          }

          $("#response-msg")
            .addClass('error-msg')
            .removeClass('success-msg')
            .html(message)
            .fadeIn(200)
            .delay(4000)
            .fadeOut(200);
        }
      });
    });

    // make image featured 
    $(document).on('click', '.make-featured-btn', function(e) {
      e.preventDefault();

      let image_id = $(this).data('image-id');
      let product_id = $(this).data('product-id');

      $.ajax({
        url: "<?= base_url('admin/Product/make_featured'); ?>",
        type: "POST",
        data: {
          image_id: image_id,
          product_id: product_id
        },
        dataType: "json",
        success: function(res) {
          if (res.status === 'success') {

            $("#response-msg")
              .addClass('success-msg')
              .removeClass('error-msg')
              .html(res.message)
              .fadeIn(300)
              .delay(3000)
              .fadeOut(500);
            location.reload();
          } else {
            $("#response-msg")
              .addClass('error-msg')
              .removeClass('success-msg')
              .html(res.message)
              .fadeIn(300)
              .delay(3000)
              .fadeOut(500);
          }
        }
      });

    });


    // update page 
    $(document).on('change', '.updateImageInput', function(e) {
      let files = e.target.files;
      let checked_name = $(this).data('checkname');
      const imageBox = $(this).closest('.update_image_box');

      $.each(files, function(index, file) {

        let reader = new FileReader();

        reader.onload = function(event) {
          let imgUrl = event.target.result; // base64 image

          if (checked_name === 'others') {

            let imgHtml = `
                <div class="position-relative d-inline-block mt-2" style="width:100px;">
                    <img src="${imgUrl}" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                    <button type="button" 
                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image" 
                data-type="preview"
                style="border-radius:50%;">×</button>
                </div>
                `;

            imageBox.find('.product-img img').attr('src', imgUrl)

            // $('#image-wrapper').prepend(imgHtml);

          } else {

            let imgHtml = `
                <div class="position-relative d-inline-block mt-2" style="width:100px;">
                    <img src="${imgUrl}" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                </div>
                `;

            imageBox.find('.featured-product-img img').attr('src', imgUrl)

            // $('#image-wrapper-featured').html(imgHtml);
            $("#featured-upload-box").hide();
          }
        };

        reader.readAsDataURL(file); // convert to base64
      });
    });


    // When user selects images
    $('.imageuploadtemp').on('change', function(e) {
      let files = e.target.files;
      let checked_name = $(this).data('checkname');

      $.each(files, function(index, file) {

        let reader = new FileReader();

        reader.onload = function(event) {
          let imgUrl = event.target.result; // base64 image

          if (checked_name === 'others') {

            let imgHtml = `
                <div class="remove-box  position-relative d-inline-block mt-2" style="width:100px;">
                    <img src="${imgUrl}" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                    <button type="button" 
                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image" 
                data-type="preview"
                style="border-radius:50%;">×</button>

                    <div class="error-show remove-alt-text">
                      <input type="text" name="new_alt_text[]" class="form-control mt-2" placeholder="Enter alt text for SEO">
                      <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('new_alt_text'); ?></span>
                    </div>
                </div>
                `;

            $('#image-wrapper').prepend(imgHtml);

          } else {

            let imgHtml = `
                <div class="position-relative d-inline-block mt-2" style="width:100px;">
                    <img src="${imgUrl}" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                   <button type="button" 
                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image" 
                data-type="featured_preview"
                style="border-radius:50%;">×</button>

                    <div class="error-show">
                        <input type="text" name="alt_featured_text" class="form-control mt-2" placeholder="Enter alt text for SEO">
                        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('alt_featured_text'); ?></span>
                    </div>
                </div>
                `;

            $('#image-wrapper-featured').html(imgHtml);
            $("#featured-upload-box").hide();
          }
        };

        reader.readAsDataURL(file); // convert to base64
      });
    });


    $(document).on('click', "#featured-del-btn", function() {
      $("#featured-upload-box").show();
    });

    // When user clicks × to remove an image
    $(document).on('click', '.remove-image', function() {

      let type = $(this).data('type');
      let parentDiv = $(this).closest('div');

      // ⭐ CASE 1 : REMOVE PREVIEW (NO AJAX)
      if (type === 'preview') {

        //  $(this).closest(".remove-box").remove();

        // $(this).closest('.remove-box').remove();
        parentDiv.remove();


        return;
      }
      if (type === 'featured_preview') {
        $("#featured-upload-box").show();
        parentDiv.remove();
        return;
      }

      // ⭐ CASE 2 : REMOVE DB IMAGE (WITH AJAX)
      let filename = $(this).data('file');
      let id = $(this).data('id');

      $.ajax({
        url: "<?= base_url('admin/Product/delete_image'); ?>",
        type: "POST",
        data: {
          filename: filename,
          id: id
        },
        success: function(response) {
          let res = JSON.parse(response);

          if (res.status === "success") {
            parentDiv.remove();
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
    });




  });
</script>