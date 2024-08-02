<?php
# In der Navigation den aktuellen Menüpunkt auf bold setzen
function setNavigation($current) {
    $navigation = [
        'aktuell' => '',
        'verein' => '',
        'mannschaften' => '',
        'jugend' => '',
        'training' => ''
    ];
    $navigation[$current] = 'navcurrent';
    return $navigation;
}

function fetchMessage($file) {
    if (!file_exists($file)) return ["", "hidden"];
    $content = file_get_contents($file);
    $date = substr($content, 0, 8);
    $message = substr($content, 9);
    $cssClass = (date("d.m.y") != $date || trim($message) == "") ? "hidden" : "";
    return [$message, $cssClass];
}

function getRestaurantStatus($file) {
    if (!file_exists($file)) return ['geschlossen', 'hidden', '0'];
    $line = trim(file_get_contents($file));
    $status = substr($line, 0, 1);
    $activeStatus = substr($line, 1, 1);
    $statusDate = substr($line, 2, 8);
    $statusClass = ($status == '1') ? "btn-success" : "btn-danger";
    $statusText = ($statusDate == date("d.m.y")) ? (($status == '1') ? "geöffnet" : "geschlossen") : "geschlossen";
    return [$statusText, $statusClass, $activeStatus];
}
?>
