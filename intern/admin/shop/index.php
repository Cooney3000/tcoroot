<?php
session_start();
require_once(dirname(__FILE__) . "/../../inc/config.inc.php");
require_once(dirname(__FILE__) . "/../../inc/functions.inc.php");
require_once(dirname(__FILE__) . "/../../inc/permissioncheck.inc.php");

// Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO Admin";
include(dirname(__FILE__) . "/../header.inc.php");
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
document.addEventListener('DOMContentLoaded', function() {
    console.log("Vanilla JavaScript ist geladen und ausgeführt.");

    // Toggle für das Burger-Menü
    document.querySelector('.navbar-toggler').addEventListener('click', function() {
        document.getElementById('navbarSupportedContent').classList.toggle('show');
    });

    // Funktion zum Binden der "Anzeigen"-Buttons
    function bindToggleDetailsButtons() {
        document.querySelectorAll('.toggle-details').forEach(function(toggleButton) {
            toggleButton.addEventListener('click', function() {
                var orderId = this.getAttribute('data-order-id');
                var detailsRow = document.getElementById('details-' + orderId);

                if (!detailsRow) {
                    console.error('Details-Reihe nicht gefunden für Bestellung:', orderId);
                    return;
                }

                if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
                    fetch('fetch_order_details.php?order_id=' + orderId)
                        .then(response => response.text())
                        .then(data => {
                            detailsRow.querySelector('.details-container').innerHTML = data;
                            detailsRow.style.display = 'table-row';
                        })
                        .catch(error => console.error('Fehler beim Abrufen der Bestelldetails:', error));
                } else {
                    detailsRow.style.display = 'none';
                }
            });
        });
    }

    // Funktion zum Binden der Editierfelder
    function bindEditableFields() {
        // Bestellstatus (Status)
        document.querySelectorAll('.edit-order-status').forEach(function(select) {
            select.addEventListener('change', function() {
                var orderId = this.getAttribute('data-order-id');
                var newStatus = this.value;

                fetch('update_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        status: newStatus
                    })
                }).then(response => response.json())
                .then(data => {
                    console.log('Bestellstatus aktualisiert:', data);
                    location.reload(); // Seite nach Änderung neu laden
                }).catch(error => console.error('Fehler beim Aktualisieren des Bestellstatus:', error));
            });
        });

        // Lieferstatus
        document.querySelectorAll('.edit-delivery-status').forEach(function(select) {
            select.addEventListener('change', function() {
                var orderId = this.getAttribute('data-order-id');
                var newStatus = this.value;

                fetch('update_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        delivery: newStatus
                    })
                }).then(response => response.json())
                .then(data => {
                    console.log('Lieferstatus aktualisiert:', data);
                    location.reload(); // Seite nach Änderung neu laden
                }).catch(error => console.error('Fehler beim Aktualisieren des Lieferstatus:', error));
            });
        });

        // Bezahlt-Checkboxen
        document.querySelectorAll('.edit-paid-status').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var orderId = this.getAttribute('data-order-id');
                var isPaid = this.checked;

                fetch('update_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        paid: isPaid ? 1 : 0
                    })
                }).then(response => response.json())
                .then(data => {
                    console.log('Bezahlt-Status aktualisiert:', data);
                    location.reload(); // Seite nach Änderung neu laden
                }).catch(error => console.error('Fehler beim Aktualisieren des Bezahlt-Status:', error));
            });
        });
    }

    bindToggleDetailsButtons();  // Bind events for toggle details
    bindEditableFields();  // Bind events for editable fields
});

</script>

