<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="cache-control" content="no-cache">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>TC Olching <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>

  <?php 
//  echo "<br>Verzeichnis: " . dirname(__FILE__) . "<br>";
  include(dirname(__FILE__) . "/dependencies.inc.php"); 

  // Anzeige des Profilbilds
  $profilePicPath = getProfilePicPath($user['id'], $pdo);

  ?>

</head>

<body>
  <?php
/*
  $username = (isset($user['vorname']) ? htmlentities(ucfirst(trim($user['vorname'])) . ' ' . ucfirst(trim($user['nachname']))) : "") 
  . (isset($user['email']) ? " (" . htmlentities($user['email']) . ")" : "");
*/
  $username = htmlentities($user['email']);
?>
  <nav class="navbar navbar-expand-lg navbar-light bg-success">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"><img src="/images/tcoplain_0,1x.png" alt="TCO Logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

<?php
          $menuItems = [
            ['id' => 'nav-intern', 'text' => 'Events', 'href' => '/intern/'],
/*            ['id' => 'nav-turnier', 'text' => 'Turnier', 'href' => '/intern/turnier/index.php'], */
            ['id' => 'nav-shop', 'text' => 'TCO-Shop', 'href' => '/intern/shop/'],
            ['id' => 'nav-halloffame', 'text' => 'Hall Of Fame', 'href' => '/intern/halloffame.php'],
            ['id' => 'nav-tafel', 'text' => 'Platzbuchung', 'href' => '/intern/tafel/', 'target' => '_blank'],
            ['id' => 'nav-admin', 'text' => 'Admin', 'href' => '/intern/admin/index.php', 'permission' => T_ALL_PERMISSIONS],
            ['id' => 'nav-logout', 'text' => 'Logout', 'href' => '/intern/logout.php']
          ];

          $loggedOutItems = [
            ['id' => 'nav-login', 'text' => 'Login', 'href' => '/intern/login.php']
          ];

          if (isset($_SESSION['userid'])) {
            foreach ($menuItems as $item) {
              if (!isset($item['permission']) || checkPermissions($item['permission'])) {
                echo '<li class="nav-item" id="' . $item['id'] . '">
                        <a class="nav-link" href="' . $item['href'] . '"' . (isset($item['target']) ? ' target="' . $item['target'] . '"' : '') . '>' . $item['text'] . '</a>
                      </li>';
              }
            }
          } else {
            foreach ($loggedOutItems as $item) {
              echo '<li class="nav-item" id="' . $item['id'] . '">
                      <a class="nav-link" href="' . $item['href'] . '">' . $item['text'] . '</a>
                    </li>';
            }
          }
          ?>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item text-center" id="nav-settings">
            <?= DEBUG ? "<span>". $user['id'] ."</span>" : "" ?>
            <a href="/intern/settings.php"><img class="profilpic kleiner" src="<?php echo htmlentities($profilePicPath); ?>" alt="<?= $username ?>">
            <div class="nav-none font-sm"><?= $username ?></div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>