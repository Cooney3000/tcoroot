<?php
# In der Navigation den aktuellen Menüpunkt auf bold setzen
$_aktuell = "navcurrent";
$_verein="";
$_mannschaften="";
$_jugend="";
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
	$file = "work/indexmessages.txt";
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
		<div id="blatt1" class="blatt">
			<section id="news" class="seite neues">
        <article class="spalte1">
          <h6>Aktuelle Neuigkeiten</h6>
          <ul class="schlaeger">
            <li>Clubmeisterschaften 2019</li>
              <p>für Mannschafts- und Freizeitspieler/innen vom 22.5. - 21.9.2019! Zu weiteren <a href="/intern/turnier">Details</a></p>
            <hr>
            <li>Fassl-Turnier mit anschließendem Sommerfest am 20.7.2019</li>
            <hr>
            <li>Top-Tennis bei den Olching Open vom 30.08. - 01.09.</li>
            <hr>
            <li>Players & Friends Night am 12.10.</li>
          </ul>
        </article>
				<article>
					<h3>Unsere Jugend-Sponsoren</h3	>
          <a href="http://www.keller-rolladen.de/"><img src="images/sponsoren/Logo-KR.gif" alt="Keller Rolladen"  class="img-thumbnail"/></a>
          <a href="http://www.hapag-lloyd-reisebuero.de/index.asp?Agnt=48594"><img src="images/sponsoren/hlr_herz_header.png" alt="Hapag-Lloyd Reiseb&uuml;ro"  class="img-thumbnail"/></a>
          <a href="http://www.friseurkosmetik-fuchs.de/"><img src="images/sponsoren/fuchs.jpg" alt="Friseur- und Kosmetik G&uuml;nter Fuchs"  class="img-thumbnail"/></a>
          <a href="http://www.maler-stephan.de/"><img src="images/sponsoren/maler-stephan.gif" alt="Maler Stephan"  class="img-thumbnail"/></a>
        </article>
      </section>
		</div>
		<div id="blatt4" class="blatt">
			<section id="willkommen" class="seite">
				<h2>Herzlich willkommen beim TC Olching!</h2>
				<article class="spalte1">    
					<p>Wir freuen uns, dass du den Weg auf unsere Homepage gefunden hast.
							Hier wollen wir dir Informationen rund um den TC Olching wie die laufende Saison, Angebote, Termine und 
							aktuelle Ereignisse, Ansprechpartner und alles, was von Interesse für die Mitglieder und Freunde des 
							TC Olching ist, anbieten.</p>
					<p>Der TC Olching beim Bayerischen Tennisverband: <br></p>
					<table>
						<tr>
							<td>Vereinsseite:</td><td><a href="http://www.btv.de/BTVToServe/abaxx-?$part=Vereine.content.clubDaten.clubInfo&clubId=02262&$event=displayClubInfoFromMap&prevPath=Vereine.content.promoboxes.googleMaps&singleClub=false&clubStatus=200">Link</a></td>
						</tr>
						<tr>
							<td>Mannschaften:</td><td><a href="mannschaften.php">Link</a></td>
						</tr>
						<tr>
							<td>Mannschaftsbegegnungen:</td><td><a href="http://www.btv.de/BTVToServe/abaxx-?searchTimeRange=1&searchType=1&searchTimeRangeFrom=1.5.2016&searchTimeRangeTo=31.7.2061&club=02262&federation=BTV&%24part=Vereine.content.clubDaten.clubInfoRouter&theLeaguePage=b2sClubMeetings&searchMeetings=Suchen">Link</a></td>
						</tr>
						<tr>
							<td>Namentliche Meldungen (bitte dort die richtige Spielklasse wählen):</td><td><a href="http://www.btv.de/BTVToServe/abaxx-?$part=Vereine.index.menu&docPath=/BTV-Portal/Vereine/Meldungen&nodeSel=4&docId=1034504">Link</a></td>
						</tr>
					</table>
				</article>
			</section>
		</div>

		<div id="blatt5" class="blatt">
			<section id="neumitglieder" class="seite">
				<h2>Neumitglieder und vor allem Mannschaftsspieler gesucht!</h2>
				<div class="spalte1breit">
					<h3>Wir freuen uns über jedes neue Mitglied!</h3>
					<p>
						Vergleiche hierzu unsere besonderen Angebote „Schnuppermitgliedschaft“ und „Comeback-Training“ unter
						<a href="verein.php#schnuppern">Verein</a>.
					</p>
					<p>
						Ganz besonders aber suchen wir Spielerinnen und Spieler, die eine unserer <a href="mannschaften.php">Mannschaften</a> verstärken wollen.
						Wir haben immer Bedarf für folgende Mannschaften:
					</p>
					<ul>
						<li>Damen (Bezirksklasse 2)		      </li>
						<li>Damen 30 (Super Bezirksliga)      </li>
						<li>Herren (Bezirksklasse 3)		  </li>
						<li>Herren 40 (Bezirksklasse 1)			  </li>
						<li>Herren 50 (Bezirksklasse 1, Aufstiegskandidat)       </li>
						<li>Herren 50 (Bezirksklasse 2)       </li>
					</ul>
					<p>
						Wer hier Interesse hat, schreibt bitte eine kurze Mail an  <a href="mailto:mail@tcolching.de">mail@tcolching.de</a>.
					</p>
					<p>
					Ach ja: Natürlich können auch Neumitglieder, die in einer Mannschaft spielen wollen, dies über eine Schnuppermitgliedschaft realisieren. 
					</p>
				</div>
				<div class="spalte2">
					<iframe id="lkraceIframe" src="https://mybigpoint.tennis.de/services/?action=lkracenv&verband=BTV&cnt=5&verein=02262"></iframe>
					<p style="font-size:smaller">Siehe hierzu auch <a href="datenschutzerklaerung.php#dsgvolkrace">DSGVO - LK Race</p>
				</div>
			</section>
		</div>
