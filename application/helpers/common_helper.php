<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Long, reversible, and URL-safe encoder/decoder
 * No %, /, +, or = characters
 */
if (!function_exists('encrypt_url')) {
    function encrypt_url($id)
    {
        $secret = 'Ayan@2025_SecretKey!#123'; // You can store in config
        $encoded = bin2hex($id); // Convert to hex (reversible)
        $token = hash_hmac('sha256', $encoded, $secret);
        return $encoded . $token; // Append signature for extra length & integrity
    }
}

if (!function_exists('decrypt_url')) {
    function decrypt_url($code)
    {
        $secret = 'Ayan@2025_SecretKey!#123';
        $encoded = substr($code, 0, 2 * ceil(strlen($code) / 3)); // extract the encoded part
        // remove appended hash if present
        $encoded = preg_replace('/[^0-9a-f]/i', '', $encoded);
        return hex2bin($encoded);
    }
}
