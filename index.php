<?php
# In der Navigation den aktuellen Menüpunkt auf bold setzen
$_aktuell = "navcurrent";
$_verein = "";
$_mannschaften = "";
$_jugend = "";
$_training = "";

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

if (date("d.m.y") != $datum || trim($nachricht) == "") {
  $smsMsgClass = "hidden";
}

// Jetzt noch die Gaststätte geöffnet/geschlossen-Meldung
$file = "work/wirt.txt";
$line = trim(file_get_contents($file));

$wirtStatus = substr($line, 0, 1);
$wirtAktivStatus = substr($line, 1, 1);
$wirtStatusClass = ($wirtStatus) ? "btn-success" : "btn-danger";
$wirtStatusText = ($wirtStatus) ? "geöffnet" : "geschlossen";
?>
<div id="blattSmsText">
  <section id="sms_Message" class="seite <?= $smsMsgClass ?>">
    <h1>Letzte Meldung:</h1>
    <p><?= $nachricht ?></p>
  </section>
</div>
<div id="blatt1" class="blatt">
  <section id="news" class="seite neues">
    <article class="spalte1">
      <h6>Aktuelle Neuigkeiten</h6>

      <?php if ($wirtAktivStatus == '1') {
        echo "<p>Die Vereinsgaststätte ist <span class=\"$wirtStatusClass px-1\"> $wirtStatusText </span></p>";
      } else {
        echo "<p>&nbsp;</p>";
      } ?>

      <ul class="schlaeger">
        <li><strong>Kid's Day ein voller Erfolg!</strong>
          <p><a href="jugend.php#kidsday">Zur Pressemeldung</a></p>
      </li>
        <li><strong>Drop-In-Start am 2. Mai ab 18 Uhr!</strong></li>
        <li><strong>Clubturnier 2022 - Jetzt anmelden!</strong>
          <p>Bitte meldet euch für unser diesjähriges Turnier an. Je früher, desto besser. Keine Startgebühr!</p>
		  <p><a href="https://www.tcolching.de/intern/turnier/index.php">Zur Anmeldeseite</a></p>
        </li>
        <li><strong>Tennis zum Ausprobieren!</strong>
          <p>Die Schnuppermitgliedschaft ist eine günstige Möglichkeit für Neueinsteiger!</p>
		  <p><a href="/verein.php#mitgliedschaft">Zur Übersicht</a></p>
        </li>
        <li><strong>Clubturnier 2021</strong>
          <p><a href="#clubturnier">Presseartikel</a></p>
        </li>
        <li><strong>Tennisjugendwoche 2021</strong>
          <p><a href="/jugend.php#jugendwoche">Eindrücke und Presseartikel</a></p>
        </li>
      </ul>
    </article>
    <article>
      <h3>Unsere Jugend-Sponsoren</h3>
      <a href="http://www.keller-rolladen.de/"><img src="images/sponsoren/Logo-KR.gif" alt="Keller Rolladen" class="img-thumbnail" /></a>
      <a href="http://www.hapag-lloyd-reisebuero.de/index.asp?Agnt=48594"><img src="images/sponsoren/hlr_herz_header.png" alt="Hapag-Lloyd Reiseb&uuml;ro" class="img-thumbnail" /></a>
      <a href="http://www.friseurkosmetik-fuchs.de/"><img src="images/sponsoren/fuchs.jpg" alt="Friseur- und Kosmetik G&uuml;nter Fuchs" class="img-thumbnail" /></a>
      <a href="http://www.maler-stephan.de/"><img src="images/sponsoren/maler-stephan.gif" alt="Maler Stephan" class="img-thumbnail" /></a>
    </article>
  </section>
</div>
<div id="blatt2" class="blatt">
  <section id="willkommen" class="seite">
    <h2>Herzlich willkommen beim TC Olching!</h2>
    <article>
      <p>Wir freuen uns, dass du den Weg auf unsere Homepage gefunden hast.
        Hier wollen wir dir Informationen rund um den TC Olching wie die laufende Saison, Angebote, Termine und
        aktuelle Ereignisse, Ansprechpartner und alles, was von Interesse für die Mitglieder und Freunde des
        TC Olching ist, anbieten.</p>
      <p>Der TC Olching beim Bayerischen Tennisverband: <br></p>
      <table>
        <tr>
          <td>Mannschaften:</td>
          <td><a href="mannschaften.php">Link</a></td>
        </tr>
      </table>
    </article>
  </section>
</div>

