<div class="container mt-4">
  <div class="row gx-3 gy-2">
    <?php
    $buttons = [
      ["text" => "Anmeldung", "href" => "index.php", "class" => "btn-light"],
      ["text" => "Liste der Spieler", "href" => "bereitsAngemeldet.php", "class" => "btn-light"],
      ["text" => "INFO Ablauf", "href" => "infoAblauf.php", "class" => "btn-light"],
      ["text" => "Turnierbaum", "href" => "turnierbaum.php", "class" => "btn-light"],
      ["text" => "Begegnungen", "href" => "begegnungen.php", "class" => "btn-light"],
    ];

    // Check permissions for the additional button
    if (checkPermissions(T_ALL_PERMISSIONS)) {
      $buttons[] = ["text" => "Spieler bearbeiten", "href" => "bereitsAngemeldetEdit.php", "class" => "btn-danger"];
    }

    // Loop through the buttons array to generate the HTML
    foreach ($buttons as $button) {
    ?>
      <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
        <div class="bg-light p-2 h-100 kachel d-flex align-items-center justify-content-center">
          <a class="btn <?= $button['class'] ?> btn-small w-100 h-100 d-flex align-items-center justify-content-center" href="<?= $button['href'] ?>"><?= $button['text'] ?></a>
        </div>
      </div>
    <?php
    }
    ?>
  </div> <!-- row -->
</div> <!-- container -->