<!--
		<div id="blatt4" class="blatt">
			<section id="olchingopen" class="seite">
					<img src="images/oo2018.png" alt="Olching Open" class="breitebilder"/>
					<h3>Top-Tennis im Tennisclub Olching!</h3>
					<p>In Olching wurde Tennis der Spitzenklasse <strong>bei freiem Eintritt</strong> präsentiert. 
					Vom <strong>31. August bis 02. September 2018</strong> richtet der TC Olching e.V. nun zum 27. Mal die Olching Open aus. Bei einem 
					Preisgeld von 3.000 € erwarten wir erneut ein hochklassiges Teilnehmerfeld und spannende Matches.</p>

					<p>Gespielt wird auf der Anlage des TC Olching, sowie auf Plätzen der befreundeten Vereine TSV Geiselbullach, 
					TC Gernlinden, TC Puchheim und TC Eichenau.</p>
					<p>
						<strong>Komplette Ausschreibung zum Download</strong>: <a href="/downloads/OlchingOpenAusschreibung18.pdf">Ausschreibung</a>.
					</p>
					<p><strong>Meldeschluss ist der 27.08.2018</strong>. Anmeldung über <a href="https://mybigpoint.tennis.de/">MyBigPoint</a>.</p>
					<p><strong>Übernachtungsmöglichkeiten</strong> in Olching findest du <a href="verein.php#uebernachtung">hier</a>.</p>

					<br>
					<p id="ooschirmherr"><strong>Schirmherrschaft:<br>
						Andreas Magg</Strong><br>
						1. Bürgermeister v. Olching
					</p>
					<br>
					<p>Ermöglicht wird dies durch das Engagement einer  Vielzahl an freiwilligen 
						Helfern und natürlich durch die Unterstützung unserer Sponsoren!
					</p>
					<div class="sponsoren">
						<div class="sponsor">  
							&nbsp;
						</div>
						<div class="sponsor">  
							<a href="http://www.getraenke-kraemer.de/"><img alt="Kr&auml;mer" src="images/sponsoren/Kraem.jpg"></a>
						</div>
						<div class="sponsor">  
							<a href="http://www.jgwerbung.de/"><img alt="JG" src="images/sponsoren/JG.jpg"></a>
						</div>
						<div class="sponsor">  
							&nbsp;
						</div>
						<div class="sponsor">  
							&nbsp;
						</div>
						<div class="sponsor">  
							<a href="http://www.sparkasse-ffb.de/"><img alt="SSK" src="images/sponsoren/SSK.jpg"></a>
						</div>
						<div class="sponsor">  
							<a href="http://auto-rauscher.de/"><img alt="Rauscher" src="images/sponsoren/rauscher.png"></a>
						</div>
						<div class="sponsor">  
							&nbsp;
						</div>
					</div>
					<img src="images/sponsoren/thomas_stief.png" alt="Design Thomas Stief" class="breitebilder"/>

			</section>
		</div>
-->

<?php
include 'footer.php';
?>
