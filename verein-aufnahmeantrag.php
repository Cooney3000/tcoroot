<?php
# In der Navigation den aktuellen Menüpunkt auf bold setzen
$_verein = "navcurrent";
$_aktuell = "";
$_mannschaften = "";
$_jugend = "";
$_training = "";
$_header = "Verein - Antrag 1";
include 'header.php';
?>
<div id="blatt2">
	<section id="antrag" class="seite">

		<div class="container mt-5">
			<form action="verein-aufnahme_2.php" method="post">
				<h2>Antrag auf Aufnahme oder zu einem Saisonprogramm</h2>
				<p class="kleingedrucktes">Alle Eingabedaten werden sicher verschlüsselt übertragen und ausschließlich im Rahmen der Verwaltung deiner Mitgliedschaft verarbeitet.
				<div class="form-group">
					<label for="vorname" class="pl-3">* Vorname:</label>
					<input type="text" class="form-control" id="vorname" name="vorname" required>
					<label for="vorname" class="pl-3">* 	Nachname:</label>
					<input type="text" class="form-control" id="nachname" name="nachname" required>
					<label for="name" class="pl-3">ggf. Erziehungsberechtigte/r - Name, Vorname:</label>
					<input type="text" class="form-control" id="erziehungsberechtigter" name="erziehungsberechtigter">
				</div>

				<div class="form-group">
					<label for="strasse">* Straße, Hausnummer:</label>
					<input type="text" class="form-control" id="strasse" name="strasse" required>
				</div>

				<div class="form-group">
					<label for="plz_ort">* PLZ:</label>
					<input type="text" class="form-control" id="plz" name="plz" required>
					<label for="plz_ort">* Wohnort:</label>
					<input type="text" class="form-control" id="ort" name="ort" required>
				</div>

				<div class="form-group">
					<label for="geboren">* Geburtsdatum:</label>
					<input type="date" class="form-control" id="geburtsdatum" name="geburtsdatum" required>
				</div>

				<div class="form-group">
					<label for="tel">* Telefon:</label>
					<input type="tel" class="form-control" id="tel" name="tel" required>
				</div>

				<div class="form-group">
					<label for="email">* E-Mail:</label>
					<input type="email" class="form-control" id="email" name="email" required>
				</div>

				<div class="form-group">
					<label>* Geschlecht:</label>
					<div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" id="maennlich" name="geschlecht" value="maennlich">
							<label class="form-check-label" for="maennlich">männlich</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" id="weiblich" name="geschlecht" value="weiblich">
							<label class="form-check-label" for="weiblich">weiblich</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" id="divers" name="geschlecht" value="divers">
							<label class="form-check-label" for="divers">divers</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="nationalitaet">Nationalität:</label>
					<input type="text" class="form-control" id="nationalitaet" name="nationalitaet">
				</div>
				<div class="mb-3">
					<div class="form-group">
						<label for="spiellevel">* Spiellevel:</label>
						<select class="form-control" id="spiellevel" name="spiellevel" required>
							<option value="">Bitte wähle dein Spiellevel</option>
							<option value="Noch nie gespielt">Anfänger - Ich habe noch nie Tennis gespielt oder gerade erst begonnen.</option>
							<option value="Anfänger">Fortgeschrittener Anfänger - Ich kann den Ball im Spiel halten, aber habe Schwierigkeiten, gezielt zu spielen.</option>
							<option value="Kann den Ball halten">Freizeitspieler - Ich kann regelmäßig den Ball im Spiel halten und beginne, gezielter zu spielen.</option>
							<option value="Kann Punkte machen">Fortgeschritten - Ich habe solide Grundschläge und kann bei Spielen Punkte gezielt machen.</option>
							<option value="Mannschaftsspieler">Mannschaftsspieler - Ich habe in einem Club in einer Mannschaft und in Turnieren gespielt.</option>
						</select>
					</div>

				</div>


				<div class="mb-3">
					<h2>Mitgliedschaft oder Programm</h2>
					<section>
						<table>
							<thead>
								<tr>
									<th>* Mitgliedschaft</th>
									<th class="geldbetrag">Jahresbeitrag</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="kind_bis_10" name="mitgliedschaft" value="Kind bis 10" required>
											<label class="form-check-label" for="kind_bis_10">Kind bis 10 Jahre</label>
										</div>

									</td>
									<td class="geldbetrag">35,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="kind_bis_14" name="mitgliedschaft" value="Kind bis 14" required>
											<label class="form-check-label" for="kind_bis_14">Kind bis 14 Jahre</label>
										</div>
									</td>
									<td class="geldbetrag">55,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="jug_bis_18" name="mitgliedschaft" value="Jugendliche bis 18" required>
											<label class="form-check-label" for="jug_bis_18">Jugendliche bis 18 Jahre</label>
										</div>
									</td>
									<td class="geldbetrag">85,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="azubi_student" name="mitgliedschaft" value="Azubi/Student" required>
											<label class="form-check-label" for="azubi_student">Azubis/Studenten bis 26 Jahre <sup>1</sup></label>
										</div>
									</td>
									<td class="geldbetrag">105,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="erwachsener" name="mitgliedschaft" value="Erwachsener" required>
											<label class="form-check-label" for="erwachsener">Erwachsener</label>
										</div>
									</td>
									<td class="geldbetrag">225,00 EUR </td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="ehepaar" name="mitgliedschaft" value="Ehepaar" required>
											<label class="form-check-label" for="ehepaar">Ehepaare</label>
										</div>
									</td>
									<td class="geldbetrag">380,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="familie" name="mitgliedschaft" value="Familie" required>
											<label class="form-check-label" for="familie">Familie (Kinder bis 18 Jahre)</label>
										</div>
									</td>
									<td class="geldbetrag">410,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="kind_mit_elternteil" name="mitgliedschaft" value="Kind mit Elternteil" required>
											<label class="form-check-label" for="kind_mit_elternteil">Kind m. vollzahldendem Elternteil</label>
										</div>
									</td>
									<td class="geldbetrag">35,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="passivmitglied" name="mitgliedschaft" value="Passivmitglied" required>
											<label class="form-check-label" for="passivmitglied">Passiv-Mitglied</label>
										</div>
									</td>
									<td class="geldbetrag">55,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="schnuppermitglied" name="mitgliedschaft" value="Schnuppermitglied" required>
											<label class="form-check-label" for="schnuppermitglied">Schnuppermitglied <sup>2</sup></label>
										</div>
									</td>
									<td class="geldbetrag">55,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="comeback" name="mitgliedschaft" value="Comebacktraining" required>
											<label class="form-check-label" for="comeback">Schnuppermitglied inkl. <a href="/training.php#angebote2024">"Start-Up-Ttraining"</a> <sup>2</sup></label>
										</div>
									</td>
									<td class="geldbetrag">190,00 EUR</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="jugSchnuppermitglied" name="mitgliedschaft" value="Jugend Schnuppermitglied" required>
											<label class="form-check-label" for="jugSchnuppermitglied"><a href="/training.php#angebote2024">Jugend Schnuppertraining</a> <sup>2</sup></label>
										</div>
									</td>
									<td class="geldbetrag">190,00 EUR</td>
								</tr>
								<th>* Programm (ohne Mitgliedschaft)</th>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="ballschule" name="mitgliedschaft" value="Ballschule" required>
											<label class="form-check-label" for="ballschule"><a href="/training.php#angebote2024">Ballschule</a> <sup>3</sup></label>
										</div>
									</td>
									<td class="geldbetrag">135,00 EUR</td>
								</tr>

							</tbody>
						</table>
						<p class="kleingedrucktes"><sup>1</sup> Um diese Beitragsermäßigung in Anspruch nehmen zu können, müssen die entsprechenden Bescheinigungen/Nachweise
							selbstständig und rechtzeitig bis spätestens 31. Dezember eines jeden Jahres dem Verein vorliegen.
							Nachträglich vorgelegte Bescheinigungen werden nicht rückwirkend berücksichtigt!
						</p>
						<p class="kleingedrucktes"><sup>2</sup> Die Schnuppermitgliedschaft, auch Jugend, kann nur einmal in Anspruch genommen werden und endet automatisch am 20. Juli.
							Wird bis zu diesem Datum die reguläre Mitgliedschaft beantragt, kann bis zum Saisonende ohne Mehrkosten gespielt werden.
						</p>
						<p class="kleingedrucktes"><sup>3</sup> Die Ballschule beinhaltet keine Mitgliedschaft. Die Kinder sind pauschal über den BLSV versichert.
						</p>
					</section>


				</div>


				<section class="kleingedrucktes">
					<h2>Hinweise:</h2>
					<p> Durch Absenden dieses Formulars erklärt der Antragstellende, stellvertretend bei unter 18jährigen für ihn der/die Erziehungsberechtigte/n, seinen Beitritt und
						verpflichtet sich zur Einhaltung der Satzung und Ordnungen, insbesondere zur pünktlichen Bezahlung des Vereinsbeitrages und Unterstützung der
						Vereinsziele. Die Satzung und weitere Informationen finden Sie hier: <a href="/downloads/Satzung_TCO.pdf">Satzung (PDF)</a></p>
					<p>Ein Nichtbezahlen des Beitrages hat nach 2 erfolglosen Mahnungen den Ausschluss aus dem Verein zur Folge. Änderungen bezüglich der Adress- oder
						Kontodaten sind unverzüglich dem Verein mitzuteilen.</p>
					<p><strong> Austritt / Kündigung:</strong></p>
					<p>Der Austritt aus dem Verein kann nur durch schriftliche Erklärung per Brief oder E-Mail gegenüber dem Vorstand
						jährlich zum 30.11. erfolgen.</p>
					<p><strong>SEPA-Lastschriftmandat / Pre-Notification / Fälligkeitsavis:</strong></p>
					<p>Zum Einzug der Mitgliedsbeiträge wird mit dem Zahler ein SEPA-Lastschriftmandat abgeschlossen. Der Beitragseinzug erfolgt zu den unter Einzugstermine
						genannten Fälligkeiten.</p>
					<p class="text-danger"><strong>Einzugstermin</strong> – Wiederkehrende Zahlungen: Jährlich am <strong>20. Januar</strong></p>
					<p><strong>Bitte beachten:</strong> Bei unterjährigem Eintritt ist der erste Beitrag für das laufende Jahr zu überweisen.
						Beiträge für die Folgejahre werden dann eingezogen.</p>
					<p><strong>Gebühren:</strong></p>
					<p>Alle im Zusammenhang einer Rücklastschrift jedweder Art entstehenden Gebühren sind vom Zahler zu tragen. Die Erinnerung an evtl. Außenstände ist
						kostenfrei, für nachfolgende Mahnungen werden weitere Gebühren seitens des Vereins erhoben.</p>
					<p><strong> Datenspeicherung:</strong></p>
					<P>Das Mitglied und der Zahlungspflichtige sind damit einverstanden, dass ihre Daten für Vereinszwecke gespeichert werden. Der Verein verarbeitet die
						Daten ausschließlich im Rahmen der Vereinsverwaltung. Die Daten werden nicht an Dritte weitergeben. Die E-Mail-Adresse ist der zentrale Kommunikationskanal
						und wird für Vereinsmitteilungen an alle Mitglieder verwendet.</P>

				</section>

				<div class="form-group">
					<h2>Bankverbindung für den Lastschrifteinzug</h2>
					<label for="kontoinhaber">* Kontoinhaber:</label>
					<input type="text" class="form-control" id="kontoinhaber" name="kontoinhaber" required>
				</div>

				<div class="form-group">
					<label for="konto_iban">* IBAN:</label>
					<input type="text" class="form-control" id="konto_iban" name="konto_iban" required>
				</div>

				<div class="mb-3">
					<h2>Weitere Informationen / Bemerkungen</h2>
					<label for="bemerkungen" class="form-label">Bemerkungen</label>
					<textarea class="form-control" id="bemerkungen" name="bemerkungen" rows="3" 
						placeholder="Füge hier deine Kommentare hinzu. Bei Familien oder Ehepaaren sind hier die Namen aller weiteren Familienmitglieder mit Geburtsdatum hilfreich. Oder teile uns deine BTV-Leistungsklasse (LK) mit, falls du eine hast."></textarea>
				</div>

				<button type="submit" class="btn btn-primary">Antrag senden</button>
			</form>
		</div>
	</section>
</div>



<?php
include 'footer.php';
?>