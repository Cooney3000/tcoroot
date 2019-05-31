
<div class="container mt-4">
  <div class="row">
 
      <div class="col-sm m-1">
          <a class="btn btn-success btn-small w-100" href="bereitsAngemeldet.php">Liste der Spieler</a>
      </div>
      <div class="col-sm m-1">
          <a class="btn btn-success btn-small w-100" href="infoPlatzbuchung.php">Registrierung</a>
      </div>
      <div class="col-sm m-1">
            <a class="btn btn-success btn-small w-100" href="infoAblauf.php">Ablauf</a>
      </div>
      <div class="col-sm m-1">
          <a class="btn btn-success btn-small w-100" href="infoPlatzbuchung2.php">Platzbuchung</a>
      </div>
      <div class="col-sm m-1">
            <a class="btn btn-success btn-small w-100" href="turnierbaum.php">Turnierbaum</a>
      </div>
      <div class="col-sm m-1">
            <a class="btn btn-success btn-small w-100" href="begegnungen.php">Begegnungen</a>
      </div>
<?php
if (checkPermissions(PERMISSIONS::T_ALL_PERMISSIONS) ) 
{
?>
      <div class="col-sm m-1">
        <a class="btn btn-danger btn-small w-100" href="nichtregistriert.php">Nicht registriert</a>
      </div>
      <div class="col-sm m-1">
            <a class="btn btn-danger btn-small w-100" href="ticketverkauf.php">Ticketverkauf</a>
      </div>
<?php
}
?>
  </div> <!-- row -->
</div> <!-- container -->
