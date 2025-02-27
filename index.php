<?php
session_start();
include 'lib/functions.php';

// Funktionen für rechteabhängige Funktionen START
require_once("intern/inc/config.inc.php");
require_once("intern/inc/functions.inc.php");
require_once("intern/inc/permissioncheck.inc.php");
// Funktionen für rechteabhängige Funktionen ENDE

$navigation = setNavigation('aktuell');
$_header = "- Herzlich Willkommen beim TC Olching";
include 'header.php';

/* Nachrichtenticker */
[$nachricht, $smsMsgClass] = fetchMessage("work/indexmessages.txt");

/* Gaststättenstatus */
[$wirtStatusText, $wirtStatusClass, $wirtAktivStatus] = getRestaurantStatus("work/wirt.txt");
// Überprüfen Sie, ob eine Nachricht in der Session gesetzt ist
$swalMessage = '';
$swalMessageType = 'success'; // Standardmäßig 'success', falls nicht anders gesetzt

if (isset($_SESSION['message'])) {
  $swalMessage = $_SESSION['message'];
  if (isset($_SESSION['message_type'])) {
    $swalMessageType = $_SESSION['message_type'];
  }

  // Löschen Sie die Nachricht aus der Session
  unset($_SESSION['message']);
  unset($_SESSION['message_type']);
}

?>

<div id="blatt1" class="blatt">
  <section class="seite mb-1 px-2 py-1 text-light bg-red-600 border border-danger-subtle rounded-3 <?= $smsMsgClass ?>">
    <div><strong>Aktuelle Meldung:</strong></div>
    <p><?= htmlspecialchars($nachricht) ?></p>
  </section>
  <?php if ($wirtAktivStatus == '1') : ?>
    <section id="gaststaette" class="seite mb-1 px-2 py-1 text-success-emphasis bg-success-subtle border border-success-subtle rounded-3">
      <div><strong>Clubheim</strong>
        <p>Die Vereinsgaststätte ist im Augenblick <span class="<?= $wirtStatusClass ?> px-1"><?= $wirtStatusText ?></span>.</p>
      </div>
    </section>
  <?php endif; ?>
