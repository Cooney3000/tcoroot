<?php
if (isset($articles)) {
    foreach ($articles as $article) : 
        $articleId = "$color-" . strtolower(str_replace(' ', '-', $article['name'])); // Erstelle eine eindeutige ID basierend auf dem Artikelnamen
        $canBeLabeled = $article['can_be_labeled'] ?? false; // Lade den Wert von can_be_labeled für diesen Artikel
?>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <img src="<?= $article['image'] ?>" class="card-img-top" alt="<?= $article['name'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $article['name'] ?></h5>
                    <p class="card-text"><?= $article['description'] ?></p>
                    <div class="mb-2">
                        <?php
                        foreach ($article['variants'] as $variantName => $variant) {
                            echo "<strong>$variantName:</strong><br>";
                            if (is_array($variant['price'])) {
                                foreach ($variant['price'] as $size => $price) {
                                    echo "$size: " . number_format($price, 2, ',', '.') . " €<br>";
                                }
                            } else {
                                echo number_format($variant['price'], 2, ',', '.') . " €<br>";
                            }
                        }
                        ?>
                    </div>
                    <a href="#" class="toggle-sizes" data-target="sizes-<?= $articleId ?>">Größen &#9660;</a>
                    <div id="sizes-<?= $articleId ?>" style="display: none;">
                        <?php
                        foreach ($article['variants'] as $variantName => $variant) {
                            foreach ($variant['sizes'] as $size) {
                                $price = is_array($variant['price']) ? $variant['price'][$size] : $variant['price'];
                                $inputName = "{$article['name']}_{$variantName}_{$size}";

                                $savedQuantity = $savedOrderDetails[$color][$article['name']][$variantName][$size]['quantity'] ?? 0;
                                $savedComment = $savedOrderDetails[$color][$article['name']][$variantName][$size]['comment'] ?? '';

                                echo "<label>$variantName $size</label>";
                                echo "<input type='number' name='$inputName' data-price='$price' min='0' placeholder='$size' value='$savedQuantity' class='form-control quantity-input mb-2'>";
                                if ($canBeLabeled) {
                                    echo "<textarea name='comment_{$inputName}_$color' placeholder='Beschriftung' class='form-control mb-2'>$savedComment</textarea>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="article-total">0,00</span><br>
                </div>
            </div>
        </div>
    <?php endforeach;
}
?>
