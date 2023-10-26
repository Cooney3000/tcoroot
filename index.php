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

$smsMsgClass = "";
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
  <section id="sms_Message" class="seite sms-danger <?= $smsMsgClass ?>">
    <h1>Aktuelle Meldung:</h1>
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

      <!-- *******************
              SCHLAGZEILEN
      -->  *******************
      <ul class="schlaeger">
        <li><strong>Interesse an Tennis?</strong>
          <p>Bei uns findet ihr Schnupperangebote für die ganze Familie!</p>
          <p><a href="/verein.php#mitgliedschaft">Mitgliedschafts-Optionen</a></p>
          <p><a href="/training.php">Trainingsangebote für Jugend und Erwachsene</a></p>
        </li>
        <li><strong>Aktuelle News aus der Presse!</strong>
          <p><a href="#presse">Hier zu den Details</a></p>
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

<?php
/*

<div id="blatt1" class="blatt">
  <section id="olchingopen" class="seite">
    <article class="clean">

      <h2>30. Olching Open 2023 - Spitzentennis live vom 01.09.-03.09!</h2>
      <p>
        <!-- In Olching wird Tennis der Spitzenklasse <strong>bei freiem Eintritt</strong> präsentiert.  -->
        Jedes Jahr richtet der TC Olching e.V. die Olching Open aus. Wir haben wie immer ein hochklassiges Teilnehmerfeld mit DTB-Ranglistenspieler:innen und spannenden Matches.
      </p>
      <p>
      Von Freitag, 01.09, bis Sonntag, 03.09., haben Tennisbegeisterte wieder die Möglichkeit, Spitzenspiele live im Landkreis zu erleben. Denn an diesem Wochenende findet die 
      Jubiläumsausgabe der Olching Open statt. Das vom Tennisclub Olching nun bereits zum 30. Mal ausgerichtete Traditionsturnier mit DTB-Ranglistenwertung ist eines der größten 
      seiner Art in Bayern. Regelmäßig kämpfen Spitzenspieler aus der deutschen Rangliste und Bundesliga in Olching mit um den Bayer-Automobile-Cup. Gespielt wird in den 
      Einzel-Disziplinen Herren, Damen und Herren 30. Es winken Pokale, Preisgelder und Sachpreise. Die Schirmherrschaft übernimmt wie immer der 1. Bürgermeister der Stadt Olching, 
      Andreas Magg.
      </p>

      <p>Mit bis zu 160 Aktiven zählen die Olching Open zu den Turnieren mit den höchsten Teilnehmerzahlen in ganz Bayern. Um die enorme Anzahl der Matches an drei 
      Tagen bewältigen zu können, wird das Turnier auf insgesamt 22 Sandplätzen 
      des TC Olching und der benachbarten Vereine TSV Geiselbullach, TC Gernlinden, TC Puchheim und TC Eichenau ausgetragen. Für die Spieler steht 
      entsprechend wieder ein Shuttle-Service bereit.</p>
      <p>
      <strong>Komplette interaktive Ausschreibung zum Download</strong>: <a href="/downloads/OlchingOpen-Ausschreibung23_interaktiv.pdf">Ausschreibung</a>.
      </p>
      <p>
      Der TC Olching, die Turnierleitung und natürlich besonders auch die Spieler freuen sich über zahlreiche Zuschauer. <strong>Der Eintritt ist, wie immer, an allen  drei Tagen und auf 
      allen Anlagen frei.</strong> Für das leibliche Wohl ist gesorgt. Marco Tesche von der Turnierleitung: „Wir laden alle Tennisfans und -freunde herzlich ein, 
      die Jubiläums-Olching-Open zu besuchen. Verpassen Sie nicht die Gelegenheit, absolut hochklassiges Tennis hautnah im Landkreis zu erleben.“
      </p>
      <p><strong>Meldeschluss ist Dienstag, den 29.08.2023, 15:00 Uhr</strong>. Anmeldung über <a href="https://mybigpoint.tennis.de/">MyBigPoint</a>.</p>
      <p><strong>Übernachtungsmöglichkeiten</strong> in Olching findest du <a href="verein.php#uebernachtung">hier</a>.</p>

      <p>Ermöglicht wird dies durch das Engagement einer Vielzahl an freiwilligen
        Helfern und natürlich durch die Unterstützung unserer Sponsoren!
      </p>
    </article>
    <article class="spalte1">
      <img src="images/OlchingOpen/plakat_2023.png" alt="Olching Open" class="breitebilder" />
    </article>
    <article>
      <h4>Hauptsponsor</h4>
      
      <a href="https://skoda-auto.de/" target="_blank"><img alt="Skoda" src="images/sponsoren/skoda.jpg" class="img-thumbnail"></a>
      <a href="https://bayer-automobile.skoda-auto.de/" target="_blank"><img alt="Bayer Skoda" src="images/sponsoren/bayer_automobile.png" class="img-thumbnail"></a>
      <h4>Weitere Sponsoren</h4>
      <a href="https://tennispark-gernlinden.de/" target="_blank"><img alt="Tennispark Gernlinden" src="images/sponsoren/tennispark_gernlinden.png" class="img-thumbnail"></a>
      <a href="https://www.jgwerbung.de/" target="_blank"><img alt="JG" src="images/sponsoren/jg_werbegesellschaft.png" class="img-thumbnail"></a>
      <a href="https://www.sparkasse-ffb.de/" target="_blank"><img alt="Sparkasse FFB" src="images/sponsoren/sparkasse_ffb.png" class="img-thumbnail"></a>
      <a href="https://bayer-automobile.skoda-auto.de/ target="_blank""><img alt="Topspin" src="images/sponsoren/topspin.png" class="img-thumbnail"></a>
    </article>
    <br>
    <article>
      <p id="ooschirmherr"><strong>Schirmherrschaft:<br>
          Andreas Magg</Strong><br>
        1. Bürgermeister v. Olching
      </p>
    </article>
  </section>
</div>

*/
?>

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


<div id="blatt4" class="blatt">
  <section id="presse" class="seite">
    <article>
      <h3>Vier Teams steigen auf!</h3>
      <img src="images/Presse_2023-07-30.jpg" class="w-100" alt="Artikel" />
      <br>
      <img src="images/Presse_2023-08-02.png" class="w-100" alt="Artikel" />
    </article>
    <article>
      <h3>Kid's Day 2023 am 8. Mai 2023</h3>
      <img src="images/Kids/Presse 2023-06-06 um 11.38.04.jpg" class="w-100" alt="Artikel" />
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
<!-- 
<div id="blatt5" class="blatt">
  <section id="kreism" class="seite">
    <article>
      <img src="images/kreism/ausschreibung.png" alt="Kreismeisterschaften 2022" class="breitebilder" />
    </article>
    <article>
      <a href="/downloads/Ausschreibung Kreismeisterschaften2022_v220601-1220.pdf">Download der gesamten Ausschreibung</a>
    </article>
  </section>
</div>

 -->
<?php
include 'footer.php';
?>