<div id="blatt3" class="blatt">
  <section id="neumitglieder" class="seite">
    <h2>Neumitglieder willkommen!</h2>
    <div>
      <h3>Wir freuen uns über jedes neue Mitglied!</h3>
      <p>
        Vergleiche hierzu unsere besonderen Angebote „Schnuppermitgliedschaft“ und „Comeback-Training“ unter
        <a href="verein.php#schnuppern">Verein</a>.
      </p>
      <h3>Geselligkeit wird großgeschrieben</h3>
      <p>Der TCO ist keine Tennisanlage, die man nach dem Spielen einfach so verlässt, sondern ein Verein, der ein gesellschaftliches Umfeld bietet.
        Daher bemühen wir uns um eine kontinuierliche Bewirtung für unser Vereinsheim.</p>
      <p>Die Mitglieder lieben es, nach dem Spiel noch das eine oder andere Getränk bei unseren Wirten zu genießen und bei einer netten Unterhaltung
        das Spiel der anderen zu beobachten.</p>
      <p>Zu verschiedensten Ereignissen wie Mannschaftswettkämpfen oder Turnierspielen treffen sich häufig weitere Mitglieder als Zuschauer.</p>
      <p>Und nicht selten werden die Abende nach dem Training länger als man sich vorgenommen hat.</p>

    <!-- <div class="spalte2">
					<iframe id="lkraceIframe" src="https://mybigpoint.tennis.de/services/?action=lkracenv&verband=BTV&cnt=5&verein=02262"></iframe>
					<p style="font-size:smaller">Siehe hierzu auch <a href="datenschutzerklaerung.php#dsgvolkrace">DSGVO - LK Race</a></p>
				</div> -->
  </section>
</div>
<div id="blatt4" class="blatt">
  <section id="clubturnier" class="seite">
    <article>
      <h3>Clubmeisterschaften 2021</h3>
      <p>
        Das Clubturnier wurde mit großer Teilnehmerzahl ein großer Erfolg bei wunderschönem Wetter! 
        In den Lokalblättern wurde darüber berichtet wie hier im Amperkurier vom 23.9.2021
      </p>
      <img src="images/amperkurier.jpg" alt="Artikel Amperkurier" />
    </article>
  </section>
</div>





<div id="blatt5" class="blatt">
  <section id="olchingopen" class="seite">
    <article class="spalte1">
      <img src="images/OlchingOpen/fahnen.png" alt="Olching Open" class="breitebilder" />
    </article>
    <article>
      <a href="https://tennispark-gernlinden.de/"><img alt="Tennispark Gernlinden" src="images/sponsoren/tennispark_gernlinden.gif" class="img-thumbnail"></a>
      <a href="http://www.jgwerbung.de/"><img alt="JG" src="images/sponsoren/JG.jpg" class="img-thumbnail"></a>
      <a href="http://www.sparkasse-ffb.de/"><img alt="SSK" src="images/sponsoren/SSK.jpg" class="img-thumbnail"></a>
      <a href="http://auto-rauscher.de/"><img alt="Rauscher" src="images/sponsoren/rauscher2.png" class="img-thumbnail"></a>
    </article>

    <article class="clean">

      <h3>Top-Tennis beim DTB-Turnier im Tennisclub Olching!</h3>
      <p>
        <!-- In Olching wird Tennis der Spitzenklasse <strong>bei freiem Eintritt</strong> präsentiert.  -->
        Jedes Jahr richtet der TC Olching e.V. die Olching Open aus. Bei einem
        Preisgeld von 3.000 € haben wir immer ein hochklassiges Teilnehmerfeld mit DTB-Ranglistenspieler:innen und spannende Matches.
      </p>
      <p>In den Jahren 2020/2021 musste das Turnier Corona-bedingt leider ausfallen. Wir sind zuversichtlich, dass es 2022 wieder stattfinden wird!</p>

      <p>Gespielt wird auf der Anlage des TC Olching, sowie auf Plätzen der befreundeten Vereine TSV Geiselbullach,
        TC Gernlinden, TC Puchheim und TC Eichenau.</p>
      <!-- <p>
						<strong>Komplette Ausschreibung zum Download</strong>: <a href="/downloads/OlchingOpenAusschreibung19.pdf">Ausschreibung</a>.
					</p> -->
      <!-- <p><strong>Meldeschluss ist der 26.08.2019</strong>. Anmeldung über <a href="https://mybigpoint.tennis.de/">MyBigPoint</a>.</p> -->
      <!-- <p><strong>Übernachtungsmöglichkeiten</strong> in Olching findest du <a href="verein.php#uebernachtung">hier</a>.</p> -->

      <br>
      <p id="ooschirmherr"><strong>Schirmherrschaft:<br>
          Andreas Magg</Strong><br>
        1. Bürgermeister v. Olching
      </p>
      <br>
      <p>Ermöglicht wird dies durch das Engagement einer Vielzahl an freiwilligen
        Helfern und natürlich durch die Unterstützung unserer Sponsoren!
      </p>
      <!-- <img src="images/sponsoren/thomas_stief.png" alt="Design Thomas Stief" class="breitebilder"/> -->
    </article>

  </section>
</div>

<?php
include 'footer.php';
?>