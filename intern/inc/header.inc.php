<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="cache-control" content="no-cache">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>TC Olching <?= $title ?></title>

  <!-- Bootstrap core CSS -->
  <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<!--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,300&display=swap" rel="stylesheet">
  <link href="/intern/css/styles.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/b20dcfa647.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  $username = isset($user['vorname']) ? htmlentities(strtoupper(trim($user['vorname']) . ' ' . trim($user['nachname']))) : ""
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-success">
    <div class="mx-auto order-0">
      <a class="navbar-brand ml-auto" href="/"><img src="/images/tcoplain_0,1x.png" alt="TCO Logo"></a>
    </div>
    <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse w-100 order-1 order-md-0 dual-collapse2" id="navbarSupportedContent">
<!--
      <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2" id="navbarSupportedContent">
-->
      <ul class="navbar-nav mr-auto" id="nav-menue">
        <?php if (isset($_SESSION['userid'])) { ?>
          <li class="nav-item" id="nav-intern">
            <a class="nav-link" href="/intern/">Events</a>
          </li>
          <li class="nav-item" id="nav-turnier">
            <a class="nav-link" href="/intern/turnier/index.php">Turnier</a>
          </li>
          <li class="nav-item" id="nav-halloffame">
            <a class="nav-link" href="/intern/halloffame.php">Hall Of Fame</a>
          </li>
          <li class="nav-item" id="nav-tafel">
            <a class="nav-link" href="/intern/tafel/" target="_blank">Platzbuchung</a>
          </li>
          <?php if (checkPermissions(T_ALL_PERMISSIONS)) { ?>
            <li class="nav-item" id="nav-admin">
              <a class="nav-link" href="/intern/admin/index.php">Admin</a>
            </li>
          <?php
          } ?>
          <li class="nav-item" id="nav-logout">
            <a class="nav-link" href="/intern/logout.php">Logout</a>
          </li>
        <?php } else { ?>
          <li class="nav-item" id="nav-login">
            <a class="nav-link" href="/intern/login.php">Login</a>
          </li>
        <?php
        } ?>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav navbar-nav .float-xs-right klein text-center" id="nav-login">
          <a href="/intern/settings.php"><img src="/intern/images/user.png" alt="<?= $username ?> Bild"><br><?= $username ?></a>
        </li>
      </ul>
    </div>
    </div>
  </nav>