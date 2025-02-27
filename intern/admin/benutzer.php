<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

// Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO Benutzer";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>

<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>

<?php
if (checkPermissions(VORSTAND)) {
    // Verarbeite Schaltflächenaktionen
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_POST['user_id'] ?? null;
        $action = $_POST['action'] ?? '';

        if ($userId && $action) {
            switch ($action) {
                case 'activate':
                    $query = "UPDATE users SET status = 'A' WHERE id = ?";
                    break;
                case 'deactivate':
                    $query = "UPDATE users SET status = 'D' WHERE id = ?";
                    break;
                case 'delete':
                    $query = "DELETE FROM users WHERE id = ?";
                    break;
                case 'update':
                    $column = $_POST['column'] ?? '';
                    $value = $_POST['value'] ?? '';
                    
                    // Verarbeitung von Datumsformaten zurück in MySQL-Format (yyyy-mm-dd)
                    if ($column === 'geburtsdatum') {
                        $dateParts = explode('.', $value);
                        if (count($dateParts) === 3) {
                            $value = "{$dateParts[2]}-{$dateParts[1]}-{$dateParts[0]}";
                        }
                    }

                    $query = "UPDATE users SET {$column} = ? WHERE id = ?";
                    break;
                default:
                    $query = null;
            }

            if ($query) {
              $statement = $pdo->prepare($query);
              
              // Überprüfen, ob die Query nur einen oder zwei Parameter benötigt
              if ($action === 'activate' || $action === 'deactivate' || $action === 'delete') {
                  $statement->execute([$userId]);
              } else {
                  $statement->execute([$value, $userId]);
              }
          }
                  }
    }

    $order = $_GET['o'] ?? 'nachname, vorname';
    $direction = $_GET['dir'] ?? 'asc';
    $newDirection = ($direction === 'asc') ? 'desc' : 'asc'; // Umschalten der Sortierrichtung

    $sql = 'SELECT * FROM users WHERE status NOT IN ("T", "X") ORDER BY ' . $order . ' ' . $direction;
    $statement = $pdo->query($sql);
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h1>Benutzer</h1>
    <h3>Aktuell registrierte Benutzer (A = Aktiv, P = Passiv, D = Deaktiviert, W = Wartet auf Aktivierung)</h3>
    <div class="mx-3">
        <form id="user-management-form" method="post">
            <table class="table table-bordered table-light tbl-small">
                <thead>
                    <tr>
                        <?php
                        $columns = [
                            'status' => 'S',
                            'id' => '#',
                            'vorname' => 'Vorname',
                            'nachname' => 'Nachname',
                            'email' => 'E-Mail',
                            'festnetz' => 'Festnetz',
                            'mobil' => 'Mobil',
                            'geburtsdatum' => 'Geburtsdatum',
                            'created_at' => 'Registriert am',
                            'schnupper' => 'SchnM'
                        ];

                        foreach ($columns as $key => $label) {
                            echo "<th>{$label}";
                            if (in_array($key, ['status', 'nachname', 'email', 'created_at', 'schnupper'])) {
                                // Sortierbare Symbole hinzufügen
                                echo "<a href='?o={$key}&dir=asc'>&uarr;</a>";
                                echo "<a href='?o={$key}&dir=desc'>&darr;</a>";
                            }
                            echo "</th>";
                        }
                        ?>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><input type="text" class="form-control form-control-sm" value="<?= htmlspecialchars($row['vorname']) ?>" onchange="updateUser(<?= $row['id'] ?>, 'vorname', this.value)"></td>
                            <td><input type="text" class="form-control form-control-sm" value="<?= htmlspecialchars($row['nachname']) ?>" onchange="updateUser(<?= $row['id'] ?>, 'nachname', this.value)"></td>
                            <td><input type="email" class="form-control form-control-sm" value="<?= htmlspecialchars($row['email']) ?>" onchange="updateUser(<?= $row['id'] ?>, 'email', this.value)"></td>
                            <td><input type="text" class="form-control form-control-sm" value="<?= htmlspecialchars($row['festnetz']) ?>" onchange="updateUser(<?= $row['id'] ?>, 'festnetz', this.value)"></td>
                            <td><input type="text" class="form-control form-control-sm" value="<?= htmlspecialchars($row['mobil']) ?>" onchange="updateUser(<?= $row['id'] ?>, 'mobil', this.value)"></td>
                            <td><input type="text" class="form-control form-control-sm" value="<?= date('d.m.Y', strtotime($row['geburtsdatum'])) ?>" onchange="updateUser(<?= $row['id'] ?>, 'geburtsdatum', this.value)"></td>
                            <td><?= date('d.m.Y', strtotime($row['created_at'])) ?></td>
                            <td><input type="checkbox" <?= $row['schnupper'] == 1 ? 'checked' : '' ?> onchange="updateUser(<?= $row['id'] ?>, 'schnupper', this.checked ? 1 : 0)"></td>
                            <td>
                                <?php if ($row['status'] === 'A'): ?>
                                    <button type="button" onclick="submitUserAction('deactivate', <?= $row['id'] ?>)" class="btn btn-danger btn-sm">Deaktivieren</button>
                                <?php elseif ($row['status'] === 'D' || $row['status'] === 'W'): ?>
                                    <button type="button" onclick="submitUserAction('activate', <?= $row['id'] ?>)" class="btn btn-success btn-sm">Aktivieren</button>
                                    <button type="button" onclick="submitUserAction('delete', <?= $row['id'] ?>)" class="btn btn-danger btn-sm">Löschen</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
        <div><?= count($users) ?> Benutzer</div>
    </div>
<?php } ?>

<?php include("footer.inc.php") ?>

<script>
// Funktion zur Aktualisierung der Benutzerdaten
async function updateUser(userId, column, value) {
    const formData = new FormData();
    formData.append('action', 'update');
    formData.append('user_id', userId);
    formData.append('column', column);
    formData.append('value', value);

    try {
        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        });

        if (!response.ok) {
            throw new Error('Aktualisierung fehlgeschlagen');
        }
    } catch (error) {
        console.error(error);
        alert('Fehler beim Aktualisieren der Daten.');
    }
}

async function submitUserAction(action, userId) {
    const formData = new FormData();
    formData.append('action', action);
    formData.append('user_id', userId);

    try {
        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        });

        if (response.ok) {
            location.reload(); // Seite aktualisieren, damit die Änderungen sichtbar werden
        } else {
            throw new Error('Aktion fehlgeschlagen');
        }
    } catch (error) {
        console.error(error);
        alert('Fehler beim Ausführen der Aktion.');
    }
}
</script>
