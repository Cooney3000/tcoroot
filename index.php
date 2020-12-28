<?php
# In der Navigation den aktuellen Menüpunkt auf bold setzen
$_aktuell = "navcurrent";
$_verein="";
$_mannschaften="";
$_jugend="";
$_training="";

include 'header.php';
	
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
  
  // Jetzt noch die Gaststätte geöffnet/geschlossen-Meldung
  $file = "work/wirt.txt";
  $line = trim(file_get_contents($file));

  $wirtStatus = substr($line,0,1);
  $wirtAktivStatus = substr($line,1,1);
  $wirtStatusClass = ($wirtStatus) ? "btn-success" : "btn-danger";
  $wirtStatusText = ($wirtStatus) ? "geöffnet": "geschlossen";
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
          
          <?php if ($wirtAktivStatus == '1') {
            echo "<p>Die Vereinsgaststätte ist <span class=\"$wirtStatusClass px-1\"> $wirtStatusText </span></a></p>";
          } ?>

          <ul class="schlaeger">
            <li><strong>Clubturnier</strong> <p>B-Rundenauslosung ist online!<a href="/intern/turnier/turnierbaum.php"><br>Zum Tableau</a></p></li>
            <li><strong>Aktuelle Infos TCO (23.06.2020)!</strong> <p>Duschen, Zuschauen, Punktspiele, Gastro! <a href="#aktuellesschreiben">Zum Schreiben unseres Vorstandsvorsitzenden</a></p></li>
            <li><strong>Tennis zum Ausprobieren!</strong> <p>Schnuppermitgliedschaft ist eine günstige Möglichkeit! <a href="/verein.php#mitgliedschaft">Zur Übersicht</a></p></li>
            <li><strong>Corona-Regeln!</strong>
                <p><a href="https://www.btv.de/de/aktuelles/corona.html" target="_blank">Alle BTV Corona-News</a></p>
                <p><a href="https://www.btv.de/dam/jcr:0be26c7f-e989-4517-ac5c-9040b5428cd7/Hygiene-%20und%20Verhaltensregeln%20des%20BTV%20f%C3%BCr%20Spieler%20Plakat.pdf" target="_blank">Hygiene- und
  Verhaltensregeln</a></p>
            </li> 
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

		<div id="blatt2" class="blatt">
			<section id="aktuellesschreiben" class="seite">
				<h2>Herzlich willkommen beim TC Olching!</h2>
				<article class="p-3 bg-light">    
          <h3>Liebe Tennisfreunde,</h3>
          
