<?php
# In der Navigation den aktuellen Menüpunkt auf bold setzen
$_jugend = "navcurrent";
$_aktuell="";
$_verein="";
$_mannschaften="";
$_training="";
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
	
	if (date("d.m.y") != $datum || trim($nachricht) == "" ) 
	{ 
		$smsMsgClass = "hidden";
	} 
?>
		<div id="blattSmsText">
			<section id="sms_Message" class="seite <?=$smsMsgClass?>">
				<h1>Letzte Meldung:</h1><p><?=$nachricht?></p>
			</section>
		</div>

		<div id="blatt5">
  			<section id="clubturnier" class="seite">
				<h2>Jugendclubturnier 2020</h2>
				<h3>Liebe Kinder und Jugendliche!</h3>

<p>Leider hat uns Corona einen ordentlichen Strich durch die Rechnung gemacht und wir mussten die diesjährigen Jugendclubmeisterschaften Ende April absagen.</p>

<p>Nachdem wir aber jetzt alle schon wieder voll im Trainingsbetrieb sind und die meisten von Euch auch bei den Punktspielen fleißig 
  spielen, möchte ich dieses Jahr die Clubmeisterschaften in einer etwas anderen Form für Euch organisieren.</p>

<p><strong>Wie soll der Ablauf sein?</strong></p>
<p>Wir werden nicht alles geballt an nur einem Wochenende durchführen, sondern über einen Zeitraum von Ende Juli bis Ende September 2020.</p>

<p><strong>Anmeldung?</strong></p>
<p>Bitte meldet Euch über unsere Homepage unter dem Bereich „intern“ an.</p>

<p><strong>Anmeldeschluss?</strong></p>
<p>Montag, 20.07.2020

<p><strong>Altersklassen?</strong></p>
<p>Nachdem es ab nächstem Jahr eine neue Einteilung der Altersklassen seitens des BTV geben wird, passen wir uns dem an und bieten folgende Altersklassen an:</p>
<ul>
<li>Midcourt (7 – 10 Jahre)</li>
<li>Bambini (11 – 12 Jahre)</li>
<li>Mädchen U 15 (13 – 15 Jahre)</li>
<li>Mädchen U 18 (16 – 18 Jahre)</li>
<li>Knaben U 15 (13 – 15 Jahre)</li>
<li>Knaben U 18 (16 – 18 Jahre)</li>
</ul>

<p>Bitte gebt bei der Anmeldung unbedingt an, in welcher Altersklasse Ihr spielen wollt und auch wann Ihr im Urlaub seid!
Sollte aufgrund von zu wenigen Meldungen eine Konkurrenz nicht zustande kommen, werden wir die Altersklassen zusammenlegen!</p>

<p><strong>Preise?</strong></p>
<p>Für die Erstplatzierten wird es Medaillen geben und jeder Teilnehmer erhält einen kleinen Sachpreis.</p>

<p>Für Rückfragen stehe ich Euch jederzeit gerne unter der Tel.: 08142/4482182 oder per E-Mail: jugendwart@tcolching.de zur Verfügung.</p>

<p>Der Vorstand und die Jugendleitung freuen sich über eine rege Teilnahme, faire Spiele und viel Spaß!</p>

<p>Viele Grüße</p>

