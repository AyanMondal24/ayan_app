<div class="container add-products">
  <h2 class="text-center">Adding Products</h2>
  <hr>
  <form action="<?= site_url('/admin/save-product') ?>" method="post" enctype="multipart/form-data" id="add-product" class=" p-2 rounded">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <label for="name" class="form-label">Name <sup>*</sup></label>
        <input type="text" class="form-control" id="name" name="name" />
        <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('name'); ?></span>
      </div>
      
      <div class="col-12 col-md-6 col-lg-4">
        <label for="price" class="form-label">Price Per Unit<sup>*</sup></label>
        <input type="text" class="form-control" id="price" name="price" />
        <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('price'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="quantity" class="form-label">Quantity <sup>*</sup></label>
        <input type="text" class="form-control" id="quantity" name="quantity" />
        <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('quantity'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="image" class="form-label">Image <sup>*</sup></label>
        <input type="file" class="form-control" id="image" name="image" />
        <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('image'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="category" class="form-label">Category <sup>*</sup></label>
        <select class="form-select" aria-label="Default select example" name="category">
          <option value="">Choose Category</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('category'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="status" class="form-label">Active Or Deactive <sup>*</sup></label>
        <select class="form-select" aria-label="Default select example" name="status">
          <option value="">Choose Status</option>
          <option value="0">Active</option>
          <option value="1">Deactive</option>
        </select>
        <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('status'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="status" class="form-label">Available Or Not <sup>*</sup></label>
        <select class="form-select" aria-label="Default select example" name="is_available">
          <option value="">Choose Status</option>
          <option value="0">Available</option>
          <option value="1">Not Available</option>
        </select>
        <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('is_available'); ?></span>
      </div>
      <div class="col-12 col-md-6 col-lg-8">
        <label for="description" class="form-label">Description <sup>*</sup></label>
        <textarea class="form-control" aria-label="With textarea" name="description" rows="3"></textarea>
            <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;"><?php echo form_error('description'); ?></span>
      </div>
    </div>
    <div class="mt-2 mb-2 col-12">
      <input type="submit" name="submit" value="Submit" class="form-control btn btn-primary w-25 text-light">
    </div>
  </form>
</div>

