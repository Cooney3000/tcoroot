<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title><?= $title ?> Admin</title>

  <?php include(__DIR__ . "/../inc/dependencies.inc.php"); ?>

  <script src="https://kit.fontawesome.com/b20dcfa647.js" crossorigin="anonymous"></script>

</head>

<body class="admin">
  <?php
  $username = isset($user['vorname']) ? htmlentities(strtoupper(trim($user['vorname']) . ' ' . trim($user['nachname']))) : ""
  ?>

  <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#d90429">
    <div class="mx-auto order-0">
      <a class="navbar-brand ml-auto" href="/"><img src="/images/tcoplain_0,1x.png" alt="TCO Logo"></a>
    </div>
    <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" id="nav-menue">

        <li class="nav-item mt-n3" id="nav-zurueck">
          <a class="nav-link" href="/intern/index.php">
            <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
              <!-- Linker Schenkel des Dreiecks -->
              <line x1="30" y1="50" x2="60" y2="30" stroke="white" stroke-width="3" />
              <!-- Rechter Schenkel des Dreiecks -->
              <line x1="30" y1="50" x2="60" y2="70" stroke="white" stroke-width="3" />
              <!-- Horizontale Linie -->
              <line x1="30" y1="50" x2="70" y2="50" stroke="white" stroke-width="3" />

              <!-- Text unter dem Pfeil -->
              <text x="50" y="90" font-family="Arial" font-size="16" fill="white" text-anchor="middle">INTERN</text>
            </svg>

          </a>
        </li>
        <li class="nav-item" id="nav-index">
          <a class="nav-link" href="/intern/admin/index.php">Start</a>
        </li>
        <li class="nav-item" id="nav-benutzer">
          <a class="nav-link" href="/intern/admin/benutzer.php">Benutzer</a>
        </li>
        <li class="nav-item" id="nav-gastedit">
          <a class="nav-link" href="/intern/admin/verein-aufnahmeantraege.php">Neuaufnahme</a>
        </li>
        <li class="nav-item" id="nav-gastedit">
          <a class="nav-link" href="/intern/admin/gastedit.php">Gäste</a>
        </li>
        <li class="nav-item" id="nav-serieedit">
          <a class="nav-link" href="/intern/admin/serieedit.php">Serien</a>
        </li>
        <li class="nav-item" id="nav-permissionsedit">
          <a class="nav-link" href="/intern/admin/permissionsedit.php">Berechtigungen</a>
        </li>
        <li class="nav-item" id="nav-shop">
          <a class="nav-link" href="/intern/admin/shop/">Shop</a>
        </li>
        <li class="nav-item" id="nav-funktionen">
          <a class="nav-link" href="/intern/admin/funktionen.php">Funktionen</a>
        </li>
        <li class="nav-item" id="nav-logout">
          <a class="nav-link" href="/intern/logout.php">Logout</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav navbar-nav .float-xs-right klein text-center" id="nav-login">
          <a href="/intern/settings.php">
            <img src="/intern/images/user.png" alt="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?> Bild" title="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>">
          </a>
        </li>
      </ul>
    </div>

  </nav>
<!--
  <script>
    document.getElementById("nav-index").classList.remove("active");
    document.getElementById("nav-gastedit").classList.remove("active");
    document.getElementById("nav-permissionsedit").classList.remove("active");
    document.getElementById("nav-funktionen").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
  </script>
-->