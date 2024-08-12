<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

// Ensure user is authenticated
$user = check_user();

$title = "Intern - Shop";
include("../inc/header.inc.php");

// Retrieve saved order details if they exist
$savedOrderDetails = [];
$stmt = $pdo->prepare("SELECT * FROM order_details WHERE order_id = (SELECT id FROM orders WHERE user_id = ?)");
$stmt->execute([$user['id']]);
$savedOrderRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($savedOrderRows as $row) {
    $articleName = $row['article_name'];
    $variantName = $row['variant_name'];
    $size = $row['size'];
    $quantity = $row['quantity'];
    $color = $row['color'];

    // Log the fetched data
    TLOG(DEBUG, "Fetched data - Article: $articleName, Variant: $variantName, Size: $size, Quantity: $quantity, Color: $color", __LINE__);

    // Store in the array
    $savedOrderDetails[$color][$articleName][$variantName][$size] = $quantity;
}

// Log the entire saved order details array
TLOG(DEBUG, "Loaded saved order details: " . json_encode($savedOrderDetails), __LINE__);
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = ['intern', 'turnier', 'halloffame', 'tafel', 'login', 'logout'];
        navItems.forEach(item => {
            const element = document.getElementById(`nav-${item}`);
            if (element) {
                element.classList.remove('active');
            }
        });
    });
</script>

