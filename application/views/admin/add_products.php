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
          <option value="0" <?= set_select('status', '0', (@$product->status == '0')) ?>>Available</option>
          <option value="1" <?= set_select('status', '1', (@$product->status == '1')) ?>>Unavailable</option>
        </select>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('is_available'); ?></span>
      </div>
      <div class="col-12 error-show mt-2 mb-2">
        <label for="description" class="form-label">Description <sup>*</sup></label>
        <textarea class="form-control" aria-label="With textarea" name="description" rows="3" id="description"><?= set_value('description', @$product->description) ?></textarea>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('description'); ?></span>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Product Images <span class="text-danger">*</span></label>
      <div id="image-wrapper" class="d-flex flex-wrap gap-3">
        <!-- The "+" box -->
        <div class="image-upload-box ">

          <div class="d-flex">
            <?php if (!empty($product->id)) {
              foreach ($images as $img) { ?>
                <!-- IMAGE  -->
                <div class="image-box position-relative d-inline-block mt-2 me-2" style="width:100px;">
                  <div class="product-img">
                    <img src="<?= base_url('assets/uploads/products/' . $img->image_name) ?>" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                  </div>
                  <!-- CHANGE BUTTON (Shown on Hover) -->
                  <label class="change-btn translate-middle text-white bg-dark bg-opacity-75 px-2 py-1 rounded"
                    for="updateImageInput_<?= $img->id ?>"
                    style="position:absolute;top:50px; left:50px; font-size:12px;cursor:pointer;opacity:0;transition:opacity 0.3s;z-index:2;">
                    Change
                  </label>
                  <input type="file" class="updateImageInput d-none" data-id="<?= $img->id ?>" id="updateImageInput_<?= $img->id ?>" name="uploadchangeimage[]">


                  <!-- REMOVE BUTTON  -->
                  <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image" data-file="<?= $img->image_name ?>" data-id="<?= $img->id ?>" style="border-radius:50%;">×</button>

                  <!-- HIDDEN FIELD STORE IMAGE AND IMAGE ID -->
                  <input type="hidden" name="uploaded_temp[]" value="<?= $img->image_name ?>">
                  <input type="hidden" name="image_id[]" value="<?= $img->id ?>">
                  <!-- IMAGE ALT TEXT  -->
                  <div class="error-show">
                    <input type="text" name="alt_text[]" class="form-control mt-2" placeholder="Enter alt text for SEO" value="<?= $img->alt_text ?>">
                    <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('alt_text'); ?></span>
                  </div>
                  <!-- IMAGE TYPES  -->
                  <div class="error-show">
                    <select class="form-select" aria-label="Default select example" name="image_type[]">
                      <option value="">Choose Types</option>
                      <option value="main" <?= set_select('image_type',  'main', (@$img->image_type == 'main')) ?>>Main</option>
                      <option value="gallery" <?= set_select('image_type',  'gallery', (@$img->image_type == 'gallery')) ?>>Gallery</option>
                      <option value="thumb" <?= set_select('image_type',  'thumb', (@$img->image_type == 'thumb')) ?>>Thumb</option>
                    </select>
                    <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('image_type'); ?></span>
                  </div>
                </div>
            <?php }
            } ?>
          </div>
          <label for="imageInput" class="upload-box">
            <div class="upload-box mt-4 border rounded d-flex align-items-center justify-content-center" style="width:100px;height:100px;cursor:pointer;">
              <i class="bi bi-plus-lg fs-3 text-primary"></i>
            </div>
          </label>
          <div class="error-show">
            <input type="file" id="imageInput" name="images[]" class="d-none" multiple>
            <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('images'); ?></span>
          </div>

        </div>
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
                  console.log('Non-indexed span found:', errorSpan.length > 0); // DEBUG
                  errorSpan.html(msg);
                }
              });
            }

            $("#response-msg")
              .addClass('error-msg')
              .removeClass('success-msg')
              .html(response.msg || "Validation failed.")
              .fadeIn(300)
              .delay(3000)
              .fadeOut(500);

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
              .html(response.msg || "Saved successfully!")
              .fadeIn(300)
              .delay(2000)
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
      });
    });



    // update page 
    $(document).on('change', '.updateImageInput', function(e) {
      const file = e.target.files[0];
      // let id=$(this).data('id');
      if (!file) return;

      const input = $(this);
      const imageBox = input.closest('.image-box');
      const formData = new FormData();
      formData.append('uploadchangeimage', file);
      // formData.append('id', id);

      $.ajax({
        url: '<?= base_url("admin/Product/upload_temp_image_update"); ?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          // console.log(response);
          let res;
          try {
            res = JSON.parse(response);
          } catch (e) {
            console.error('Invalid JSON:', response);
            return;
          }

          if (res.status === 'success') {
            // console.log(res.id)
            // ✅ Replace the image src directly
            imageBox.find('.product-img img').attr('src', res.url);

            // imageBox.append(`<input type="hidden" name="image_unique_id[]" value="${res.id}">`);
            // ✅ Optionally update hidden field
            imageBox.find('input[name="uploaded_temp[]"]').val(res.file);

          } else {
            alert(res.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
        }
      });
    });


    // When user selects images
    $('#imageInput').on('change', function(e) {
      const files = e.target.files;
      // console.log(files)
      $.each(files, function(index, file) {
        let formData = new FormData();
        formData.append('images', file);

        $.ajax({
          url: '<?= base_url("admin/Product/upload_temp_image"); ?>',
          type: 'POST',
          data: formData,
          // dataType:'JSON',
          contentType: false,
          processData: false,
          success: function(response) {
            // console.log(response)
            let res = JSON.parse(response);
            if (res.status == 'success') {
              let imgHtml = `
              <div class="position-relative d-inline-block mt-2" style="width:100px;">
                <img src="${res.url}" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image" data-file="${res.filename}" style="border-radius:50%;">×</button>
                <input type="hidden" name="uploaded_temp[]" value="${res.filename}">
                <div class="error-show">
                  <input type="text" name="alt_text[]" class="form-control mt-2" placeholder="Enter alt text for SEO" >
                  <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('alt_text'); ?></span>
                </div>
                <div class="error-show">
                  <select class="form-select" aria-label="Default select example" name="image_type[]">
                    <option value="">Choose Types</option>
                    <option value="main">Main</option>
                    <option value="gallery">gallery</option>
                    <option value="thumb">Thumb</option>
                  </select>
                  <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('image_type'); ?></span>
                </div>
              </div>`;
              $('#image-wrapper').prepend(imgHtml);
            } else {
              alert(res.message);
            }
          }
        });
      });
    });

    // When user clicks × to remove an image
    $(document).on('click', '.remove-image', function() {
      let filename = $(this).data('file');
      let id = $(this).data('id');
      let parentDiv = $(this).closest('div');

      $.ajax({
        url: '<?= base_url("admin/Product/delete_temp_image"); ?>',
        type: 'POST',
        data: {
          filename: filename,
          id: id
        },
        success: function(response) {
          let res = JSON.parse(response);
          if (res.status === 'success') {
            parentDiv.remove();
          } else {
            alert('Failed to delete image');
          }
        }
      });

    });




  });
</script>