<?php
// Fetch orders with status "finished" and delivery not "completed"
$stmt = $pdo->prepare("
    SELECT o.id, o.user_id, o.total_dunkel, o.total_weiss, o.created_at, o.status, o.delivery, o.paid, u.vorname, u.nachname
    FROM orders o
    JOIN users u ON o.user_id = u.id
    WHERE o.status = 'finished' AND o.delivery != 'completed'
    ORDER BY o.created_at DESC
");
$stmt->execute();
$finishedOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch orders with status "pending"
$stmt = $pdo->prepare("
    SELECT o.id, o.user_id, o.total_dunkel, o.total_weiss, o.created_at, o.status, o.delivery, o.paid, u.vorname, u.nachname
    FROM orders o
    JOIN users u ON o.user_id = u.id
    WHERE o.status = 'pending'
    ORDER BY o.created_at DESC
");
$stmt->execute();
$pendingOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container main-container">
    <h1>Shop-Management</h1>

    <!-- Finished Orders -->
    <h2>Bestellungen</h2>
    <table class="table table-bordered table-light tbl-small">
        <thead>
            <tr>
                <th>ID</th>
                <th>Besteller</th>
                <th>Total Dunkel</th>
                <th>Total Weiß</th>
                <th>Erstellt am</th>
                <th>Benutzerstatus</th>
                <th>Lieferstatus</th>
                <th>Bezahlt</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($finishedOrders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['vorname'] . ' ' . $order['nachname']) ?></td>
                    <td><?= number_format($order['total_dunkel'], 2, ',', '.') ?> €</td>
                    <td><?= number_format($order['total_weiss'], 2, ',', '.') ?> €</td>
                    <td><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></td>
                    <td>
                        <select class="edit-order-status" data-order-id="<?= $order['id'] ?>">
                            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Gespeichert</option>
                            <option value="finished" <?= $order['status'] == 'finished' ? 'selected' : '' ?>>Bestellung</option>
                        </select>
                    </td>
                    <td>
                        <select class="edit-delivery-status" data-order-id="<?= $order['id'] ?>">
                            <option value="new" <?= $order['delivery'] == 'new' ? 'selected' : '' ?>>Neu</option>
                            <option value="ordered" <?= $order['delivery'] == 'ordered' ? 'selected' : '' ?>>Bestellt</option>
                            <option value="received" <?= $order['delivery'] == 'received' ? 'selected' : '' ?>>Erhalten</option>
                            <option value="completed" <?= $order['delivery'] == 'completed' ? 'selected' : '' ?>>Abgeschlossen</option>
                        </select>
                    </td>
                    <td>
                        <input type="checkbox" class="edit-paid-status" data-order-id="<?= $order['id'] ?>" <?= $order['paid'] ? 'checked' : '' ?>>
                    </td>
                    <td><button class="shop-btn-sm rounded toggle-details" data-order-id="<?= $order['id'] ?>">Anzeigen</button></td>
                </tr>
                <tr class="details-row" id="details-<?= $order['id'] ?>" style="display: none;">
                    <td colspan="8">
                        <div class="details-container"></div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pending Orders -->
    <h2>Noch nicht bestellt, aber gespeichert</h2>
    <table class="table table-bordered table-light tbl-small">
        <thead>
            <tr>
                <th>ID</th>
                <th>Besteller</th>
                <th>Total Dunkel</th>
                <th>Total Weiß</th>
                <th>Erstellt am</th>
                <th>Benutzerstatus</th>
                <th>Lieferstatus</th>
                <th>Bezahlt</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendingOrders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['vorname'] . ' ' . $order['nachname']) ?></td>
                    <td><?= number_format($order['total_dunkel'], 2, ',', '.') ?> €</td>
                    <td><?= number_format($order['total_weiss'], 2, ',', '.') ?> €</td>
                    <td><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></td>
                    <td>
                        <select class="edit-order-status" data-order-id="<?= $order['id'] ?>">
                            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Gespeichert</option>
                            <option value="finished" <?= $order['status'] == 'finished' ? 'selected' : '' ?>>Bestellung</option>
                        </select>
                    </td>
                    <td><?= ucfirst($order['delivery']) ?></td>
                    <td><?= $order['paid'] ? 'Ja' : 'Nein' ?></td>
                    <td><button class="shop-btn-sm rounded toggle-details" data-order-id="<?= $order['id'] ?>">Anzeigen</button></td>
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
include(BASE_PATH . "intern/inc/footer.inc.php");
?>