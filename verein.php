<?php
include 'lib/functions.php';

$navigation = setNavigation('verein');
$_header = "Verein";
include 'header.php';
?>
<div id="blatt1">
	<section id="mitgliedschaft" class="seite">
		<h2>Mitgliedsbeiträge</h2>
		<article>
			<table class="betont">
				<thead>
					<tr>
						<th>Mitgliedschaft</th>
						<th class="geldbetrag">Jahresbeitrag</th>
						<th class="mittig">Reduzierung durch Arbeitseinsatz möglich</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Kind bis 10 Jahre</td>
						<td class="geldbetrag">35,00 EUR</td>
						<td class="mittig">--</td>
					</tr>
					<tr>
						<td>Kind bis 14 Jahre</td>
						<td class="geldbetrag">55,00 EUR</td>
						<td class="mittig">--</td>
					</tr>
					<tr>
						<td>Jugendlicher bis 18 Jahre</td>
						<td class="geldbetrag">85,00 EUR</td>
						<td class="mittig">--</td>
					</tr>
					<tr>
						<td>Azubis/Studenten bis 26 Jahre *</td>
						<td class="geldbetrag">105,00 EUR</td>
						<td class="mittig">--</td>
					</tr>
					<tr>
						<td>Erwachsener</td>
						<td class="geldbetrag">225,00 EUR </td>
						<td class="mittig">✓</td>
					</tr>
					<tr>
						<td>Ehepaar</td>
						<td class="geldbetrag">380,00 EUR</td>
						<td class="mittig">✓</td>
					</tr>
					<tr>
						<td>Familie (Kinder bis 18 Jahre)</td>
						<td class="geldbetrag">410,00 EUR</td>
						<td class="mittig">✓</td>
					</tr>
					<tr>
						<td>Kind mit vollzahlendem Elternteil</td>
						<td class="geldbetrag">35,00 EUR</td>
						<td class="mittig">--</td>
					</tr>
					<tr>
						<td>Passiv</td>
						<td class="geldbetrag">55,00 EUR</td>
						<td class="mittig">--</td>
					</tr>
					<tr>
						<td>Schnuppermitglied</td>
						<td class="geldbetrag">55,00 EUR</td>
						<td class="mittig">--</td>
					</tr>
				</tbody>
			</table>
			<p>* Um diese Beitragsermäßigung in Anspruch nehmen zu können, müssen die entsprechenden Bescheinigungen/Nachweise
				selbstständig und rechtzeitig bis spätestens 31. Dezember eines jeden Jahres dem Verein vorliegen.
				Nachträglich vorgelegte Bescheinigungen werden nicht rückwirkend berücksichtigt!
			</p>
			<p>** Die Schnuppermitgliedschaft kann nur einmal in Anspruch genommen werden und endet automatisch am 20. Juli.
				Wird bis zu diesem Datum die reguläre Mitgliedschaft beantragt, kann bis zum Saisonende ohne Mehrkosten gespielt werden.
			</p>
			<h3>Hier gibt es den <strong><a href="verein-aufnahmeantrag.php">Aufnahmeantrag Online</a></strong>.</h3>
		</article>
	</section>
