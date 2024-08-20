<?php
function getRestaurantStatus($filePath) {
    $statusText = '';
    $statusClass = '';
    $aktivStatus = '0';

    if (file_exists($filePath)) {
        $statusData = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!empty($statusData)) {
            list($statusText, $statusClass, $aktivStatus) = explode('|', $statusData[0]);
        }
    }

    return [$statusText, $statusClass, $aktivStatus];
}
