<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

// Ensure user is authenticated
$user = check_user();

$title = "Intern - Shop";
include("../inc/header.inc.php");

// Laden Sie die Arrays für Dunkel und Weiß
include("dunkel/array-dunkel.php"); // Dies definiert $articles_dunkel
include("weiss/array-weiss.php"); // Dies definiert $articles_weiss

// Load order details and status
include("load-order-details.php");

?>

<script>
    const orderStatus = <?= json_encode($orderStatus) ?>;

    document.addEventListener('DOMContentLoaded', function() {
        const navItems = ['intern', 'turnier', 'halloffame', 'tafel', 'login', 'logout'];
        navItems.forEach(item => {
            const element = document.getElementById(`nav-${item}`);
            if (element) {
                element.classList.remove('active');
            }
        });

        if (orderStatus === 'finished') {
            disableForm();
        }
    });

    function disableForm() {
        document.querySelectorAll('input, textarea, button').forEach(field => {
            field.disabled = true;
        });
        document.getElementById('close-order').disabled = true;
    }
</script>

<body>
    <div class="container mt-4">
        <h2 class="text-center">Bestellung Herbst 2024</h2>
        <p>Der Shop wird von Daniela Ulrich verwaltet (daniela.ulrich@tcolching.de).
            Hier findet Ihr eine Info dazu von ihr:
            <strong><a href="shop-info-herbst2024.pdf" target="_blank">Shop Herbst 2024-Info</a></strong>.
        </p>
        <p><strong>Bitte bis einschließlich 19.09.2024 bestellen!</strong></p>

        <?php include("order-status-message.php"); ?>

        <!-- Display totals -->
        <div id="totals" class="text-center">
            <p><strong>Gesamtbetrag Dunkel: <span id="total-dunkel">0,00</span> €</strong></p>
            <p><strong>Gesamtbetrag Weiß: <span id="total-weiss">0,00</span> €</strong></p>
        </div>

        <!-- Form Section -->
        <form action="submit-order.php" method="POST">
            <?php include("order-buttons.php"); ?>

            <div class="tabs mb-3 d-flex justify-content-center">
                <div class="tab btn btn-outline-dark mb-3" data-tab="tab-dunkel">Dunkel</div>
                <div class="tab btn btn-outline-dark mb-3" data-tab="tab-weiss">Weiß</div>
            </div>

            <div id="tab-dunkel" class="tab-content active">
                <div class="row">
                    <?php
                    $color = 'dunkel';
                    $articles = $articles_dunkel;
                    include("display-articles.php");
                    ?>
                </div>
            </div>

            <div id="tab-weiss" class="tab-content">
                <div class="row">
                    <?php
                    $color = 'weiss';
                    $articles = $articles_weiss;
                    include("display-articles.php");
                    ?>
                </div>
            </div>
        </form>
    </div>

    <?php include("shop-scripts.php"); ?>
    <?php include("../inc/footer.inc.php"); ?>
</body>

</html>