<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('upload_multiple_product_images')) {

    function upload_multiple_product_images($alt_texts, $perm_folder, $product_id, $model)
    {
        $CI = &get_instance();
        $CI->load->helper('file');

        $errors = [];
        $insert_status = false;

        // $rowImages = isset($_FILES['images']['name']) ? $_FILES['images']['name'] : [];
        $rowImages = isset($_FILES['images']['name']) ?
            str_replace(' ', '_', $_FILES['images']['name']) : [];
        if (!empty($alt_texts)) {

            foreach ($alt_texts as $index => $alt) {

                $alt_text = isset($alt_texts[$index]) ? $alt_texts[$index] : [];

                // File name with no spaces
                // $imgName = str_replace(' ', '_', $imgName);
                $rowImages = isset($_FILES['images']['name']) ?
                    str_replace(' ', '_', $_FILES['images']['name']) : [];

                $prefix = 'product_';
                $unique_file = uniqid();
                $ext = pathinfo($rowImages[$index], PATHINFO_EXTENSION);

                $new_file = $prefix . $unique_file . "." . $ext;

                // Upload path
                $destination = $perm_folder . $new_file;
                $tmp_name = $_FILES['images']['tmp_name'][$index];

                // Upload main/original
                if (move_uploaded_file($tmp_name, $destination)) {

                    // Create image copies
                    create_image_copy(
                        FCPATH . 'assets/uploads/products/',
                        $new_file,
                        150,
                        150,
                        'thumb'
                    );

                    create_image_copy(
                        FCPATH . 'assets/uploads/products/',
                        $new_file,
                        600,
                        600,
                        'medium'
                    );

                    // ALT text

                    $image_data = [
                        'product_id'  => $product_id,
                        'image_name'  => $new_file,
                        'alt_text'    => $alt_text,
                        'is_featured' => 1
                    ];

                    // INSERT INTO DB
                    if ($model->SetProductImages($image_data)) {

                        $insert_status = true;
                    } else {

                        // DELETE FROM ORIGINAL
                        if (file_exists($destination)) {
                            unlink($destination);
                        }

                        // DELETE FROM MEDIUM
                        $mediumPath = FCPATH . 'assets/uploads/products/medium/' . $new_file;
                        if (file_exists($mediumPath)) {
                            unlink($mediumPath);
                        }

                        // DELETE FROM THUMB
                        $thumbPath  = FCPATH . 'assets/uploads/products/thumb/' . $new_file;
                        if (file_exists($thumbPath)) {
                            unlink($thumbPath);
                        }

                        $errors[] = "DB insert failed index[$index] file: $new_file alt: $alt_text";
                    }
                } else {

                    $errors[] = "Upload failed for: $destination";
                }
            }
        }

        return [
            'status' => $insert_status,
            'errors' => $errors
        ];
    }
}


// -----------------------------------------------------------
// Create resized version
// -----------------------------------------------------------
function create_image_copy($upload_path, $file_name, $width, $height, $folder)
{
    $CI = &get_instance();
    $CI->load->library('image_lib');

    $source_path = $upload_path . 'original/' . $file_name;
    $new_path    = $upload_path . $folder . '/' . $file_name;

    // Make sure folder exists
    if (!is_dir($upload_path . $folder)) {
        mkdir($upload_path . $folder, 0777, true);
    }

    $config = [
        'image_library'  => 'gd2',
        'source_image'   => $source_path,
        'new_image'      => $new_path,
        'maintain_ratio' => true,
        'width'          => $width,
        'height'         => $height,
        'quality'        => '90'
    ];

    // VERY IMPORTANT
    $CI->image_lib->clear();
    $CI->image_lib->initialize($config);

    if (!$CI->image_lib->resize()) {
        echo "ERROR ($folder): " . $CI->image_lib->display_errors();
        return false;
    }

    return true;
}

// for thumb size image 
function resize_image_single($file_path, $width, $height)
{
    $CI = &get_instance();
    $CI->load->library('image_lib');

    $config = [
        'image_library'  => 'gd2',
        'source_image'   => $file_path,   // Same file
        'new_image'      => $file_path,   // Overwrite same file
        'maintain_ratio' => TRUE,
        'width'          => $width,
        'height'         => $height,
        'quality'        => '90'
    ];

    $CI->image_lib->clear();
    $CI->image_lib->initialize($config);

    if (!$CI->image_lib->resize()) {
        log_message('error', 'Image Resize Error: ' . $CI->image_lib->display_errors());
        return false;
    }

    return true;
}
