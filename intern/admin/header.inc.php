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
    <script src="https://kit.fontawesome.com/b20dcfa647.js" crossorigin="anonymous"></script>
  </head>
  <body class="admin">
  
    <nav class="navbar navbar-expand-lg navbar-light">
      
      <div>
        <a href="/"><img src="/images/tcoplain_0,1x.png" alt="TCO Logo"></a>
        <div class="klein">
          <?= isset($user['vorname']) ? htmlentities(trim($user['vorname']).' '.trim($user['nachname'])) : "" ?>
        </div>
      </div>

      <button class="navbar-toggler bg-light border-secondary rounded" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse navbar-custom" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" id="nav-menue">
          <li class="nav-item" id="nav-internal">
            <a class="nav-link" href="/intern/internal.php">Zurück</a>
          </li>
          <li class="nav-item" id="nav-index">
            <a class="nav-link" href="/intern/admin/index.php">Berechtigungen</a>
          </li>
          <li class="nav-item" id="nav-gastedit">
            <a class="nav-link" href="/intern/admin/gastedit.php">Gastbuchungen</a>
          </li>
          <li class="nav-item" id="nav-logout">
            <a class="nav-link" href="/intern/logout.php">Logout</a>
          </li>
        </ul>
      </div>         
    </nav>
<script>
  document.getElementById("nav-internal").classList.remove("active");
  document.getElementById("nav-gastedit").classList.remove("active");
  document.getElementById("nav-index").classList.remove("active");
  document.getElementById("nav-logout").classList.remove("active");
</script>