<?php /*
  <section class="seite mb-1 px-2 py-1 text-success-emphasis bg-success-subtle border border-success-subtle rounded-3">
    <div><strong>Aktuelle Info zum DropIn</strong>
      <p>Das Montags-DropIn findet diese Saison nicht mehr statt. Das DropIn am Mittwochvormittag um 10:00 Uhr findet weiter statt, solange das Wetter mitspielt.</p>
    </div>
  </section>
*/ ?>

  <section id="news" class="seite neues">
    <h2>Herzlich willkommen beim TC Olching!</h2>
    <article>
      <p>Hier findest du die wichtigsten öffentlichen Informationen rund um den TC Olching über die laufende Saison, Angebote, Termine und
        aktuelle Ereignisse und Ansprechpartner. Mitglieder finden in unserem internen Bereich viele weitere Informationen.</p>
      <h3>Wir freuen uns über jedes neue Mitglied!</h3>
      <a href="verein.php">Besondere Angebote</a> wie Schnuppermitgliedschaft und Comeback-Training
      <h3>Geselligkeit wird großgeschrieben</h3>
      <div class="text-mit-bild">
        <div class="text">
          <p>Der TC Olching bietet ein gesellschaftliches Umfeld mit einer guten Bewirtung im Vereinsheim. Zu
            verschiedensten Ereignissen wie Mannschaftswettkämpfen oder Turnierspielen treffen sich häufig weitere Mitglieder als Zuschauer.</p>
          <p>Nicht selten werden die Abende nach dem Training länger als man sich vorgenommen hat.</p>
          <p>Zum Saisonabschluss findet jedes Jahr die mittlerweile legendäre Party <strong>"Players & Friends Night"</strong> statt,
            bei der Jung und Alt bis in den Morgen feiern und tanzen.</p>
        </div>
      </div>

      <section id="scroll-impressionen" class="impressionen-container">
        <button class="arrow left-arrow" id="left-arrow">&#9664;</button> <!-- Pfeil nach links -->
        <div class="impressionen-track">
          <!-- Die Bilder werden hier dynamisch per JavaScript hinzugefügt <?= time(); ?>-->
        </div>
        <button class="arrow right-arrow" id="right-arrow">&#9654;</button> <!-- Pfeil nach rechts -->
      </section>
      <h3>Aktuelle News aus der Presse!</h3>
      <p><a href="#presse">Zu den Presseartikeln</a></p>

      <h3>Der TC Olching beim Bayerischen Tennisverband:</h3>
      <table>
        <tr>
          <td>Mannschaften:</td>
          <td><a href="mannschaften.php">Link</a></td>
        </tr>
      </table>
    </article>
    <article class="sponsoren">
      <h3>Unsere Jugend-Sponsoren</h3>
      <div class="sponsoren-grid">
        <a href="http://www.keller-rolladen.de/" target="_blank"><img src="images/sponsoren/Logo-KR.gif" alt="Keller Rolladen" /></a>
        <a href="http://www.hapag-lloyd-reisebuero.de/index.asp?Agnt=48594" target="_blank"><img src="images/sponsoren/hlr_herz_header.png" alt="Hapag-Lloyd Reiseb&uuml;ro" /></a>
        <a href="http://www.friseurkosmetik-fuchs.de/" target="_blank"><img src="images/sponsoren/fuchs.jpg" alt="Friseur- und Kosmetik G&uuml;nter Fuchs" /></a>
        <a href="http://www.maler-stephan.de/" target="_blank"><img src="images/sponsoren/maler-stephan.gif" alt="Maler Stephan" /></a>
      </div>
    </article>
  </section>
  <div id="blatt5" class="blatt">
    <section id="olchingopen" class="seite">
      <article class="clean">
        <h2>Der TC Olching ist Veranstalter eines ranghohen DTB-Turniers - der Olching Open!</h2>
        <p>
          Jedes Jahr richtet der TC Olching e.V. die Olching Open aus. Wir haben wie immer ein hochklassiges Teilnehmerfeld mit DTB-Ranglistenspieler:innen und spannenden Matches.
        </p>
        <p>Zuletzt fanden die <a href="/events/olching_open_2024/">Olching Open 2024</a> vom 30.08.-01.09.2024 zum 31. Mal statt.</p>

        <p>
          Der TC Olching, die Turnierleitung und natürlich besonders auch die Spieler freuen sich über zahlreiche Zuschauer. <strong>Der Eintritt ist immer an allen drei Tagen und auf
            allen Anlagen frei.</strong> Für das leibliche Wohl ist gesorgt. Marco Tesche von der Turnierleitung: „Wir laden alle Tennisfans und -freunde herzlich ein,
          die Olching Open zu besuchen. Verpassen Sie nicht die Gelegenheit, absolut hochklassiges Tennis hautnah im Landkreis zu erleben.“
        </p>
        <p>Ermöglicht wird dies durch das Engagement einer Vielzahl an freiwilligen
          Helfern und natürlich durch die Unterstützung unserer Sponsoren!
        </p>
      </article>
      <article class="spalte1">
        <img src="images/OlchingOpen/plakat_2024.png" alt="Plakat Olching Open 2024" class="breitebilder" />
      </article>
      <article>
        <h4>Hauptsponsor</h4>

        <a href="https://skoda-auto.de/" target="_blank"><img alt="Skoda" src="images/sponsoren/skoda.jpg" class="img-thumbnail"></a>
        <a href="https://bayer-automobile.skoda-auto.de/" target="_blank"><img alt="Bayer Skoda" src="images/sponsoren/bayer_automobile.png" class="img-thumbnail"></a>
        <h4>Weitere Sponsoren</h4>
        <a href="https://tennispark-gernlinden.de/" target="_blank"><img alt="Tennispark Gernlinden" src="images/sponsoren/tennispark_gernlinden.png" class="img-thumbnail"></a>
        <a href="https://www.jgwerbung.de/" target="_blank"><img alt="JG" src="images/sponsoren/jg_werbegesellschaft.png" class="img-thumbnail"></a>
        <a href="https://www.sparkasse-ffb.de/" target="_blank"><img alt="Sparkasse FFB" src="images/sponsoren/sparkasse_ffb.png" class="img-thumbnail"></a>
      </article>
      <br>
      <article>
        <p id="ooschirmherr"><strong>Schirmherrschaft:<br>
            Andreas Magg</strong><br>
          1. Bürgermeister v. Olching
        </p>
      </article>
    </section>
  </div>





  <?php /*
<div id="blatt5" class="blatt">
  <section id="olchingopen" class="seite">
    <article class="clean">

      <h2>31. Olching Open 2024 - Spitzentennis live vom 30.08.-01.09.!</h2>
      <p>
        Jedes Jahr richtet der TC Olching e.V. die Olching Open aus. Wir haben wie immer ein hochklassiges Teilnehmerfeld mit DTB-Ranglistenspieler:innen und spannenden Matches.
      </p>
      <p>
        Von Freitag, 30.08., bis Sonntag, 01.09., haben Tennisbegeisterte wieder die Möglichkeit, Spitzenspiele live im Landkreis zu erleben. Denn an diesem Wochenende findet die
        31. Ausgabe der Olching Open statt. Das vom Tennisclub Olching nun bereits zum 31. Mal ausgerichtete Traditionsturnier mit DTB-Ranglistenwertung ist eines der größten
        seiner Art in Bayern. Regelmäßig kämpfen Spitzenspieler aus der deutschen Rangliste und Bundesliga in Olching mit um den Bayer-Automobile-Cup. Gespielt wird in den
        Einzel-Disziplinen Herren, Damen und Herren 30. Es winken Pokale, Preisgelder und Sachpreise. Die Schirmherrschaft übernimmt wie immer der 1. Bürgermeister der Stadt Olching,
        Andreas Magg.
      </p>

      <p>Mit bis zu 160 Aktiven zählen die Olching Open zu den Turnieren mit den höchsten Teilnehmerzahlen in ganz Bayern. Um die enorme Anzahl der Matches an drei
        Tagen bewältigen zu können, wird das Turnier auf insgesamt 22 Sandplätzen
        des TC Olching und der benachbarten Vereine TSV Geiselbullach, TC Gernlinden, TC Puchheim und TC Eichenau ausgetragen. Für die Spieler steht
        entsprechend wieder ein Shuttle-Service bereit.</p>
      <p>
        <strong>Komplette interaktive Ausschreibung zum Download</strong>: <a href="/downloads/OlchingOpen-Ausschreibung24_interaktiv.pdf">Ausschreibung</a>.
      </p>
      <p>
        Der TC Olching, die Turnierleitung und natürlich besonders auch die Spieler freuen sich über zahlreiche Zuschauer. <strong>Der Eintritt ist, wie immer, an allen drei Tagen und auf
          allen Anlagen frei.</strong> Für das leibliche Wohl ist gesorgt. Marco Tesche von der Turnierleitung: „Wir laden alle Tennisfans und -freunde herzlich ein,
        die 31. Olching Open zu besuchen. Verpassen Sie nicht die Gelegenheit, absolut hochklassiges Tennis hautnah im Landkreis zu erleben.“
      </p>
      <p><strong>Meldeschluss ist Dienstag, der 27.08.2024, 15:00 Uhr</strong>. Anmeldung über <a href="https://mybigpoint.tennis.de/" target="_blank">MyBigPoint</a>.</p>
      <p><strong>Übernachtungsmöglichkeiten</strong> in Olching findest du <a href="verein.php#uebernachtung">hier</a>.</p>

      <p>Ermöglicht wird dies durch das Engagement einer Vielzahl an freiwilligen
        Helfern und natürlich durch die Unterstützung unserer Sponsoren!
      </p>
    </article>
    <article class="spalte1">
      <img src="images/OlchingOpen/plakat_2024.png" alt="Olching Open" class="breitebilder" />
    </article>
    <article>
      <h4>Hauptsponsor</h4>

      <a href="https://skoda-auto.de/" target="_blank"><img alt="Skoda" src="images/sponsoren/skoda.jpg" class="img-thumbnail"></a>
      <a href="https://bayer-automobile.skoda-auto.de/" target="_blank"><img alt="Bayer Skoda" src="images/sponsoren/bayer_automobile.png" class="img-thumbnail"></a>
      <h4>Weitere Sponsoren</h4>
      <a href="https://tennispark-gernlinden.de/" target="_blank"><img alt="Tennispark Gernlinden" src="images/sponsoren/tennispark_gernlinden.png" class="img-thumbnail"></a>
      <a href="https://www.jgwerbung.de/" target="_blank"><img alt="JG" src="images/sponsoren/jg_werbegesellschaft.png" class="img-thumbnail"></a>
      <a href="https://www.sparkasse-ffb.de/" target="_blank"><img alt="Sparkasse FFB" src="images/sponsoren/sparkasse_ffb.png" class="img-thumbnail"></a>
    </article>
    <br>
    <article>
      <p id="ooschirmherr"><strong>Schirmherrschaft:<br>
          Andreas Magg</strong><br>
        1. Bürgermeister v. Olching
      </p>
    </article>
  </section>
</div>
*/ ?>


  <div id="blatt4" class="blatt">
    <?php if (isset($_SESSION['permissions']) && checkPermissions(VORSTAND)) : ?>
      <!-- Button to toggle the form visibility -->
      <button id="toggleFormBtn" class="btn btn-info btn-sm"><strong>Neuen Presseartikel hochladen</strong></button>

      <!-- Form initially hidden -->
      <div id="uploadForm" class="card mt-3" style="display: none;">
        <div class="card-body">
          <h2 class="card-title"><strong>Neuen Presseartikel hochladen</strong></h2>
          <form id="uploadFormElement" action="lib/upload.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="file" class="form-label">Wähle eine Datei aus. Der Dateiname
                muss folgendes Format haben <strong class="font-monospace">JJJJMMTT_zeitung_thema.jpg</strong>,
                also z. B. <strong class="font-monospace">20230905_Tagblatt_Olching Open Ankündigung.jpg</strong>
              </label>
              <input type="file" name="file" class="form-control" id="file" required>
            </div>
            <button type="submit" class="btn btn-success">Hochladen</button>
          </form>
        </div>
      </div>
    <?php endif; ?>

    <!-- Anzeige der Presseartikel -->
    <section id="presse" class="seite">
      <?php displayPressArticles('images/presse', 8); ?>
      <a href="presse.php">Alle Artikel anzeigen</a>
    </section>
  </div>

  <script src="js/public.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Laden von SweetAlert -->

  <script>
    // Abfragedialoge
    document.addEventListener('DOMContentLoaded', function() {
      <?php if ($swalMessage): ?>
        Swal.fire({
          icon: '<?= $swalMessageType ?>',
          title: 'Hinweis',
          text: '<?= $swalMessage ?>'
        });
      <?php endif; ?>
    });
  </script>


  <?php
  include 'footer.php';
  ?>