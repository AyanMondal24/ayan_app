<div class="container add-products">
  <h2 class="text-center">Adding Products</h2>
  <hr>
  <form action="<?= site_url('/admin/save-product') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" />
      </div>
      
      <div class="col-12 col-md-6 col-lg-4">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" id="price" name="price" />
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="text" class="form-control" id="quantity" name="quantity" />
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" />
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" aria-label="Default select example" name="category">
          <option selected>Choose Category</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="status" class="form-label">Active Or Deactive</label>
        <select class="form-select" aria-label="Default select example" name="status">
          <option >Choose Status</option>
          <option value="0">Active</option>
          <option value="1">Deactive</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <label for="status" class="form-label">Available Or Not </label>
        <select class="form-select" aria-label="Default select example" name="is_available">
          <option >Choose Status</option>
          <option value="0">Available</option>
          <option value="1">Not Available</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-lg-8">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" aria-label="With textarea" name="description" rows="3"></textarea>
      </div>
    </div>
    <div class="mt-2 mb-2">
      <input type="submit" name="submit" value="Submit" class="form-control btn btn-primary w-25">
    </div>
  </form>
</div>