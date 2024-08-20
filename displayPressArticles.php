<?php
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
                    </a>
                </div>
            </div>';
    }

    echo '      </div>
            </div>
        </div>';
}