</div>
<div id="blatt2">
	<section id="schnuppern" class="seite">
		<h2>Schnuppermitgliedschaft</h2>
		<article>
			<p>
				Der TC Olching bietet auch dieses Jahr wieder allen Interessierten eine
				Schnuppermitgliedschaft für 55 EUR.
			</p>
			<ul>
				<li>Teilnahme am &#8222;Drop-In&#8220; (Mixed-Turnier zum Kennenlernen)
					jeden Montag ab 18:00 Uhr</li>
				<li>Spielberechtigung werktags bis 17:00 Uhr (nach 17:00 Uhr
					nur bei Verf&#252;gbarkeit der Pl&#228;tze &#8211; Mitglieder haben Vorrang!)</li>
				<li>Spielberechtigung am Wochenende und an Feiertagen bei
					Verf&#252;gbarkeit der Pl&#228;tze</li>
				<li>Ab Mitte Juli (nach Ende der Punktspielsaison)
					Spielberechtigung wie jedes andere aktive Mitglied, wenn ein
					Mitgliedsantrag für das Folgejahr vorliegt (siehe unten)</li>
			</ul>
			<p>
				<strong>Die Schnuppermitgliedschaft kann nur einmal in Anspruch genommen werden und endet automatisch am 20. Juli.
					Wird bis zu diesem Datum die reguläre Mitgliedschaft für das Folgejahr beantragt, kann bis zum Saisonende ohne Mehrkosten weitergespielt werden!</strong>
			</p>
			<p>Bei Interesse erreichst du uns telefonisch unter (08142) 667869, per E-Mail unter <a href="anmeldung@tcolching.de">anmeldung@tcolching.de</a>.
				Während der Öffnungszeiten unseres Vereinsheimes kannst du auch gerne eine Nachricht bei unseren Wirtsleuten hinterlassen.
			</p>
			<h3>Hier gibt es den <strong><a href="verein-aufnahmeantrag.php">Aufnahmeantrag Online</a></strong>.</h3>
		</article>
	</section>
</div>
<div id="blatt21">
	<section id="dropin" class="seite">
		<h2>Drop-In - jeden Montag ab 18:00 Uhr</h2>
		<article>
			<p>
				Jeden Montag treffen sich alle, die Lust haben zum "Drop-In". Spielerinnen und Spieler werden zu alle 20 Minuten wechselnden Mixed-Paarungen zusammengelost. Danach sitzen wir gerne zusammen bei einem gemütlichen verdienten Bier oder einem Cocktail. Unsere Vereinsgaststätte ist bewirtet.
			</p>
			<p>
				Die Teilnahme ist zum Kennenlernen auch für Nicht-Mitglieder zu einem symbolischen Beitrag von 1 EUR möglich.
			</p>
		</article>
	</section>
</div>

<div id="blatt5">
	<section id="vorstand" class="seite">
		<h2>Der Vorstand</h2>
		<article id="visitenkarten" class="container">
			<div class="row">
				<div class="col-6 col-md-4 col-lg-3 mb-3">
					<div class="visitenkarte card">
						<img alt="Conny Roloff" src="images/vorstand/conny_roloff.png" class="card-img-top">
						<div class="card-body">
							<p class="card-text">1. Vorsitzender<br>Conny Roloff<br>
								<a href="mailto:conny.roloff@tcolching.de">conny.roloff@tcolching.de</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4 col-lg-3 mb-3">
					<div class="visitenkarte card">
						<img alt="Michael Sachse" src="images/vorstand/michael_sachse.jpg" class="card-img-top">
						<div class="card-body">
							<p class="card-text">2. Vorsitzender<br>Michael Sachse<br>
								<a href="mailto:michael.sachse@tcolching.de">michael.sachse@tcolching.de</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4 col-lg-3 mb-3">
					<div class="visitenkarte card">
						<img alt="Andrea Gallert" src="images/vorstand/andrea_gallert.jpg" class="card-img-top">
						<div class="card-body">
							<p class="card-text">3. Vorsitzende, Kassenwartin<br>Andrea Gallert<br>
								<a href="mailto:andrea.gallert@tcolching.de">andrea.gallert@tcolching.de</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4 col-lg-3 mb-3">
					<div class="visitenkarte card">
						<img alt="Daniela Ulrich" src="images/vorstand/daniela_ulrich.jpg" class="card-img-top">
						<div class="card-body">
							<p class="card-text">Schriftführerin<br>Daniela Ulrich<br>
								<a href="mailto:schriftführer@tcolching.de">schriftführer@tcolching.de</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4 col-lg-3 mb-3">
					<div class="visitenkarte card">
						<img alt="Thomas Schek" src="images/vorstand/thomas_schek.jpg" class="card-img-top">
						<div class="card-body">
							<p class="card-text">Sportwart<br>Thomas Schek<br>
								<a href="mailto:sportwart@tcolching.de">sportwart@tcolching.de</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4 col-lg-3 mb-3">
					<div class="visitenkarte card">
						<img alt="Luna Streif" src="images/vorstand/luna_streif.png" class="card-img-top">
						<div class="card-body">
							<p class="card-text">Jugendwartin<br>Luna Streif<br>
								<a href="mailto:jugendwart@tcolching.de">jugendwart@tcolching.de</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4 col-lg-3 mb-3">
					<div class="visitenkarte card">
						<img alt="Thomas Stief" src="images/vorstand/thomas_stief.jpg" class="card-img-top">
						<div class="card-body">
							<p class="card-text">Beisitzer Pressearbeit<br>Thomas Stief<br>
								<a href="mailto:presse@tcolching.de">presse@tcolching.de</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4 col-lg-3 mb-3">
					<div class="visitenkarte card">
						<img alt="Lisa Fuchs" src="images/vorstand/lisa_fuchs.jpg" class="card-img-top">
						<div class="card-body">
							<p class="card-text">Beisitzerin<br>Lisa Fuchs<br>
								<a href="mailto:lisa.fuchs@tcolching.de">lisa.fuchs@tcolching.de</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</article>

	</section>
</div>

<div id="blatt3">
	<section id="unterstuetzung" class="seite">
		<h2>Unterstützung des TC Olching</h2>
		<article>
			<p>
				Als Verein hat der TC Olching natürlich keinerlei Gewinnerzielungsabsichten.
				Da jedoch der Betrieb eines Tennisvereins relativ kostenintensiv ist, freuen wir uns über jegliche Unterstützung.
			</p>
			<h3>Freiwilliges Engagement</h3>
			<p>
				Zu allererst ist hier natürlich das freiwillige Engagement all jener zu nennen, die in ihrer Freizeit Clubleben,
				Anlage, sportliche und gesellschaftliche Ereignisse sowie die Jugenbetreuung organiseren und am Laufen halten.
				Am offensichtlichsten ist dies bei unserer Vorstandsschaft. Aber genau so sind hier die zahlreichen
				freiwilligen Helfer verschiedener Anlässe zu nennen, sei es bei den Olching Open, bei Platzinstandsetzung oder
				Renovierung oder auch nur die kleine Handreichung beim DropIn.
				All dies zeugt von einem intakten Clubleben und ist durchaus etwas, auf das wir alle stolz sein können.
				Wer sich engagieren will, Michi weiß immer was zu tun ist: <a href="mailto:michael.sachse@tcolching.de">michael.sachse@tcolching.de</a>.
			</p>
			<h3>Sponsoren</h3>
			<p>
				Darüberhinaus sind wir natürlich immer wieder auf finanzielle Zuwendungen angewiesen.
				Auf der Startseite unseres Webauftrittes siehst du z. B. unsere Jugendsponsoren,
				die jeweils 50,00 € für die Jugendarbeit gespendet haben.
			</p>
			<p>
				Vielen Dank hierfür!
			</p>
			<p>
				Wer hieran noch Interesse hätte, kurze Mail an <a href="mailto:jugendwart@tcolching.de">jugendwart@tcolching.de</a> genügt.
			</p>
			<h3>Olching Open</h3>
			<p>
				Ein Turnier, bei dem Spieler, die niedrige 3-stellige Weltranglistenpositionen belegen, auftreten, ist ohne finanzielle Zuwendungen seitens
				Dritter für den TCO nicht zu stemmen. Für die diesjährigen Olching Open würden wir noch dringend Spendengelder benötigen.
				Wir gehen davon aus, daß die Erwähnung als Sponsor in Ausschreibung, im hiesigen Webauftritt, sowie auf der Anlage für jeden
				Gewerbebetrieb durchaus einen ernstzunehmenden Imagegewinn darstellt sowie den Bekanntheitsgrad steigert. Ansprechpartner hierfür wäre unser 1. Vorsitzender: <a href="mailto:heiko.tesche@tcolching.de">heiko.tesche@tcolching.de</a>.
			</p>
			<h3>5% für den TCO</h3>
			<p>
				Eine Zuwendung bietet sich auch über den Kauf von Tennisschlägern, -Schuhen, -Bekleidung und -Zubehör.
				Der Onlinehandler Tennisplanet.de vergütet dem TCO jede Bestellung über den untenstehenden Banner mit 5%.
			</p>
		</article>
	</section>
</div>

<div id="blatt4">
	<section id="geschichte" class="seite">
		<h2>Vereinsgeschichte</h2>
		<div>
			<p>Anlässlich seines 25-Jahr-Jubiläums <strong>im Jahre 1985</strong> wurde in einem Heft die Entstehung des TC Olching e. V.
				dokumentiert. <strong>Das Heft ist ein historisches Dokument mit vielen interessanten Details.</strong></p>
			<a href="/downloads/25-Jahre-TCO.pdf" target="_blank">
				<img src="/images/25-Jahre-TCO.png" class="img-fluid image-pleasant">
			</a>
			<p>Ein paar Jahre gab es sogar eine Vereinszeitschrift - <strong>"Der TCO´ler"</strong>. Hier sind drei Ausgaben aus den Jahren 2001 - 2003:</p>
			<div class="row">
				<div class="col-6 col-md-4 mb-3">
					<a href="/downloads/Der TCOler 2001.pdf" target="_blank">
						<img src="/images/Der TCOler 2001.png" class="img-fluid">
					</a>
				</div>
				<div class="col-6 col-md-4 mb-3">
					<a href="/downloads/Der TCOler 2002.pdf" target="_blank">
						<img src="/images/Der TCOler 2002.png" class="img-fluid">
					</a>
				</div>
				<div class="col-6 col-md-4 mb-3">
					<a href="/downloads/Der TCOler 2003.pdf" target="_blank">
						<img src="/images/Der TCOler 2003.png" class="img-fluid">
					</a>
				</div>
			</div>
		</div>
	</section>
</div>



<div id="blatt6">
	<section id="dokumente" class="seite">
		<h2>Downloads</h2>
		<h3>Satzung, Gastspielordnung, Platzordnung und mehr zum Download</h3>
		<ul>
			<li><a href="downloads/Satzung_TCO.pdf">Satzung</a></li>
			<li><a href="downloads/Gastspielordnung_2021.pdf">Gastspielordnung</a></li>
			<li><a href="downloads/Platzordnung_2021.pdf">Platzordnung</a></li>
		</ul>
	</section>
</div>
<div id="blatt1">
	<section id="anfahrt" class="seite">
		<h2>Anfahrt</h2>
		<iframe id="googlekarte" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2658.8147746398376!2d11.323605951557064!3d48.21018355397781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479e7efa9005591b%3A0x2115bcb26790403c!2sTennisclub+Olching+e.V.!5e0!3m2!1sde!2sde!4v1464081688508" allowfullscreen></iframe>
	</section>
</div>
<?php
include 'footer.php';
?>