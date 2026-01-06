<?php
defined('BASEPATH') or exit('No direct script access allowed');

function make_slug($string)
{
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', '-', $string);
    return trim($string, '-');
}

function generate_unique_slug($title, $table, $slug_column = 'slug')
{
    $CI = &get_instance();
    $slug = make_slug($title);

    // Count same slugs (product, product-1, product-2 ...)
    $CI->db->like($slug_column, $slug, 'after');
    $count = $CI->db->count_all_results($table);

    // If exists → add count + 1
    if ($count > 0) {
        return $slug . '-' . ($count + 1);
    }

    return $slug;
}
