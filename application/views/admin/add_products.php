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
      <div class="col-12 col-md-6 col-lg-8 error-show">
        <label for="description" class="form-label">Description <sup>*</sup></label>
        <textarea class="form-control" aria-label="With textarea" name="description" rows="3"><?= set_value('description', @$product->description) ?></textarea>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('description'); ?></span>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Product Images <span class="text-danger">*</span></label>
      <div id="image-wrapper" class="d-flex flex-wrap gap-3">
        <!-- The "+" box -->
        <div class="image-upload-box ">
         
          <div class="d-flex ">
          <?php if (!empty($product->id)) {
            foreach ($images as $img) { ?>
              <div class="position-relative d-inline-block mt-2 me-2" style="width:100px;">
                <img src="<?= base_url('assets/uploads/products/' . $img->image_name) ?>" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image" data-file="<?= $img->image_name ?>" style="border-radius:50%;">×</button>
                <input type="hidden" name="uploaded_temp[]" value="<?= $img->image_name ?>">
                <div class="error-show">
                  <input type="text" name="alt_text[]" class="form-control mt-2" placeholder="Enter alt text for SEO" value="<?= $img->alt_text ?>">
                  <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('alt_text'); ?></span>
                </div>
              </div>
          <?php }
          } ?>
          </div>
           <label for="imageInput" class="upload-box">
            <div class="upload-box border rounded d-flex align-items-center justify-content-center" style="width:100px;height:100px;cursor:pointer;">
              <i class="bi bi-plus-lg fs-3 text-primary"></i>
            </div>
          </label>
          <div class="error-show">
            <input type="file" id="imageInput" name="images[]" class="d-none" multiple >
            <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('images'); ?></span>
          </div>
      

          <!-- <input type="hidden" name="uploaded_temp[]" value=""> -->
          <div id="hidden-files"></div>
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
  document.addEventListener('DOMContentLoaded', function() {

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
            console.log(response)
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
      let parentDiv = $(this).closest('div');

      $.ajax({
        url: '<?= base_url("admin/Product/delete_temp_image"); ?>',
        type: 'POST',
        data: {
          filename: filename
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



    $('#add-product').on('submit', function(e) {
      e.preventDefault();

      const form = new FormData(this);

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: form,
        dataType: 'JSON',
        processData: false, // ✅ important
        contentType: false, // ✅ important
        success: function(response) {
          console.log(response);
          // console.log(response)
          $('span.error-text').html('');
          if (response.status === 'error') {
            $.each(response.errors, function(field, message) {
              $(`[name="${field}"]`)
                .closest('.error-show')
                .find('span')
                .html(message);
            });
          } else if (response.status === 'success') {
            $("#add-product")[0].reset();
            location.reload(true);
            $("#response-msg")
              .addClass('success-msg')
              .removeClass('error-msg')
              .html("Data Successfully Submitted.")
              .fadeIn(500)
              .delay(5000)
              .fadeOut(500);

          } else if (response.status === 'update') {
            $("#add-product")[0].reset();
            location.reload(true);
            $("#response-msg")
              .addClass('success-msg')
              .removeClass('error-msg')
              .html("Data Successfully Updated.")
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
      });
    });
  });
</script>