<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title><?= $title ?> Admin</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="/intern/css/styles.css" rel="stylesheet">

  <!-- Für die Tabellenformatierung und -sortierung -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
  <!-- /Für die Tabellenformatierung und -sortierung -->

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
    <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" id="nav-menue">

        <li class="nav-item" id="nav-internal">
          <a class="nav-link" href="/intern/internal.php">Zurück</a>
        </li>
        <li class="nav-item" id="nav-index">
          <a class="nav-link" href="/intern/admin/index.php">Mitglieder</a>
        </li>
        <li class="nav-item" id="nav-gastedit">
          <a class="nav-link" href="/intern/admin/gastedit.php">Gastbuchungen</a>
        </li>
<?php
      if (checkPermissions(ADMINISTRATOR)) {
?>
        <li class="nav-item" id="nav-serieedit">
          <a class="nav-link" href="/intern/admin/serieedit.php">Serienbuchung eingeben</a>
        </li>
        <?php
      }
        ?>
        <li class="nav-item" id="nav-permissionsedit">
          <a class="nav-link" href="/intern/admin/permissionsedit.php">Berechtigungen</a>
        </li>
        <li class="nav-item" id="nav-logout">
          <a class="nav-link" href="/intern/logout.php">Logout</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav navbar-nav .float-xs-right klein text-center" id="nav-login">
          <a href="/intern/settings.php"><img src="/intern/images/user.png" alt="<?= $username ?> Bild"><br><?= $username ?></a>
        </li>
      </ul>
    </div>

  </nav>
  <script>
    document.getElementById("nav-internal").classList.remove("active");
    document.getElementById("nav-index").classList.remove("active");
    document.getElementById("nav-gastedit").classList.remove("active");
    document.getElementById("nav-permissionsedit").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
  </script>