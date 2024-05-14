<?php
# In der Navigation den aktuellen Menüpunkt auf bold setzen
$_jugend = "navcurrent";
$_aktuell = "";
$_verein = "";
$_mannschaften = "";
$_training = "";
$_header = "Jugend";
include 'header.php';
?>
<?php

/* 
	Nachrichtenticker für den Trainer, wenn das Training z. B. in die Halle verlegt wird.
	Die Nachricht kann in der Seite 
				msg.php 
	bearbeitet werden.
*/
// Die Nachricht nur ausgeben, wenn die Meldung nicht leer und von heute ist
$file = "work/messages.txt";
$nachricht = file_get_contents($file);
$datum = substr($nachricht, 0, 8);
$nachricht = substr($nachricht, 9);

if (date("d.m.y") != $datum || trim($nachricht) == "") {
	$smsMsgClass = "hidden";
}
?>
<div id="blattSmsText">
	<section id="sms_Message" class="seite <?= $smsMsgClass ?>">
		<h1>Letzte Meldung:</h1>
		<p><?= $nachricht ?></p>
	</section>
</div>

<div id="blatt5">
	<section id="kidsday22" class="seite">
		<h2>Alle Trainingsangebote für Jugendliche:
			<strong><a href="training.php">zur Trainer-Seite</a></strong>
		</h2>
	</section>
</div>

<?php /*
<div id="blatt3">
	<section id="kidsday" class="seite">
		<h2>Kid's Day 2023</h2>
		<img alt="Kids Day" class="w-100" src="images/Kids/kidsday23.png" />
		<article>
			<strong>
				<p>für alle Kinder von 4 - 9 Jahren, die Lust haben auf:</p>
				<ul>
					<li>Bewegung und Spaß</li>
					<li>Spiele mit dem Ball</li>
					<li>Spiele in der Gruppe</li>
				</ul>
			</strong>
			<img alt="Kids Day" class="w-100" src="images/Kids/kidsday23_vorteile.png" />
			<strong>
				<p>9 x Tennisballschule ab Montag, 15.5.23 16.00 – 17.00 Uhr</p>
				<p>70 € (keine Mitgliedschaft erforderlich – bei Regen fällt es aus)</p>
				<p>Weitere Infos: kindertennis@tcolching.de</p>
				<p>Außerdem bieten wir Tennistraining für Anfänger und Fortgeschrittene in Kleingruppen für jedes Alter bei unserem Vereinstrainer Michael an.</p>
				</p>
			</strong>

			<p>Heiko Tesche: <a href="mailto:kindertennis@tcolching.de">kindertennis@tcolching.de</a></p>

		</article>
	</section>
</div>
*/ ?>

<div id="blatt1">
	<section id="kidsday22" class="seite">
		<h2>Kid's Day 2022</h2>
		<p><img alt="Presseartikel FFB Tagblatt" class="w-100" src="images/Kids/2022-05-11_Tagblatt-Sport.png" /></br>Aus dem Amperkurier vom 26.8.2021</p>
	</section>
</div>

<div id="blatt2">
	<section id="jugendwoche" class="seite">
		<h2>Impressionen von der Jugendwoche 2021</h2>
		<p><img alt="Presseartikel Amperkurier" class="w-100" src="images/jugendwoche/amperkurier210826.png" /></br>Aus dem Amperkurier vom 26.8.2021</p>
		<p><img alt="Gruppenbild" class="w-100" src="images/jugendwoche/jw21_01.jpg" /></p>
		<p><img alt="Kleinfeldspiel" class="w-100" src="images/jugendwoche/jw21_02.jpg" /></p>
	</section>
</div>

<div id="blatt4">
	<section id="jugendleitung" class="seite">
		<h2>KINDER UND JUGEND BEIM TC OLCHING</h2>
		<article>
			<p>Die Jugendarbeit und Jugendf&ouml;rderung liegt uns sehr am Herzen!</p>
			<p>Derzeit sind 100 Kinder und Jugendliche zwischen 4 und 18 Jahren im Verein als Mitglieder gemeldet.</p>
			<p>In der Sommersaison 2021 spielten folgende Jugendmannschaften f&uuml;r den TC Olching:</p>
			<ul>
				<li>Juniorinnen U18, Bezirksklasse 1</li>
				<li>Junioren U18, Bezirksklasse 2</li>
				<li>Knaben U15/1, Bezirksklasse 1</li>
				<li>Knaben U15/2, Bezirksklasse 3</li>
				<li>Bambini U12, Bezirksklasse 2</li>
				<li>Midcourt U10, Bezirksklasse 1</li>

			</ul>
			<p>Um den unterschiedlichen Anspr&uuml;chen und Spielst&auml;rken gerecht zu werden, bieten wir den Kindern und Jugendlichen folgende M&ouml;glichkeiten:</p>

			<p>F&uuml;r die Kleinsten und Anf&auml;nger zwischen 4 - 9 Jahre ist Moni mit unserer Tennisballschule zust&auml;ndig. Uns ist es sehr wichtig, die Kinder mit viel Spa&szlig;, Freude und Motivation an den Tennissport heranzuf&uuml;hren. Tennis macht aber nicht nur Spa&szlig;, sondern f&ouml;rdert auch die Konzentration, die mentale St&auml;rke sowie die motorischen F&auml;higkeiten wie Koordination, Schnelligkeit, Reaktionsf&auml;higkeit und Ausdauer.</p>
			<p>Weitere und genauere Informationen findet Ihr unter der Rubrik <a href="training.php">Training</a>.</p>
			<p>F&uuml;r die Kinder, die Spa&szlig; am Tennissport gefunden haben oder bereits schon Tennis spielen, m&ouml;chten wir das Jugendtraining bei unserem Vereinstrainer Michael Görzen ans Herz legen. Tennis ist eine sehr technische Sportart und daher ist es &auml;u&szlig;erst wichtig, von Anfang an eine fundierte Technikausbildung zu bekommen. Dadurch wird es viel einfacher und befriedigender diese Sportart auszu&uuml;ben.</p>

			<p>F&uuml;r Fragen, Anregungen und Probleme stehen wir Euch jederzeit sehr gerne zur Verf&uuml;gung. Nachfolgend alle Ansprechpartner im Jugendsportbereich, damit Ihr uns direkt erreichen k&ouml;nnt:</p>

			<table id="jugendkontakte">
				<tr>
					<td><strong>Jugendwartin:</strong></td>
				</tr>
				<tr>
					<td>Heiko Tesche</td>
					<td><a href="jugendwart@tcolching.de">jugendwart@tcolching.de</a></td>
				</tr>
				<tr>
					<td><strong>Tennisballschule:</strong></td>
				</tr>
				<tr>
					<td>Heiko Tesche</td>
					<td><a href="kindertennis@tcolching.de">kindertennis@tcolching.de</a></td>
				</tr>
			</table>
			<div>
				<img id="kinderzeichnung" alt="Kinderzeichnung" src="images/Kids/zeichnung_farbig.gif">
			</div>
		</article>
	</section>
</div>


<?php
$diese_seite = "Aktuell";
include 'footer.php';
?>