<?php
$articles_schwarz = [
    // Schwarze Artikel
    [
        'name' => 'T-Shirt Herren',
        'description' => '100% Polyester<br>Größe XS-XXL',
        'variants' => [
            'Herren' => [
                'price' => 18.50,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
            ]
        ],
        'image' => 'schwarz/t-shirt-herren.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'T-Shirt Damen',
        'description' => '100% Polyester<br>Größe XS -XL',
        'variants' => [
            'Damen' => [
                'price' => 18.50,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL']
            ]
        ],
        'image' => 'schwarz/t-shirt-damen.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'Polo Herren/Damen',
        'description' => '100% Baumwolle<br>Größe S-3XL',
        'variants' => [
            'Herren' => [
                'price' => 27.50,
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL', '3XL']
            ],
            'Damen' => [
                'price' => 27.50,
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL']
            ]
        ],
        'image' => 'schwarz/polo-herren.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'BIO Hoodie Unisex',
        'description' => '80% Bio-Baumwolle, 20% Recycelter Polyester<br>Größe XS-3XL',
        'variants' => [
            'Unisex' => [
                'price' => 43.00,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL']
            ]
        ],
        'image' => 'schwarz/bio-hoodie-unisex.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'BIO Hoodie Kinder',
        'description' => '80% Bio-Baumwolle, 20% Recycelter Polyester<br>Größe XXS (1/2J), XS (3/4J), M (5/6J), M (7/8J), L (9/11J), XL (12/13J)',
        'variants' => [
            'Kinder' => [
                'price' => 36.50,
                'sizes' => ['XXS', 'XS', 'M', 'L', 'XL']
            ]
        ],
        'image' => 'schwarz/bio-hoodie-kids.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'BIO Jacke Unisex',
        'description' => '80% Bio-Baumwolle, 20% Recycelter Polyester<br>Größe XS-XXL',
        'variants' => [
            'Unisex' => [
                'price' => 50.00,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
            ]
        ],
        'image' => 'schwarz/bio-hoodiejacke-unisex.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'BIO Jacke Kids',
        'description' => '100% Bio-Baumwolle<br>Größe 92/98; 104/110; 116/122; 128/134; 140/146; 152/158',
        'variants' => [
            'Kinder' => [
                'price' => 56.00,
                'sizes' => ['92/98', '104/110', '116/122', '128/134', '140/146', '152/158']
            ]
        ],
        'image' => 'schwarz/bio-hoodiejacke-kids.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'Hoodie Kinder',
        'description' => '80% Baumwolle, 20% Polyester<br>Größe XS (3/4J), S (5/6J), M (7/8J), L (9/11J), XL (12/13J)',
        'variants' => [
            'Kinder' => [
                'price' => 34.00,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL']
            ]
        ],
        'image' => 'schwarz/hoodie-kinder.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'Tank Top Damen',
        'description' => '100% Polyester<br>Größe XS-XXL',
        'variants' => [
            'Damen' => [
                'price' => 18.50,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
            ]
        ],
        'image' => 'schwarz/tank-top-damen.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'Shorts schwarz',
        'description' => '100% Polyester<br>Größe XS-XXL',
        'variants' => [
            'Unisex' => [
                'price' => 20.00,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
            ]
        ],
        'image' => 'schwarz/shorts.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'Tennisrock schwarz',
        'description' => 'Außen: 100% Polyester<br>Innen: 95% Baumwolle, 5% Elasthan<br>Größe 36-44',
        'variants' => [
            'Damen' => [
                'price' => 23.00,
                'sizes' => ['36', '38', '40', '42', '44']
            ]
        ],
        'image' => 'schwarz/tennisrock.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'Caps',
        'description' => 'Erwachsene und Kinder',
        'variants' => [
            'Erwachsene' => [
                'price' => 11.00,
                'sizes' => ['Erwachsene']
            ],
            'Kinder' => [
                'price' => 11.00,
                'sizes' => ['Kinder']
            ]
        ],
        'image' => 'schwarz/caps.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'Shield',
        'description' => '100% Baumwolle, Schweißband: 100% Polyester',
        'variants' => [
            'Unisex' => [
                'price' => 11.50,
                'sizes' => ['Einheitsgröße']  // Adding a generic size label
            ]
        ],
        'image' => 'schwarz/shield.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'Handtuch 100% BW, Oekotex 100, 550 gr./qm',
        'description' => 'klein: 30*50cm, groß: 70*140cm',
        'variants' => [
            'Handtuch' => [
                'price' => [
                    'klein' => 11.00,
                    'groß' => 27.00
                ],
                'sizes' => ['klein', 'groß']
            ]
        ],
        'image' => 'schwarz/handtuch.png',
        'can_be_labeled' => true 
    ],
    [
        'name' => 'Jogginghose schwarz',
        'description' => '80% BW, 50% Polyester<br>Größe XS-XXL für Damen, S-XXL für Herren, Größen 104-152 für Kinder',
        'variants' => [
            'Damen' => [
                'price' => 47.00,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL']
            ],
            'Herren' => [
                'price' => 41.00,
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL']
            ],
            'Kinder' => [
                'price' => 26.00,
                'sizes' => ['104', '116', '128', '140', '152']
            ]
        ],
        'image' => 'schwarz/jogginghose.png',
        'can_be_labeled' => true 
    ]
];
