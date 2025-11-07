<h1>single view</h1>
<?php
if(!empty($product)){?>
    <p><strong>ID:</strong> <?= $product->id; ?></p>
    <p><strong>Name:</strong> <?= $product->name; ?></p>
    <p><strong>Price:</strong> <?= $product->price; ?></p>
    <p><strong>Description:</strong> <?= $product->description; ?></p>
<?php }else{ 
    echo "No data";
}
?>