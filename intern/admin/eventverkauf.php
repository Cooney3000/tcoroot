<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

// Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TCO Eventverkauf</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .table-container {
      overflow-y: auto;
      max-height: 80vh; /* Anpassbar je nach Bedarf */
      position: relative;
    }

    .table thead th {
      position: sticky;
      top: 0;
      background: white;
      z-index: 1;
    }

    .table input {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      width: 100%;
      border: none;
    }

    .collapse-button {
      cursor: pointer;
      width: 100%;
    }

    .collapsed-row {
      display: none;
    }

    .table th, .table td {
      white-space: nowrap;
      text-align: center;
    }

    .table td {
      padding: 0;
    }

    .table-bordered td, .table-bordered th {
      border: 1px solid #dee2e6;
    }
  </style>
</head>
<body>

<div class="table-container mx-3">
    <form action="eventverkauf.php" method="post">
        <table class="table table-bordered table-light tbl-small">
            <thead>
                <tr>
                    <th>Name<br>
                        <a class="fas fa-angle-up fa-1x" href="eventverkauf.php?o=kaeufer_nn&dir=asc"></a>
                        <a class="fas fa-angle-down fa-1x" href="eventverkauf.php?o=kaeufer_nn&dir=desc"></a>
                    </th>
                    <th>Vorname<br>
                        <a class="fas fa-angle-up fa-1x" href="eventverkauf.php?o=kaeufer_vn&dir=asc"></a>&nbsp;&nbsp;
                        <a class="fas fa-angle-down fa-1x" href="eventverkauf.php?o=kaeufer_vn&dir=desc"></a>
                    </th>
                    <th>Zu-/Absage<br>
                        <a class="fas fa-angle-up fa-1x" href="eventverkauf.php?o=jn&dir=asc"></a>&nbsp;&nbsp;
                        <a class="fas fa-angle-down fa-1x" href="eventverkauf.php?o=jn&dir=desc"></a>
                    </th>
                    <th>Karte<br>
                        <a class="fas fa-angle-up fa-1x" href="eventverkauf.php?o=ticketnummer&dir=asc"></a>&nbsp;&nbsp;
                        <a class="fas fa-angle-down fa-1x" href="eventverkauf.php?o=ticketnummer&dir=desc"></a>
                    </th>
                    <th>Verkäufer<br>
                        <a class="fas fa-angle-up fa-1x" href="eventverkauf.php?o=verkaeufer&dir=asc"></a>&nbsp;&nbsp;
                        <a class="fas fa-angle-down fa-1x" href="eventverkauf.php?o=verkaeufer&dir=desc"></a>
                    </th>
                    <th>Kommentar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $order = (isset($_GET['o'])) ? $_GET['o'] : 'kaeufer_nn, kaeufer_vn';
                $direction = (isset($_GET['dir'])) ? $_GET['dir'] : 'asc';

                $sql = 'SELECT * FROM event_tickets WHERE event = "Players & Friends 2024"  ORDER BY ' . "$order $direction";
                
                $statement = $pdo->prepare($sql);
                $result = $statement->execute();

                $previousRow = null;
                while ($row = $statement->fetch()) {
                    $isCollapsed = $previousRow && $row['kaeufer_nn'] == $previousRow['kaeufer_nn'] && $row['kaeufer_vn'] == $previousRow['kaeufer_vn'];
                ?>
                <tr <?= ($row['jn'] == 'j') ? 'class="table-success"' : '' ?> id="row-<?= $row['id'] ?>" <?= $isCollapsed ? 'class="collapsed-row"' : '' ?>>
                    <td class="align-middle">
                        <input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter ?>kaeufer_nn" type="text" value="<?= $row['kaeufer_nn'] ?>" />
                    </td>
                    <td class="align-middle">
                        <input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter ?>kaeufer_vn" type="text" value="<?= $row['kaeufer_vn'] ?>" />
                    </td>
                    <td class="align-middle">
                        <input class="form-control form-control-sm text-center" maxlength="1" onchange="hasChanged(this); checkJN(this)" id="<?= $row['id'] . $delimiter ?>jn" type="text" value="<?= $row['jn'] ?>" />
                    </td>
                    <td class="align-middle">
                        <input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter ?>ticketnummer" type="text" value="<?= $row['ticketnummer'] ?>" />
                    </td>
                    <td class="align-middle">
                        <input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter ?>verkaeufer" type="text" value="<?= $row['verkaeufer'] ?>" />
                    </td>
                    <td class="align-middle">
                        <input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter ?>kommentar" type="text" value="<?= $row['kommentar'] ?>" />
                    </td>
                </tr>
                <?php
                if (!$isCollapsed) {
                    echo '<tr><td colspan="6" class="collapse-button" data-row-id="' . $row['id'] . '">Ein-/Ausklappen</td></tr>';
                }
                $previousRow = $row;
                }
                ?>
            </tbody>
        </table>
    </form>
</div>

<script>
    function hasChanged(e) {
        var p = e.id.split('<?= $delimiter ?>');
        var id = "i=" + p[0];
        var col = "&col=" + p[1];
        var v = "&v=" + encodeURIComponent(e.value);
        var url = "/intern/api/eventTicketUpdate.php?" + id + col + v;
        fetch(url, {
            credentials: 'same-origin'
        }).then(result => {
            if (result.ok) {
                return true;
            } else {
                throw new Error('Fehler beim Erzeugen/Updaten der Daten');
            }
        });
    }

    function checkJN(input) {
        var value = input.value;
        var rowId = input.id.split('<?= $delimiter ?>')[0];
        var row = document.getElementById('row-' + rowId);

        if (value === 'j') {
            row.classList.add('table-success');
        } else {
            row.classList.remove('table-success');
        }
    }

    document.querySelectorAll('.collapse-button').forEach(button => {
        button.addEventListener('click', () => {
            var rowId = button.dataset.rowId;
            var rows = document.querySelectorAll('#row-' + rowId + '.collapsed-row');
            rows.forEach(row => {
                row.classList.toggle('collapsed-row');
            });
        });
    });
</script>

</body>
</html>
