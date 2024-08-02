<div class="container mt-4">
  <div class="row justify-content-center">
      <div class="col-sm-2 m-1 p-0">
          <a class="btn btn-success btn-small w-100 h-100 d-flex align-items-center justify-content-center" href="index.php">Anmeldung</a>
      </div>
      <div class="col-sm-2 m-1 p-0">
          <a class="btn btn-success btn-small w-100 h-100 d-flex align-items-center justify-content-center" href="bereitsAngemeldet.php">Liste der Spieler</a>
      </div>
      <div class="col-sm-2 m-1 p-0">
            <a class="btn btn-success btn-small w-100 h-100 d-flex align-items-center justify-content-center" href="infoAblauf.php">INFO Ablauf</a>
      </div>
      <div class="col-sm-2 m-1 p-0">
            <a class="btn btn-success btn-small w-100 h-100 d-flex align-items-center justify-content-center" href="turnierbaum.php">Turnierbaum</a>
      </div>
      <div class="col-sm-2 m-1 p-0">
            <a class="btn btn-success btn-small w-100 h-100 d-flex align-items-center justify-content-center" href="begegnungen.php">Begegnungen</a>
      </div>
<?php
if (checkPermissions(T_ALL_PERMISSIONS)) 
{
?>
      <div class="col-sm-2 m-1 p-0">
            <a class="btn btn-danger btn-small w-100 h-100 d-flex align-items-center justify-content-center" href="bereitsAngemeldetEdit.php">Spieler bearbeiten</a>
      </div>
<?php
}
?>
  </div> <!-- row -->
</div> <!-- container -->
