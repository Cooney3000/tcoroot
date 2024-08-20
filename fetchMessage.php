<?php
function fetchMessage($filePath) {
    $nachricht = '';
    $smsMsgClass = '';

    if (file_exists($filePath)) {
        $nachricht = file_get_contents($filePath);
        $smsMsgClass = !empty($nachricht) ? 'active' : '';
    }

    return [$nachricht, $smsMsgClass];
}
