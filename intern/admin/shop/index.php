<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "intern/inc/config.inc.php");
require_once(BASE_PATH . "intern/inc/functions.inc.php");
require_once(BASE_PATH . "intern/inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO Admin";
include(BASE_PATH . "/intern/header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
TLOG(DBG, "menuid: $menuid", __LINE__);


if (!checkPermissions(VORSTAND)) {
    echo ("<html><body>");
    TECHO(INFO, "Für diese Seite besitzt du leider nicht die nötige Berechtigung", __LINE__);
    echo ("</body></html>");
    die("Keine Berechtigung");
}
?>
<script>
    document.getElementById("<?= $menuid ?>").classList.add("active");

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-details').forEach(function(toggleButton) {
            toggleButton.addEventListener('click', function() {
                var orderId = this.getAttribute('data-order-id');
                var detailsRow = document.getElementById('details-' + orderId);

                if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
                    if (detailsRow.querySelector('.details-container').innerHTML.trim() === '') {
                        fetch('fetch_order_details.php?order_id=' + orderId)
                            .then(response => response.text())
                            .then(data => {
                                detailsRow.querySelector('.details-container').innerHTML = data;
                                detailsRow.style.display = 'table-row';
                            })
                            .catch(error => console.error('Error fetching order details:', error));
                    } else {
                        detailsRow.style.display = 'table-row';
                    }
                } else {
                    detailsRow.style.display = 'none';
                }
            });
        });
    });
</script>

<?php
// Fetch orders with status "finished" and delivery not "completed"
$stmt = $pdo->prepare("
    SELECT o.id, o.user_id, o.total_dunkel, o.total_weiss, o.created_at, o.delivery, o.paid, u.vorname, u.nachname
    FROM orders o
    JOIN users u ON o.user_id = u.id
    WHERE o.status = 'finished' AND o.delivery != 'completed'
    ORDER BY o.created_at DESC
");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container main-container">

    <h1>Shop-Management</h1>

    <table class="table table-bordered table-light tbl-small">
        <thead>
            <tr>
                <th>ID</th>
                <th>Besteller</th>
                <th>Total Dunkel</th>
                <th>Total Weiß</th>
                <th>Erstellt am</th>
                <th>Lieferstatus</th>
                <th>Bezahlt</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['vorname'] . ' ' . $order['nachname']) ?></td>
                    <td><?= number_format($order['total_dunkel'], 2, ',', '.') ?> €</td>
                    <td><?= number_format($order['total_weiss'], 2, ',', '.') ?> €</td>
                    <td><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></td>
                    <td><?= ucfirst($order['delivery']) ?></td>
                    <td><?= $order['paid'] ? 'Ja' : 'Nein' ?></td>
                    <td><button class="toggle-details" data-order-id="<?= $order['id'] ?>">Anzeigen</button></td>
                </tr>
                <tr class="details-row" id="details-<?= $order['id'] ?>" style="display: none;">
                    <td colspan="8">
                        <!-- Details will be loaded here using AJAX -->
                        <div class="details-container"></div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php
include(BASE_PATH . "intern/inc/footer.inc.php")
?>