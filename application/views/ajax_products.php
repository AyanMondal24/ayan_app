
<?php

foreach ($products as $product) { ?>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="rounded position-relative fruite-item">
            <div class="fruite-img border border-secondary border-bottom-0" style="width: 100%; height:260px;">
                <img src="<?= base_url('assets/uploads/products/'. $product->image_name) ?>"
                     class="img-fluid w-100 rounded-top"
                     style="width:100%; height:100%; object-fit:cover;">
            </div>
            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top:10px; left:10px;">
                <?= $product->category_name ?>
            </div>
            <div class="p-4 border border-secondary rounded-bottom">
                <h4><?= $product->product_name ?></h4>
                <p><?= mb_substr(strip_tags($product->description), 0, 130) . '...' ?></p>
            </div>
        </div>
    </div>
<?php } ?>