<body>
    <div class="container mt-4">
        <h1>Bestellformular TC Olching 2024</h1>
        <div class="tabs mb-3">
            <div class="tab" data-tab="tab-schwarz">Schwarz</div>
            <div class="tab" data-tab="tab-weiss">Weiß</div>
        </div>

        <!-- Display totals -->
        <div id="totals">
            <h4>Gesamtbetrag Schwarz: <span id="total-schwarz">0,00</span> €</h4>
            <h4>Gesamtbetrag Weiß: <span id="total-weiss">0,00</span> €</h4>
        </div>

        <!-- Schwarz Section -->
        <form action="submit-order.php" method="POST">
            <button type="submit" class="btn btn-success">Bestellen</button>
            <button type="button" class="btn btn-success" id="save-order">Speichern</button>
            <div id="tab-schwarz" class="tab-content active">
                <h2>Schwarz</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Bild</th>
                            <th>Artikel</th>
                            <th>Preis in €</th>
                            <th>Anzahl/Größe</th>
                            <th>Bestellbetrag in €</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("schwarz/array-schwarz.php");

                        foreach ($articles_schwarz as $article) :
                        ?>
                            <tr>
                                <td><img src="<?= $article['image'] ?>" alt="<?= $article['name'] ?>" class="img-fluid rounded" style="width: 100%;"></td>
                                <td><span class="article-name" data-type="schwarz"><?= $article['name'] ?></span><br><?= $article['description'] ?></td>
                                <td>
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
                                </td>
                                <td>
                                    <?php
                                    foreach ($article['variants'] as $variantName => $variant) {
                                        foreach ($variant['sizes'] as $size) {
                                            $price = is_array($variant['price']) ? $variant['price'][$size] : $variant['price'];
                                            $inputName = "{$article['name']}_{$variantName}_{$size}";

                                            // Update: Access saved quantity using both article name and type
                                            $savedQuantity = $savedOrderDetails['schwarz'][$article['name']][$variantName][$size] ?? 0;

                                            // Log the key and the retrieved quantity
                                            TLOG(DEBUG, "Input name generated: $inputName, Saved Quantity: $savedQuantity", __LINE__);

                                            echo "<label>$variantName $size</label>";
                                            echo "<input type='number' name='$inputName' data-price='$price' min='0' placeholder='$size' value='$savedQuantity' class='form-control quantity-input'>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td><span class="article-total">0,00</span> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

            <!-- Weiß Section -->
            <div id="tab-weiss" class="tab-content">
                <h2>Weiß</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Bild</th>
                            <th>Artikel</th>
                            <th>Preis in €</th>
                            <th>Anzahl/Größe</th>
                            <th>Bestellbetrag in €</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("weiss/array-weiss.php");

                        foreach ($articles_weiss as $article) :
                        ?>
                            <tr>
                                <td><img src="<?= $article['image'] ?>" alt="<?= $article['name'] ?>" class="img-fluid rounded" style="width: 100%;"></td>
                                <td><span class="article-name" data-type="weiss"><?= $article['name'] ?></span><br><?= $article['description'] ?></td>
                                <td>
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
                                </td>
                                <td>
                                    <?php
                                    foreach ($article['variants'] as $variantName => $variant) {
                                        foreach ($variant['sizes'] as $size) {
                                            $price = is_array($variant['price']) ? $variant['price'][$size] : $variant['price'];
                                            $inputName = "{$article['name']}_{$variantName}_{$size}";

                                            // Update: Access saved quantity using both article name and type
                                            $savedQuantity = $savedOrderDetails['weiss'][$article['name']][$variantName][$size] ?? 0;

                                            // Log the key and the retrieved quantity
                                            TLOG(DEBUG, "Input name generated: $inputName, Saved Quantity: $savedQuantity", __LINE__);

                                            echo "<label>$variantName $size</label>";
                                            echo "<input type='number' name='$inputName' data-price='$price' min='0' placeholder='$size' value='$savedQuantity' class='form-control quantity-input'>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td><span class="article-total">0,00</span> €</td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');
            const totalSchwarzElement = document.getElementById('total-schwarz');
            const totalWeissElement = document.getElementById('total-weiss');

            function calculateTotals() {
                let totalSchwarz = 0;
                let totalWeiss = 0;

                document.querySelectorAll('#tab-schwarz tbody tr').forEach(function(row) {
                    let articleTotal = 0;
                    row.querySelectorAll('.quantity-input').forEach(function(input) {
                        const quantity = parseInt(input.value) || 0;
                        const price = parseFloat(input.getAttribute('data-price'));
                        articleTotal += quantity * price;
                    });
                    row.querySelector('.article-total').innerText = articleTotal.toFixed(2).replace('.', ',') + ' €';
                    totalSchwarz += articleTotal;
                });

                document.querySelectorAll('#tab-weiss tbody tr').forEach(function(row) {
                    let articleTotal = 0;
                    row.querySelectorAll('.quantity-input').forEach(function(input) {
                        const quantity = parseInt(input.value) || 0;
                        const price = parseFloat(input.getAttribute('data-price'));
                        articleTotal += quantity * price;
                    });
                    row.querySelector('.article-total').innerText = articleTotal.toFixed(2).replace('.', ',') + ' €';
                    totalWeiss += articleTotal;
                });

                totalSchwarzElement.innerText = totalSchwarz.toFixed(2).replace('.', ',');
                totalWeissElement.innerText = totalWeiss.toFixed(2).replace('.', ',');
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(item => item.classList.remove('active'));
                    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

                    this.classList.add('active');
                    document.getElementById(this.getAttribute('data-tab')).classList.add('active');

                    calculateTotals(); // Recalculate totals when switching tabs
                });
            });

            // Set the default active tab
            tabs[0].classList.add('active');
            document.getElementById('tab-schwarz').classList.add('active');

            // Add event listeners for quantity inputs to recalculate totals on change
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('input', calculateTotals);
            });

            // Initial calculation
            calculateTotals();
        });

        // Save the order
        document.getElementById('save-order').addEventListener('click', function() {
            const orderDetails = [];

            // Schwarz articles
            document.querySelectorAll('#tab-schwarz tbody tr').forEach(function(row) {
                row.querySelectorAll('.quantity-input').forEach(function(input) {
                    const quantity = parseInt(input.value) || 0;
                    if (quantity > 0) {
                        orderDetails.push({
                            article_name: row.querySelector('.article-name').textContent.trim(),
                            variant_name: input.getAttribute('name').split('_')[1],
                            size: input.getAttribute('placeholder'),
                            quantity: quantity,
                            price: parseFloat(input.getAttribute('data-price')),
                            total: quantity * parseFloat(input.getAttribute('data-price')),
                            color: 'schwarz' // Add color information
                        });
                    }
                });
            });

            // Weiß articles
            document.querySelectorAll('#tab-weiss tbody tr').forEach(function(row) {
                row.querySelectorAll('.quantity-input').forEach(function(input) {
                    const quantity = parseInt(input.value) || 0;
                    if (quantity > 0) {
                        orderDetails.push({
                            article_name: row.querySelector('.article-name').textContent.trim(),
                            variant_name: input.getAttribute('name').split('_')[1],
                            size: input.getAttribute('placeholder'),
                            quantity: quantity,
                            price: parseFloat(input.getAttribute('data-price')),
                            total: quantity * parseFloat(input.getAttribute('data-price')),
                            color: 'weiss' // Add color information
                        });
                    }
                });
            });

            // Send data to server
            fetch('save-order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        total_schwarz: document.getElementById('total-schwarz').textContent.replace(',', '.'),
                        total_weiss: document.getElementById('total-weiss').textContent.replace(',', '.'),
                        order_details: orderDetails
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Order saved successfully!');
                    } else {
                        alert('Error saving order: ' + data.message);
                    }
                });
        });
    </script>

    <?php
    include("../inc/footer.inc.php");
    ?>