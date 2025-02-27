<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");  // Einbindung der functions.inc.php
require_once("inc/permissioncheck.inc.php");

$user = check_user();
$title = "Einstellungen";
include("inc/header.inc.php");

if (isset($_GET['save'])) {
	$save = $_GET['save'];

	// Verarbeitung der persönlichen Daten
	if ($save == 'personal_data') {

		// Alle Felder von POST abholen und trimmen
		$vorname = trim($_POST['vorname']);
		$nachname = trim($_POST['nachname']);
		$festnetz = trim($_POST['festnetz']);
		$mobil = trim($_POST['mobil']);
		$geburtsdatum = trim($_POST['geburtsdatum']);
		$spielLevel = trim($_POST['spiel_level']);
		$ueberMich = trim($_POST['ueber_mich']);
		$sucheTennisPartner = isset($_POST['suche_tennis_partner']) ? 1 : 0;

		// Überprüfung auf Vor- und Nachname
		if (empty($vorname) || empty($nachname)) {
			$error_msg = "Bitte Vor- und Nachname ausfüllen.";
		} else {
			// Gemeinsames Update für alle Felder
			$statement = $pdo->prepare("
                UPDATE users 
                SET 
                    vorname = :vorname,
                    nachname = :nachname,
                    festnetz = :festnetz,
                    mobil = :mobil,
                    geburtsdatum = :geburtsdatum,
                    spiel_level = :spiel_level,
                    ueber_mich = :ueber_mich,
                    suche_tennis_partner = :suche_tennis_partner,
                    updated_at = NOW()
                WHERE id = :userid
            ");

			// Binden der Parameter
			$statement->bindValue(':vorname', $vorname, PDO::PARAM_STR);
			$statement->bindValue(':nachname', $nachname, PDO::PARAM_STR);
			$statement->bindValue(':festnetz', $festnetz, PDO::PARAM_STR);
			$statement->bindValue(':mobil', $mobil, PDO::PARAM_STR);
			$statement->bindValue(':geburtsdatum', $geburtsdatum, PDO::PARAM_STR);
			$statement->bindValue(':spiel_level', $spielLevel, PDO::PARAM_STR);
			$statement->bindValue(':ueber_mich', $ueberMich, PDO::PARAM_STR);
			$statement->bindValue(':suche_tennis_partner', $sucheTennisPartner, PDO::PARAM_INT);
			$statement->bindValue(':userid', $user['id'], PDO::PARAM_INT);

			// Ausführung des Updates
			if ($statement->execute()) {
				$success_msg = "Persönliche Daten erfolgreich gespeichert.";

				// Aktualisiere die $user-Variablen, damit sie die neuen Werte enthalten
				$user['vorname'] = $vorname;
				$user['nachname'] = $nachname;
				$user['festnetz'] = $festnetz;
				$user['mobil'] = $mobil;
				$user['geburtsdatum'] = $geburtsdatum;
				$user['spiel_level'] = $spielLevel;
				$user['ueber_mich'] = $ueberMich;
				$user['suche_tennis_partner'] = $sucheTennisPartner;
			} else {
				$error_msg = "Fehler beim Speichern der persönlichen Daten.";
			}
		}
	}
	// Verarbeitung der E-Mail-Adresse
	else if ($save == 'email') {
		$passwort = $_POST['passwort'];
		$email = trim($_POST['email']);
		$email2 = trim($_POST['email2']);

		// Überprüfen, ob die E-Mail-Adressen übereinstimmen
		if ($email != $email2) {
			$error_msg = "Die eingegebenen E-Mail-Adressen stimmen nicht überein.";
		}
		// Überprüfen, ob die E-Mail-Adresse gültig ist
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error_msg = "Bitte eine gültige E-Mail-Adresse eingeben.";
		}
		// Überprüfen, ob das Passwort korrekt ist
		else if (!password_verify($passwort, $user['passwort'])) {
			$error_msg = "Bitte korrektes Passwort eingeben.";
		}
		// Wenn alles stimmt, E-Mail-Adresse in die Datenbank speichern
		else {
			$statement = $pdo->prepare("UPDATE users SET email = :email WHERE id = :userid");
			$result = $statement->execute(array('email' => $email, 'userid' => $user['id']));

			if ($result) {
				$success_msg = "E-Mail-Adresse erfolgreich gespeichert.";

				// E-Mail-Adresse in $user aktualisieren, um die Anzeige zu aktualisieren
				$user['email'] = $email;
			} else {
				$error_msg = "Fehler beim Speichern der E-Mail-Adresse.";
			}
		}
	}
}


