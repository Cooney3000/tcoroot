<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Bestellformular TC Olching 2024</title>
</head>

<body>
    <h1>Bestellformular TC Olching 2024 - WEISS</h1>
    <form action="submit-order.php" method="POST">
        <table border="1">
            <thead>
                <tr>
                    <th>Artikel</th>
                    <th>Preis in €</th>
                    <th>Anzahl/Größe</th>
                    <th>Bestellbetrag in €</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $articles = [
                    "Schwarz",
                    [
                        [
                            'name' => 'T-Shirt Herren',
                            'description' => '100% Polyester<br>Größe XS-XXL',
                            'price' => 18.50,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'T-Shirt Kinder',
                            'description' => 'Größe XS (3/4J), S (5/6J), M (7/8J), L (9/11J), XL (12/13J)',
                            'price' => 18.50,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL']
                        ],
                        [
                            'name' => 'T-Shirt Damen',
                            'description' => '100% Polyester<br>Größe XS -XL',
                            'price' => 18.50,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL']
                        ],
                        [
                            'name' => 'Polo Herren',
                            'description' => '100% Baumwolle<br>Größe S-3XL',
                            'price' => 27.50,
                            'sizes' => ['S', 'M', 'L', 'XL', 'XXL', '3XL']
                        ],
                        [
                            'name' => 'Polo Damen',
                            'description' => '100% Baumwolle<br>Größe S-XXL',
                            'price' => 27.50,
                            'sizes' => ['S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'BIO Hoodie Unisex',
                            'description' => '80% Bio-Baumwolle, 20% Recycelter Polyester<br>Größe XS-3XL',
                            'price' => 43.00,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL']
                        ],
                        [
                            'name' => 'BIO Hoodie Kinder',
                            'description' => '80% Bio-Baumwolle, 20% Recycelter Polyester<br>Größe XXS (1/2J), XS (3/4J), M (5/6J), M (7/8J), L (9/11J), XL (12/13J)',
                            'price' => 36.50,
                            'sizes' => ['XXS', 'XS', 'M', 'L', 'XL']
                        ],
                        [
                            'name' => 'BIO Hoodiejacke Unisex',
                            'description' => '80% Bio-Baumwolle, 20% Recycelter Polyester<br>Größe XS-XXL',
                            'price' => 50.00,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'BIO Hoodiejacke Kids',
                            'description' => '100% Bio-Baumwolle<br>Größe 92/98; 104/110; 116/122; 128/134; 140/146; 152/158',
                            'price' => 56.00,
                            'sizes' => ['92/98', '104/110', '116/122', '128/134', '140/146', '152/158']
                        ],
                        [
                            'name' => 'Hoodie Kinder',
                            'description' => '80% Baumwolle, 20% Polyester<br>Größe XS (3/4J), S (5/6J), M (7/8J), L (9/11J), XL (12/13J)',
                            'price' => 34.00,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL']
                        ],
                        [
                            'name' => 'Tank Top Damen',
                            'description' => '100% Polyester<br>Größe XS-XXL',
                            'price' => 18.50,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'Shorts schwarz',
                            'description' => '100% Polyester<br>Größe XS-XXL',
                            'price' => 20.00,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'Tennisrock schwarz',
                            'description' => 'Außen: 100% Polyester<br>Innen: 95% Baumwolle, 5% Elasthan<br>Größe 36-44',
                            'price' => 23.00,
                            'sizes' => ['36', '38', '40', '42', '44']
                        ],
                        [
                            'name' => 'Caps',
                            'description' => 'Erwachsene und Kinder',
                            'price' => 11.00,
                            'sizes' => ['Erwachsene', 'Kinder']
                        ],
                        [
                            'name' => 'Shield',
                            'description' => '100% Baumwolle, Schweißband: 100% Polyester',
                            'price' => 11.50,
                            'sizes' => []
                        ],
                        [
                            'name' => 'Handtuch 100% BW, Oekotex 100, 550 gr./qm',
                            'description' => 'klein: 30*50cm, groß: 70*140cm',
                            'price' => ['klein' => 11.00, 'groß' => 27.00],
                            'sizes' => ['klein', 'groß']
                        ],
                        [
                            'name' => 'Jogginghose schwarz',
                            'description' => '80% BW, 50% Polyester<br>Damen: XS-3XL<br>Herren: S-XXL<br>Kinder: 50% BW/50%Poly<br>Größe 104, 116, 128, 140, 152',
                            'price' => ['Damen' => 47.00, 'Herren' => 41.00, 'Kinder' => 26.00],
                            'sizes' => ['Damen XS-3XL', 'Herren S-XXL', 'Kinder 104', 'Kinder 116', 'Kinder 128', 'Kinder 140', 'Kinder 152']
                        ]
                    ],
                    "Weiß",
                    [
                        [
                            'name' => 'T-Shirt Herren',
                            'description' => '100% Polyester<br>Größe XS-XXL',
                            'price' => 18.50,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'T-Shirt Kinder',
                            'description' => 'Größe XS (3/4J), S (5/6J), M (7/8J), L (9/11J), XL (12/13J)',
                            'price' => 18.50,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL']
                        ],
                        [
                            'name' => 'T-Shirt Damen',
                            'description' => '100% Polyester<br>Größe XS -XL',
                            'price' => 18.50,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL']
                        ],
                        [
                            'name' => 'Polo Herren/Damen',
                            'description' => '100% Baumwolle<br>Größe S-3XL',
                            'price' => 27.50,
                            'sizes' => ['S', 'M', 'L', 'XL', 'XXL', '3XL']
                        ],
                        [
                            'name' => 'Polo Damen',
                            'description' => '100% Baumwolle<br>Größe S-XXL',
                            'price' => 27.50,
                            'sizes' => ['S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'BIO Hoodie Unisex',
                            'description' => '80% Bio-Baumwolle, 20% Recycelter Polyester<br>Größe XS-3XL',
                            'price' => 43.00,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL']
                        ],
                        [
                            'name' => 'BIO Hoodie Kinder',
                            'description' => '80% Bio-Baumwolle, 20% Recycelter Polyester<br>Größe XXS (1/2J), XS (3/4J), M (5/6J), M (7/8J), L (9/11J), XL (12/13J)',
                            'price' => 36.50,
                            'sizes' => ['XXS', 'XS', 'M', 'L', 'XL']
                        ],
                        [
                            'name' => 'BIO Hoodiejacke Unisex',
                            'description' => '80% Bio-Baumwolle, 20% Recycelter Polyester<br>Größe XS-XXL',
                            'price' => 50.00,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'Hoodie Kinder',
                            'description' => '80% Baumwolle, 20% Polyester<br>Größe XS (3/4J), S (5/6J), M (7/8J), L (9/11J), XL (12/13J)',
                            'price' => 34.00,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL']
                        ],
                        [
                            'name' => 'Tank Top Damen',
                            'description' => '100% Polyester<br>Größe XS-XXL',
                            'price' => 18.50,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'Shorts schwarz',
                            'description' => '100% Polyester<br>Größe XS-XXL',
                            'price' => 20.00,
                            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
                        ],
                        [
                            'name' => 'Tennisrock schwarz',
                            'description' => 'Außen: 100% Polyester<br>Innen: 95% Baumwolle, 5% Elasthan<br>Größe 36-44',
                            'price' => 23.00,
                            'sizes' => ['36', '38', '40', '42', '44']
                        ],
                        [
                            'name' => 'Caps',
                            'description' => 'Erwachsene und Kinder',
                            'price' => 11.00,
                            'sizes' => ['Erwachsene', 'Kinder']
                        ],
                        [
                            'name' => 'Shield',
                            'description' => '100% Baumwolle, Schweißband: 100% Polyester',
                            'price' => 11.50,
                            'sizes' => []
                        ],
                        [
                            'name' => 'Handtuch 100% BW, Oekotex 100, 550 gr./qm',
                            'description' => 'klein: 30*50cm, groß: 70*140cm',
                            'price' => ['klein' => 11.00, 'groß' => 27.00],
                            'sizes' => ['klein', 'groß']
                        ]
                    ]
                ];


                foreach ($articles as $article) :
                ?>
                    <tr>
                        <td><?= $article['name'] ?><br><?= $article['description'] ?></td>
                        <td><?= number_format($article['price'], 2, ',', '.') ?></td>
                        <td>
                            <?php foreach ($article['sizes'] as $size) : ?>
                                <label><?= $size ?></label>
                                <input type="number" name="<?= $article['name'] ?>_<?= $size ?>" min="0" placeholder="<?= $size ?>">
                            <?php endforeach; ?>
                        </td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit">Bestellen</button>
    </form>
</body>

</html>