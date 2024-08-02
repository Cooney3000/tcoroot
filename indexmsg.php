<?php
# In der Navigation den aktuellen Menüpunkt auf bold setzen
$navigation = [
  'aktuell' => '',
  'verein' => '',
  'mannschaften' => '',
  'jugend' => '',
  'training' => '',
];
$_header = "Home Edit";
include 'header.php';
?>
		<div id="blatt1">
			<section id="message" class="seite">
<?php
	// Alte Nachricht aus dem File holen
	$file = "work/indexmessages.txt";
	$nachricht = file_get_contents($file);
	$datum = substr($nachricht, 0, 8);
	$nachricht = substr($nachricht, 9);
	
  // Wenn es eine richtige Raetselantwort gibt, speichern wir die Textarea-Eingabe in der Datei
  if (isset($_POST['raetselantwort'])) {
    $raetselantwort = $_POST['raetselantwort'];
    if ($raetselantwort != "")
    {
      $loesung = $_POST['loesung'];
      if ($raetselantwort == $loesung)
      {
        $nachricht = htmlspecialchars($_POST['nachricht']);
        file_put_contents($file,date("d.m.y") . "," . $nachricht);
        echo '<p class="text-danger"> Nachricht gespeichert! Sie wird bis heute 24:00 Uhr auf der Startseite angezeigt</p>';
      } else {
        echo '<p class="text-danger"> Nachricht nicht gespeichert!</p>';
      }
    }
  }
	// Neues Raetsel erstellen
	$z1=rand(0, 9);
	$z2=rand(0, 9);
?>

				<form method="post">
          <p><label class="h2" form="messageForm">Nachricht eingeben oder ändern</label></p>
          <p>Die Nachricht wird nur am heutigen Tag angezeigt.</p>
					<p> 
						<label for="nachricht">Nachricht</label> 
						<textarea name="nachricht" id="nachricht" cols="50" rows="4"><?=$nachricht?></textarea>
					</p>
					<p>
						<label for="raetsel">Speichern mit der richtigen Antwort: Wie viel ist <?=$z1?>+<?=$z2?>?</label>  
						<input type="text" name="raetselantwort" size="2" maxlength="2" required>
						<input type="hidden" name="loesung" value="<?= $z1+$z2 ?>">
					</p>

					<button type="submit">Eingaben absenden</button>
				</form>
				
			</section>
		</div>
<?php
$diese_seite = "Aktuell";
include 'footer.php';
?>
