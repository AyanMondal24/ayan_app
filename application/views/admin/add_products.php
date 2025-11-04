<form action="<?= site_url('/admin/save-product') ?>" method="post">
   <div class="mb-2">
     <label for="title"> Title</label>
    <input type="text" name="title" class="form-control">
   </div>
   <div class="mb-2">
     <label for="desc"> Description</label>
    <input type="text" name="desc" class="form-control">
   </div>
   <div class="mb-2">
    
    <input type="submit" name="submit" value="Submit" class="form-control btn btn-primary">
   </div>
</form>