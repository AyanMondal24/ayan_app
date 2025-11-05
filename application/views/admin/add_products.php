<div class="container add-products">
  <h2 class="text-center">Adding Products</h2>
  <hr>
  <form action="<?= site_url('/admin/save-product') ?>" method="post" enctype="multipart/form-data" id="add-product" class=" p-2 rounded">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <label for="name" class="form-label">Name <sup>*</sup></label>
        <input type="text" class="form-control" id="name" name="name" />
        <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('name'); ?></span>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <label for="price" class="form-label">Price Per Unit<sup>*</sup></label>
        <input type="text" class="form-control" id="price" name="price" />
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('price'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="quantity" class="form-label">Quantity <sup>*</sup></label>
        <input type="text" class="form-control" id="quantity" name="quantity" />
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('quantity'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="image" class="form-label">Image <sup>*</sup></label>
        <input type="file" class="form-control" id="image" name="image" />
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('image'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="category" class="form-label">Category <sup>*</sup></label>
        <select class="form-select" aria-label="Default select example" name="category">
          <option value="">Choose Category</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('category'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="status" class="form-label">Active Or Deactive <sup>*</sup></label>
        <select class="form-select" aria-label="Default select example" name="status">
          <option value="">Choose Status</option>
          <option value="0">Active</option>
          <option value="1">Deactive</option>
        </select>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('status'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="status" class="form-label">Available Or Not <sup>*</sup></label>
        <select class="form-select" aria-label="Default select example" name="is_available">
          <option value="">Choose Status</option>
          <option value="0">Available</option>
          <option value="1">Not Available</option>
        </select>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('is_available'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-8">
        <label for="description" class="form-label">Description <sup>*</sup></label>
        <textarea class="form-control" aria-label="With textarea" name="description" rows="3"></textarea>
        <span class="error-text" style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('description'); ?></span>
      </div>
    </div>
    <!-- <input type="file" name="testimg" id="" accept="image/*"> -->
    <div class="mt-2 mb-2 col-12">
      <input type="submit" name="submit" value="Submit" class="form-control btn btn-primary w-25 text-light">
    </div>
  </form>

  <div id="response-msg"> </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
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
          $('span.error-text').html('');
          if (response.status === 'error') {
            $.each(response.errors, function(field, message) {
              $(`[name="${field}"]`)
                .closest('.col-12, .col-md-6, .col-lg-4, .col-lg-8')
                .find('span')
                .html(message);
            });
          } else if (response.status === 'success') {
            $("#add-product")[0].reset();
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

          // if (response == 0) {
          //   $("#add-product").trigger('reset');
          //   $("#response-msg").addClass('success-msg').removeClass('error-msg').html("Data Successfully Submitted.").fadeIn(500);
          //   setTimeout(() => {
          //     $("#response-msg").removeClass('success-msg error-msg').html("").fadeOut(500);
          //   }, 5000);
          // } else if (response == 1) {
          //   $("#response-msg").addClass('error-msg').removeClass('success-msg').html("Data Not Submitted.").fadeIn(500);
          //   setTimeout(() => {
          //     $("#response-msg").removeClass('success-msg error-msg').html("").fadeOut(500);
          //   }, 5000);
          // } else {
          //   //  $("#response-msg").addClass('error-msg').removeClass('success-msg').html(response).fadeIn(500);
          //   console.log(response)
          //   // setTimeout(() => {
          //   // $("#response-msg").removeClass('success-msg error-msg').html("").fadeOut(500);
          //   // }, 5000);
          // }
        },
        error: function(xhr) {
          console.error('Error:', xhr.responseText);
        }
      });
    });
  });
</script>