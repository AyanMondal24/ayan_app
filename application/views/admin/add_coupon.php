<div class="container add-form">
    <h2 class="text-center">Add Coupon</h2>

    <form action="<?= base_url('admin/coupons/store') ?>" method="post" enctype="multipart/form-data" class="p-2" id="coupon-form">

        <div class="row">
            <!-- Coupon Code -->

            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                <label>Coupon Code <sup>*</sup></label>
                <input type="text" name="code" class="form-control" >
                 <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('code'); ?></span>
            </div>

            <!-- Discount Type -->
            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                <label>Discount Type <sup>*</sup></label>
                <select name="discount_type" class="form-control" >
                    <option value="">Select Type</option>
                    <option value="percentage">Percentage (%)</option>
                    <option value="fixed">Fixed Amount</option>
                </select>
                 <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('discount_type'); ?></span>
            </div>

            <!-- Discount Value -->
            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                <label>Discount Value <sup>*</sup></label>
                <input type="number" name="discount_value" step="0.01" class="form-control" >
                 <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('discount_value'); ?></span>
            </div>

            <!-- Minimum Purchase -->
            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                <label>Minimum Purchase</label>
                <input type="number" name="min_purchase" step="0.01" class="form-control">
            </div>

            <!-- Start Date -->
            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                <label>Start Date <sup>*</sup></label>
                <input type="date" name="start_date" class="form-control" >
                 <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('start_date'); ?></span>
            </div>

            <!-- Expiry Date -->
            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                <label>Expiry Date <sup>*</sup></label>
                <input type="date" name="expiry_date" class="form-control" >
                 <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('expiry_date'); ?></span>
            </div>

            <!-- Status -->
            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                <label>Status <sup>*</sup></label>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
              <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('status'); ?></span>
            </div>

            <div class="form-group col-md-6 col-lg-6 col-sm-12 d-flex flex-column">
                <label for="">Image </label>
                <label for="image" class="upload-box">
                    <div id="previewContainer" class="upload-box mt-4 border rounded d-flex align-items-center justify-content-center"
                        style="width:100%;height:300px;cursor:pointer; overflow:hidden; position:relative;">

                        <!-- Preview Image (initially hidden) -->
                        <img id="previewImage" src=""
                            style="width:100%;height:100%;object-fit:cover;display:none; border-radius:10px;">
                        <button id="removeBtn" type="button" class="btn btn-danger" style="display:none; border-radius:50%; position: absolute; top:0px; right:0px;">X</button>
                        <!-- Plus Icon -->
                        <i id="uploadIcon" class="bi bi-plus-lg fs-3 text-primary"></i>
                    </div>
                </label>

                <input type="file" name="image" class="form-control d-none" accept="image/*" id="image" >
                 <span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;" class="error-text"><?php echo form_error('image'); ?></span>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Save Coupon</button>
    </form>
    <div id="response-msg"></div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        $("#coupon-form").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    // if(response)
                       $('span.error-text').html('');
                    if(response.status==='error'){
                        $.each(response.errors,function(field,message){
                            $(`[name='${field}']`).closest('.form-group').find('span.error-text').html(message)
                        });
                        $("#response-msg")
                        .addClass('error-msg')
                        .removeClass('success-msg')
                        .html(response.message || "Validation failed.")
                        .fadeIn(200)
                        .delay(3000)
                        .fadeOut(200);
                    }else if(response.status === 'success'){
                        $("#coupon-form").trigger('reset');
                         $("#response-msg")
                        .addClass('success-msg')
                        .removeClass('error-msg')
                        .html(response.message)
                        .fadeIn(200)
                        .delay(3000)
                        .fadeOut(200);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                }
            })
        })
        // image preview 
        $("#image").on("change", function(event) {
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $("#previewImage").attr("src", e.target.result).show();
                    $("#uploadIcon").hide(); // hide plus icon
                    $("#removeBtn").show();
                };

                reader.readAsDataURL(file);
            }
        });

        // remove image 
        $("#removeBtn").on('click', function(e) {
            $("#previewImage").hide().attr("src", "");
            $("#uploadIcon").show();
            $("#removeBtn").hide();
            $("#image").val(""); // Reset file input
        })
    })
</script>