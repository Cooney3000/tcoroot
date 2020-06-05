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
            <li><strong>Vereinsgaststätte ab dem 26.5. geöffnet!</strong> <p>Unser Wirt Marco ist wieder bei uns! <a href="#aktuellesschreiben">Zum Schreiben unseres Vorstandsvorsitzenden</a></p></li>
          </ul>
          <ul class="schlaeger">
            <li><strong>Tennis zum Ausprobieren!</strong> <p>Schnuppermitgliedschaft ist eine günstige Möglichkeit! <a href="/verein.php#mitgliedschaft">Zur Übersicht</a></p></li>
          </ul>
          <ul class="schlaeger">
            <li>
              <strong>Corona-Regeln!</strong>
              <ul style="font-size: 0.7rem">
                <li><a href="https://www.btv.de/de/aktuelles/corona.html" target="_blank">Alle BTV Corona-News</a></li>
                <li><a href="https://www.btv.de/dam/jcr:0be26c7f-e989-4517-ac5c-9040b5428cd7/Hygiene-%20und%20Verhaltensregeln%20des%20BTV%20f%C3%BCr%20Spieler%20Plakat.pdf" target="_blank">Hygiene- und
  Verhaltensregeln</a></li>
              </ul>
            </li>
          </ul>
          <ul class="schlaeger">
            <li><strong>Mannschaftstraining!</strong> <p>Beginnt ab dem 18.5.2020! <a href="/mannschaften.php#platzbelegung">Zum Plan</a></p></li>
          </ul>
          <ul class="schlaeger">
            <li><strong>Das Clubturnier findet statt!</strong> 
              <p>
              ...in reduzierter Form, Details kommen bald! <a href="/intern/internal.php">Jetzt anmelden</a>
              </p>
            </li>
          </ul>
          <ul class="schlaeger">
            <!-- <li><strong>Players & Friends Night</strong><img class="schlaegerimg" src="images/veranstaltungen/puf.jpg" alt="Players & Friends-Flyer"></li> -->
            <li><strong>Neuer Trainer Michael Görzen</strong> <p><a href="training.php">Zum Trainer</a></p></li>
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
          
<p>es freut mich sehr, euch mitteilen zu können, dass unsere Vereinsgaststätte ab dem 26.05.2020 geöffnet werden darf. Nach einigem 
  Schriftverkehr mit verschiedenen Behörden und Ämtern haben wir endlich das OK bekommen.</p>
  <br>
<p>Wie ihr euch vorstellen könnt, war und ist es für unseren Wirt Marco keine leichte Zeit. Die Gastronomie ist ja von der momentanen 
  Krise mit am stärksten betroffen. Unsere Bitte an euch wäre es deshalb, Marco so gut wie möglich zu unterstützen. Nutzt unsere 
  Vereinsgaststätte, nur so können wir uns langfristig einen Wirt leisten. Nur zur Info, Vereinsgaststätten, die von privaten Mitgliedern 
  betrieben werden (also Selbstversorgung) dürfen noch nicht geöffnet werden. Hier haben wir also einen großen Vorteil. Momentan darf 
  auf der Terrasse bis 20 Uhr und im Lokal bis 22 Uhr bewirtet werden.</p>
  <br>
<p class="h5">Restaurantregelungen für unsere Terrasse und das Clubheim</p>
<p>Natürlich gibt es für die Gastronomie aufgrund Covid-19 viele Vorschriften, die Marco mit unserer Unterstützung beachten muss. Hier die 
wichtigsten Regeln mit der Bitte/Aufforderung diese strikt einzuhalten</p>
<br>
<p>1.</p>
<p>Als oberstes Gebot gilt, wie überall, die Abstandsregel von 1,5 m zwischen den Personen. Dies gilt im Gaststättenbereich, bei den sanitären 
Einrichtungen genauso wie beim Betreten oder Verlassen der Räumlichkeiten. Personen eines Hausstandes haben die Regel nicht zu befolgen. 
Zwei Hausstände dürfen ohne Abstandsregelung an einem Tisch sitzen.</p>
<p>2.</p>
<p>Personen mit Kontakten zu Covid-19-Fällen in den letzten 14 Tagen oder mit den typischen Symptomen (Schnupfen, Geruchsverlust, Fieber, etc.) 
haben keinen Zutritt zum Gaststättenbereich.</>
<br>
<p>3.</p>
<p>Gäste haben eine Mund-Nasen-Bedeckung zu tragen. Diese ist auf dem Weg zum Tisch, zu den sanitären Einrichtungen und beim Verlassen des 
Tisches zu tragen. Am Tisch ist die Mund-Nasen-Bedeckung nicht nötig.</p>
<br>
<p>4.</p>
<p>Vor dem Betreten des Gastronomiebereichs sind bitte die Hände gründlich zu desinfizieren. Die entsprechenden Spender sind vor Ort.</p>
<br>
<p>5.</p>
<p>Beim Verlassen des Tisches bitte die Tischflächen desinfizieren. Wir wissen das dies eigentlich die Aufgabe des Wirtes ist. Da er aber 
alleine arbeitet, oft in der Küche ist bitten wir euch das für ihn zu übernehmen. Auch hier sind die entsprechenden Spender vor Ort.</p>
<br>
<p>6.</p>
<p>Um Kontaktpersonenermittlung im Falle eines nachträglich identifizierten Covid-19-Falles zu ermöglich, müssen wir Gästelisten führen. Pro 
Tisch liegt eine solche Liste aus. Bitte tragt euch mit Namen und Telefonnummer und Uhrzeit ein. Gäste müssen auch ihre Adresse eintragen. 
Keine Angst, die Blätter werden eingesammelt und sind für Dritte nicht einsehbar.</p>
<br>

<p>Allgemeines:</p>
<p>Die Regeln vom BTV wurden ja bereits kommuniziert, daher gehen wir hier nicht nochmal darauf ein. Hier zwei weitere Infos.</p>
<p>Das Doppelspiel um Punkte ist nach wie vor nicht erlaubt. Bitte haltet euch daran, auch wenn man diese Regelung nicht zwingend 
  verstehen muss. Eine neue Regelung kommt hoffentlich nächste Woche.</p>
<p>Die Punktspiele wurden nochmals verschoben. Start ist nun ab dem 15.06. Alle Richtlinien hierzu werden wir kommunizieren 
  sobald wir Infos haben.</p>
<br>
<p>Vielen Dank für die Einhaltung der Bestimmungen.</p>
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
