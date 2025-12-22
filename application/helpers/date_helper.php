<?php
function smart_order_date($datetime)
{
    if (empty($datetime)) return '';

    $date = new DateTime($datetime);
    $now  = new DateTime();

    // Same year & same month
    if ($date->format('Y-m') === $now->format('Y-m')) {
        return $date->format('M d, h:i A'); // Sep 25, 03:40 PM
    }

    // Same year, different month
    if ($date->format('Y') === $now->format('Y')) {
        return $date->format('d M, h:i A'); // 25 Sep, 03:40 PM
    }

    // Different year
    return $date->format('d M Y, h:i A'); // 25 Sep 2024, 03:40 PM
}