// Verarbeitung des Profilbilds, wenn eines hochgeladen wurde
if (isset($_POST['cropped_image']) && !empty($_POST['cropped_image']) && isset($user['id'])) {
	$userId = $user['id'];
	$croppedImageData = $_POST['cropped_image'];

	$message = uploadProfilePic($userId, $croppedImageData, $pdo);

	if (strpos($message, 'erfolgreich') !== false) {
		$success_msg = $message;
	} else {
		$error_msg = $message;
	}
}

// Anzeige des Profilbilds
$profilePicPath = getProfilePicPath($user['id'], $pdo);
?>

<div class="container main-container">
	<br>
	<p class="align-bottom">
		<img src="<?php echo htmlentities($profilePicPath); ?>" alt="<?= $username ?> Bild" style="width:150px; height:150px; border-radius:50%;">
		<span class="align-middle lead pl-2"><?= $username ?></span>
	</p>
	<p class="h1">Einstellungen</p>

	<?php if (isset($success_msg) && !empty($success_msg)): ?>
		<div class="alert alert-success">
			<?php echo $success_msg; ?>
		</div>
	<?php endif; ?>

	<?php if (isset($error_msg) && !empty($error_msg)): ?>
		<div class="alert alert-danger">
			<?php echo $error_msg; ?>
		</div>
	<?php endif; ?>

	<div>
		<!-- Nav tabs -->
		<div class="custom-tab">
			<ul class="tab-list">
				<li class="tab-item active" data-tab="data">Persönliches</li>
				<li class="tab-item" data-tab="email">E-Mail</li>
				<li class="tab-item" data-tab="profil">Bild</li>
				<li class="tab-item" data-tab="passwort">Passwort</li>
			</ul>

			<div class="tab-content">
				<!-- Persönliche Daten -->
				<div id="data" class="tab-pane active">
					<form action="?save=personal_data" method="post" class="form-horizontal" accept-charset="utf-8">
						<div class="form-group">
							<label for="inputVorname" class="col-sm-2 control-label">Vorname</label>
							<div class="col-sm-10">
								<input class="form-control" id="inputVorname" name="vorname" type="text" value="<?php echo htmlentities($user['vorname']); ?>" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputNachname" class="col-sm-2 control-label">Nachname</label>
							<div class="col-sm-10">
								<input class="form-control" id="inputNachname" name="nachname" type="text" value="<?php echo htmlentities($user['nachname']); ?>" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputFestnetznummer" class="col-sm-2 control-label">Festnetznummer (optional):</label>
							<div class="col-sm-10">
								<input type="text" id="inputFestnetznummer" name="festnetz" class="form-control" value="<?php echo htmlentities($user['festnetz']); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="inputMobilnummer" class="col-sm-2 control-label">Mobilnummer (auch für WhatsApp):</label>
							<div class="col-sm-10">
								<input type="text" id="inputMobilnummer" name="mobil" class="form-control" value="<?php echo htmlentities($user['mobil']); ?>" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputGeburtsdatum" class="col-sm-2 control-label">Geburtsdatum</label>
							<div class="col-sm-10">
								<input type="date" id="inputGeburtsdatum" name="geburtsdatum" class="form-control" value="<?php echo htmlentities($user['geburtsdatum']); ?>" required>
							</div>
						</div>

						<!-- Spiel-Level -->
						<div class="form-group">
							<label for="spiel_level" class="col-sm-2 control-label">Spiel-Level</label>
							<div class="col-sm-10">
								<select name="spiel_level" id="spiel_level" class="form-control">
									<option value="Beginnend" <?php if ($user['spiel_level'] == 'Beginnend') echo 'selected'; ?>>Beginnend</option>
									<option value="Fortgeschritten" <?php if ($user['spiel_level'] == 'Fortgeschritten') echo 'selected'; ?>>Fortgeschritten</option>
									<option value="Mit LK-Punkten" <?php if ($user['spiel_level'] == 'Mit LK-Punkten') echo 'selected'; ?>>Mit LK-Punkten</option>
								</select>
							</div>
						</div>

						<!-- Über mich -->
						<div class="form-group">
							<label for="ueber_mich" class="col-sm-2 control-label">Über mich / ich suche...</label>
							<div class="col-sm-10">
								<textarea name="ueber_mich" id="ueber_mich" rows="4" class="form-control"><?php echo htmlentities($user['ueber_mich']); ?></textarea>
							</div>
						</div>

						<!-- Suche Tennis-Partner -->
						<div class="form-group">
							<div class="col-sm-10 my-3">
								<input type="checkbox" name="suche_tennis_partner" id="suche_tennis_partner" value="1" <?php if ($user['suche_tennis_partner']) echo 'checked'; ?>>
								<label for="suche_tennis_partner">Ich erlaube die Sichbarkeit für andere, z. B. für die Suche nach Spielpartnern</label>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">Speichern</button>
							</div>
						</div>
					</form>
				</div>

				<!-- Änderung des Profilbilds -->
				<div id="profil" class="tab-pane">
					<form id="uploadForm" action="settings.php" method="post" enctype="multipart/form-data" onsubmit="return prepareImageUpload()">
						<!-- Profilbild hochladen -->
						<label for="profile_pic">Profilbild hochladen:</label><br>
						<input type="file" name="profile_pic" id="profile_pic" accept="image/*" onchange="loadFile(event)">
						<br><br>
						<img id="imagePreview" style="max-width: 300px;">
						<br><br>
						<input type="hidden" name="cropped_image" id="cropped_image">
						<!--<button type="button" onclick="cropImage()">Bild zuschneiden</button>-->
						<button type="submit" name="upload_profile_pic" class="btn btn-success">Bild hochladen</button>
					</form>
				</div>

				<!-- Änderung der E-Mail-Adresse -->
				<div id="email" class="tab-pane">
					<br>
					<p>Zum Ändern deiner E-Mail-Adresse gib bitte dein aktuelles Passwort sowie die neue E-Mail-Adresse ein.</p>
					<form action="?save=email" method="post" class="form-horizontal" accept-charset="utf-8">
						<div class="form-group">
							<label for="inputPasswortA" class="col-sm-2 control-label">Passwort</label>
							<div class="col-sm-10">
								<input class="form-control" id="inputPasswortA" name="passwort" type="password" x-autocompletetype="current-password" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputEmail" class="col-sm-2 control-label">E-Mail</label>
							<div class="col-sm-10">
								<input class="form-control" id="inputEmail" name="email" type="email" value="<?php echo htmlentities($user['email']); ?>" x-autocompletetype="email" required>
							</div>
						</div>


						<div class="form-group">
							<label for="inputEmail2" class="col-sm-2 control-label">E-Mail (wiederholen)</label>
							<div class="col-sm-10">
								<input class="form-control" id="inputEmail2" name="email2" type="email" x-autocompletetype="email" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">Speichern</button>
							</div>
						</div>
					</form>
				</div>

				<!-- Änderung des Passworts -->
				<div id="passwort" class="tab-pane">
					<p>Zum Ändern deines Passworts gib bitte dein aktuelles Passwort sowie das neue Passwort ein.</p>
					<form action="?save=passwort" method="post" class="form-horizontal" accept-charset="utf-8">
						<div class="form-group">
							<label for="inputPasswort" class="col-sm-2 control-label">Altes Passwort</label>
							<div class="col-sm-10">
								<input class="form-control" id="inputPasswort" name="passwortAlt" type="password" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPasswortNeu" class="col-sm-2 control-label">Neues Passwort</label>
							<div class="col-sm-10">
								<input class="form-control" id="inputPasswortNeu" name="passwortNeu" type="password" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPasswortNeu2" class="col-sm-2 control-label">Neues Passwort (wiederholen)</label>
							<div class="col-sm-10">
								<input class="form-control" id="inputPasswortNeu2" name="passwortNeu2" type="password" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">Speichern</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var cropper;

	function loadFile(event) {
		var image = document.getElementById('imagePreview');
		image.src = URL.createObjectURL(event.target.files[0]);
		image.onload = function() {
			if (cropper) {
				cropper.destroy(); // Alte Instanz zerstören, falls vorhanden
			}
			cropper = new Cropper(image, {
				aspectRatio: 1, // quadratisch
				viewMode: 1,
				dragMode: 'move',
				cropBoxResizable: false,
				minCropBoxWidth: 200,
				minCropBoxHeight: 200,
				ready: function() {
					const cropBox = document.querySelector('.cropper-crop-box');
					const viewBox = document.querySelector('.cropper-view-box');
					cropBox.style.borderRadius = '50%';
					viewBox.style.borderRadius = '50%';
				}
			});
		};
	}

	function cropImage() {
		if (!cropper) {
			alert("Kein Bild zum Zuschneiden vorhanden.");
			return;
		}
		var croppedCanvas = cropper.getCroppedCanvas({
			width: 200,
			height: 200,
			imageSmoothingQuality: 'high',
		});

		var base64Image = croppedCanvas.toDataURL('image/jpeg');
		document.getElementById('cropped_image').value = base64Image;
	}

	function prepareImageUpload() {
		if (!document.getElementById('cropped_image').value) {
			cropImage(); // Zuschneiden, falls nicht bereits geschehen
		}
		return true;
	}
</script>

<?php
include("inc/footer.inc.php");
?>