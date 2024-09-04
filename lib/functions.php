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
function displayPressArticles($imageDirectory) {
    $images = glob($imageDirectory . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    rsort($images, SORT_REGULAR);

    // Nur die letzten 8 Artikel anzeigen
    $images = array_slice($images, 0, 8);

    echo '<div class="container">
            <h2>Pressespiegel</h2>
            <div class="press-gallery-container">
                <div class="row">';

    foreach ($images as $image) {
        [$datum, $publikation, $titel] = explode('_', basename($image));
        $ttmmjjjj = substr($datum, 6, 2) . "." . substr($datum, 4, 2) . "." . substr($datum, 0, 4);

        echo '<div class="col-md-3 col-sm-6 mb-4">
                <div class="press-image-card">
                    <div class="press-image-date">' . htmlspecialchars($ttmmjjjj) . ' - ' . htmlspecialchars($publikation) . '</div>
                    <a href="' . htmlspecialchars($image) . '" target="_blank">
                        <div class="press-image-container">
                            <img src="' . htmlspecialchars($image) . '" alt="Bild" class="press-image-thumbnail">
                        </div>
                    </a>';

        // Zeige den Lösch-Button nur für Vorstandsmitglieder
        if (isset($_SESSION['permissions']) && checkPermissions(VORSTAND)) {
            echo '<form method="POST" action="lib/delete-press-article.php" class="delete-press-article-form mt-2" onsubmit="return confirm(\'Sind Sie sicher, dass Sie diesen Artikel löschen möchten?\');">
                    <input type="hidden" name="imagePath" value="' . htmlspecialchars($image) . '">
                    <button type="submit" class="btn btn-info btn-sm">Löschen</button>
                  </form>';
        }

        echo '</div>
            </div>';
    }

    echo '      </div>
            </div>
        </div>';
}

?>