<p><strong>Petra Streif</strong></p>
<p>(Jugendsportwart)</p>
			</section>
    </div>
    
		<div id="blatt1">
  			<section id="jugendwoche" class="seite">
				<h2>Impressionen von der Jugendwoche 2019</h2>
				<p><img alt="Gruppenbild" class="w-100" src="images/Kids/TCO-Jugendwoche19_Pic1_presse.jpg" /></p>
				<p><img alt="Rückhandtraining" class="w-100" src="images/Kids/TCO-Jugendwoche19_Pic2_presse.jpg" /></p>
				<p><img alt="Kleinfeldspiel" class="w-100" src="images/Kids/TCO-Jugendwoche19_Pic3_presse.jpg" /></p>
			</section>
    </div>
    
    <div id="blatt2">
  		<section id="clubturnier2019" class="seite">
        <h6>Pressemeldung vom 2.5.2019</h6>
        <h2>Erfolgreiche Jugendclubmeisterschaften 2019 des TC Olching e.V.</h2>
        <img alt="Siegerbild" class="w-100" src="images/jugendmeister2019.jpg" />
				<p>Am Wochenende des 27. und 28. Aprils fanden auf der Anlage des Tennisclub Olching e.V. die diesjährigen Jugendclubmeisterschaften statt.
           Bei kühlen Temperaturen kämpften 22 Kinder und Jugendliche zwischen 8 und 15 Jahren in vier Altersgruppen um den Titel. 
          Vereinsmeister bei den Knaben 16 wurde nach spannenden Duellen Rico Streif, vor Mario Michalsky und Nico Hochholzer. 
          Der Clubmeistertitel bei den Knaben 14 ging an Niklas Vogt. Platz 2 und 3 belegten in dieser Altersgruppe Sebastian Henke und Tobias Schreyer. 
          Die Mädchen 14 lieferten sich ebenfalls enge und vor allem lange Matches. Am Ende konnte sich Luna Streif vor 
          Fiona Roes und Sofie Traub durchsetzen. Auch die Bambinis von 8 - 12 zeigten vollen Einsatz und kämpften um jeden Punkt. Sieger in dieser 
          Kategorie wurde nach einem tollen Finalspiel Leo Traub vor Tim Schreyer und Stefan Popovic. Die Kinder konnten sich über Medaillen, 
          Urkunden und Sachpreise freuen. „Alle Kinder und Jugendliche waren mit großer Freude sowie mit viel Spaß und Engagement dabei. Alle 
          Teilnehmer lieferten sich spannende und faire Spiele und zeigten sich allesamt gut vorbereitet, um in die kommende Punktspielsaison zu 
          starten, die Mitte Mai beginnt“, freute sich Jugendwartin und Organisatorin Petra Streif.
        </p>
        <h6>zuständig für die Presse (Pressewart):</h6>
        <h6>Thomas Stief</h6>
        <h6>Tel.: 0172 / 784 59 38</h6>
        <h6>E-Mail: presse@tcolching.de</h6>

      </section>
    </div>


		<!-- <div id="blatt3">
			<section id="kidsday" class="seite">
        <h2>Kid's Day 2019</h2>
        <p>Liebe Kinder,</p>
        <p>wir vom Tennisclub Olching möchten euch zu unserem <strong>Kids-Day 2019 am Montag, 29.04.2019 von 16.00 – 17.30 Uhr</strong> recht herzlich 
        auf unsere Anlage in den Amperauen 14 in Olching einladen.</p>
        <p>Tennis</p>
        <ul>
          <li>macht Spaß</li>
          <li>fördert die Konzentration</li>
          <li>fördert die mentale Stärke</li>
          <li>fördert die motorischen Fähigkeiten (Koordination, Schnelligkeit, Reaktionsfähigkeit, Ausdauer)</li>
        </ul>

        <p>An unserem Kids-Day werden wir mit euch Spiele und Übungen rund ums Tennis durchführen und mit euch natürlich 
          auch Tennis spielen. Durch spezielle Bälle werdet ihr sehr schnell positive Erfolgserlebnisse feiern und ein 
          Gefühl für Schläger und Ball entwickeln.</p>

        <p>Wer Lust hat, kann einfach vorbeikommen. Wir freuen uns auf Dich!</p>

        <p><strong>Ab 06. Mai 2019 bis Ende Juli</strong> (10x) findet <strong>montags von 16.00 – 17.00 Uhr</strong> unser Kindertennistraining statt. Kosten: € 90,00. 
          Solltet ihr schon vorab Interesse daran haben, wendet euch an kindertennis@tcolching.de. 
          Wir freuen uns über eure Fragen und Anmeldungen.</p>

        <p>Monika Traub & Petra Streif</p>



			</section>
		</div>
 -->
      <div id="blatt4">
			<section id="jugendleitung" class="seite">
				<h2>KINDER UND JUGEND BEIM TC OLCHING</h2>
				<article>
					<p>Die Jugendarbeit und Jugendf&ouml;rderung liegt uns sehr am Herzen!</p>
					<p>Derzeit sind 100 Kinder und Jugendliche zwischen 4 und 18 Jahren im Verein als Mitglieder gemeldet.</p>
					<p>In der Sommersaison 201 spielten folgende Jugendmannschaften f&uuml;r den TC Olching:</p>
					<ul>
						<li>Mädchen 14, Bezirksklasse 1     </li>
						<li>Knaben 16, Bezirksklasse 2 	    </li>
						<li>Knaben 14, Bezirksliga		    </li>
						<li>Bambini 12, Bezirksklasse 1	    </li>
						<li>Midcourt U10, Bezirksklasse 2	</li>
					
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
							<td>Petra Streif</td><td><a href="jugendwart@tcolching.de">jugendwart@tcolching.de</a></td>
							<td>Tel.: 08142/4482182</td>
						</tr>
						<tr>
							<td><strong>Tennisballschule:</strong></td>
						</tr>
						<tr>
							<td>Monika Traub</td><td><a href="kindertennis@tcolching.de">kindertennis@tcolching.de</a></td>
							<td>Tel.: 08142/6699661</td>
						</tr>
					</table>
					<div>
						<img id="kinderzeichnung" alt="Kinderzeichnung" src="images/Kids/zeichnung_farbig.gif">
					</div>
				</article>
			</section>
		</div>
		<div id="blatt5">
			<section id="clubturnier" class="seite">
				<h2>Jugendclubmeisterschaften 2017</h2>
				<img class="breitebilder" alt="Sieger Jugend 2017" src="images/Kids/jugendturnier_2017_gewinner_1.jpg"/>
				<p>Am Wochenende des 17. und 18. Juni fanden auf der Anlage des Tennisclub Olching e.V. die Jugendclubmeisterschaften 2017 statt. Dabei spielten die Kids in vier Altersklassen um den jeweiligen Titel. 
				</p>
				<p>
				Vereinsmeister bei den Junioren/Knaben wurde nach spannenden Duellen Rico Streif vor seinen Mannschaftskameraden Nico Hochholzer und Tim Küstner. Clubmeisterin der Mädchen wurde Luna Streif. Platz 2 und 3 belegten hier Hanna Roloff und Fiona Roes. Die elf- und zwölfjährigen männlichen Bambini lieferten sich ebenfalls einige enge Matches. Am Ende konnte sich Niklas Vogt vor Michael Moll und Alexander Vogt durchsetzen. Auch die Kleinsten, die Sieben- bis Zehnjährigen, kämpften um jeden Punkt. Sieger in dieser Kategorie wurde schließlich, wie bereits 2016, Bastian Hochholzer. Die weiteren Plätze belegten Paul Rietschel und Tim Schreyer. Die Kinder konnten sich über Medaillen, Urkunden und Sachpreise freuen. Außerdem wurden unter allen Teilnehmern noch 2 Karten für ein Spiel des FC Bayern München verlost. „Alle Kinder und Jugendliche waren mit großer Freude sowie viel Spaß und Engagement dabei, auch das Wetter hat gepasst. Alles in allem also ein tolles Wochenende. Die Spieler und Spielerinnen können mit sich zufrieden sein und der TC Olching ist stolz auf seinen Nachwuchs.“ freute sich Jugendwartin und Organisatorin Petra Streif.
				</p>
				<p>Petra Streif, Jugendwartin</p>
				<!--
					<a haref="http://www.amper-kurier.de/aktuell/aus-den-vereinen/jugendclubmeisterschaften-des-tc-olching-7555" alt="Amper-Kurier">Bericht im Amper-Kurier</a>
				-->
			</section>
		</div>

<?php
$diese_seite = "Aktuell";
include 'footer.php';
?>