<p>und wieder mal ein paar Neuigkeiten.</p>
<br>
<p class="h5">  Sanitäre Einrichtungen</p>
<p>Es freut uns euch mitteilen zu können, dass die Duschen und Umkleidekabinen ab dem 22.06. genutzt werden dürfen. Der Mindestabstand von 1,5 Metern ist aber zwingend einzuhalten. Vorgesehen sind maximal 4 Personen gleichzeitig pro Umkleidekabine.
Unsere Bitte an alle. Lüftet die Duschen und Umkleidekabinen während des Aufenthalts, so kann sich die Luft besser austauschen. Auf dem Weg in die Umkleidekabine, in der Kabine und beim Verlassen ist die Mund-Nasen-Bedeckung zu tragen. Das gleiche gilt für die Toiletten.
Ob ihr die Masken beim Duschen tragen wollt, überlassen wir euch.</p>
<br>
<p class="h5">Fahrgemeinschaften zu Punktspielen</p>
<p>Fahrgemeinschaften zu den Punktspielen sind erlaubt. Der BTV schreibt vor, dass hier auch die Mund-Nasen-Bedeckung zu tragen ist.</p>
<br>
<p class="h5">Anlagennutzung</p>
<p>Die Anlage ist nur zum Spielen zu betreten, d.h. reines Zuschauen ist leider momentan nicht gestattet.</p>
<p>Bei Jugendpunktspielen werden pro Mannschaft zwei Betreuer empfohlen und sind erlaubt.</p>
<p>Ein Aufenthalt im gastronomischen Bereich ist natürlich möglich. Bitte, wie bisher, in Marcos ausliegende Listen am Tisch eintragen.</p>
<p>Wir möchten nochmals darauf hinweisen, dass jede Person ab 6 Jahren auf der Anlage eine Maske mitführen muss. Sind die erforderlichen Abstände kurzfristig nicht einzuhalten, muss sie aufgesetzt werden. Gerade an Punktspieltagen mit vielen Mannschaften, wie letzten Sonntag, ist dies erforderlich.</p> 
<br>
<p class="h5">Gastronomie</p>
<p>Seit dem 17.06. sind 10 Personen an einem Tisch ohne Abstände erlaubt.</p>
<p>Im Innenbereich ist auf dem Weg zum/vom Tisch die Mund-Nasen-Bedeckung zu tragen. Generell wäre es ratsam bei schönem Wetter die Terrasse zu nutzen. Die Ansteckungsgefahr mit Covid-19 ist dadurch sehr viel geringer.</p>
<br>
<p>Als Anlage erhaltet ihr noch die neuesten Hygiene- und Verhaltensregeln des BTV mit der Bitte um Beachtung.</p>
<br>
<p>Wir möchten uns ganz herzlich bei euch für die bisherige Unterstützung und die Umsetzung und Einhaltung der Maßnahmen bedanken. Bisher haben wir noch keinen gemeldeten Covid-19 Fall. Wenn wir alle zusammenhalten sind wir uns sicher das dies auch so bleibt.</p>
<br>
<p>Bis bald</p>
<p>Für den Vorstand</p>
TC Olching<br>
<strong>Heiko Tesche</strong><br>
1.Vorsitzender</p>
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
						<li>Herren (Bezirksklasse 3)		  </li>
						<li>Herren 40 (Bezirksklasse 1)			  </li>
						<li>Herren 50 (Bezirksklasse 1)       </li>
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
					<p style="font-size:smaller">Siehe hierzu auch <a href="datenschutzerklaerung.php#dsgvolkrace">DSGVO - LK Race</a></p>
				</div>
			</section>
    </div>
    
		<div id="blatt4" class="blatt">
			<section id="olchingopen" class="seite">
        <article class="spalte1">
          <img src="images/oo2019.png" alt="Olching Open" class="breitebilder"/>
        </article>
        <article>
          <a href="https://tennispark-gernlinden.de/"><img alt="Tennispark Gernlinden" src="images/sponsoren/tennispark_gernlinden.gif" class="img-thumbnail"></a>
          <a href="http://www.jgwerbung.de/"><img alt="JG" src="images/sponsoren/JG.jpg" class="img-thumbnail"></a>
          <a href="http://www.sparkasse-ffb.de/"><img alt="SSK" src="images/sponsoren/SSK.jpg" class="img-thumbnail"></a>
          <a href="http://auto-rauscher.de/"><img alt="Rauscher" src="images/sponsoren/rauscher2.png" class="img-thumbnail"></a>
        </article>
        <article class="clean">

					<h3>Top-Tennis im Tennisclub Olching!</h3>
					<p>In Olching wird Tennis der Spitzenklasse <strong>bei freiem Eintritt</strong> präsentiert. 
					Vom <strong>30. August bis 01. September 2019</strong> richtet der TC Olching e.V. nun zum 28. Mal die Olching Open aus. Bei einem 
					Preisgeld von 3.000 € erwarten wir erneut ein hochklassiges Teilnehmerfeld und spannende Matches.</p>

					<p>Gespielt wird auf der Anlage des TC Olching, sowie auf Plätzen der befreundeten Vereine TSV Geiselbullach, 
					TC Gernlinden, TC Puchheim und TC Eichenau.</p>
					<p>
						<strong>Komplette Ausschreibung zum Download</strong>: <a href="/downloads/OlchingOpenAusschreibung19.pdf">Ausschreibung</a>.
					</p>
					<p><strong>Meldeschluss ist der 26.08.2019</strong>. Anmeldung über <a href="https://mybigpoint.tennis.de/">MyBigPoint</a>.</p>
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
					<img src="images/sponsoren/thomas_stief.png" alt="Design Thomas Stief" class="breitebilder"/>
          </article>

			</section>
		</div>

<?php
include 'footer.php';
?>
