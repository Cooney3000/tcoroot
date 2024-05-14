<?php
require_once("intern/inc/config.inc.php");
# In der Navigation den aktuellen Menüpunkt auf bold setzen
$_verein = "navcurrent";
$_aktuell = "";
$_mannschaften = "";
$_jugend = "";
$_training = "";
$_header = "Verein - Aufnahme 2";
include 'header.php';

?>

<div id="blatt1">
    <section id="anmeldeantragabgesendet" class="seite">




        <?php

        // Überprüfen, ob das Formular abgesendet wurde
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Daten aus dem Formular sammeln
            $vorname               = trim($_POST["vorname"]);
            $nachname              = trim($_POST["nachname"]);
            $erziehungsberechtigter = trim($_POST["erziehungsberechtigter"]) ?? '';
            $strasse               = trim($_POST["strasse"]);
            $plz                   = trim($_POST["plz"]);
            $ort                   = trim($_POST["ort"]);
            $geburtsdatum          = trim($_POST["geburtsdatum"]);
            $tel                   = trim($_POST["tel"]);
            $email                 = trim($_POST["email"]);
            $geschlecht            = trim($_POST["geschlecht"]);
            $nationalitaet         = trim($_POST["nationalitaet"]) ?? '';
            $spiellevel            = trim($_POST["spiellevel"]) ?? '';
            $mitgliedschaft        = trim($_POST["mitgliedschaft"]);
            $kontoinhaber          = trim($_POST["kontoinhaber"]);
            $konto_iban            = trim($_POST["konto_iban"]);
            $bemerkungen           = trim($_POST["bemerkungen"]) ?? '';

            // Validierung der Daten
            if (
                empty($vorname)
                || empty($nachname)
                || empty($strasse)
                || empty($plz)
                || empty($ort)
                || empty($geburtsdatum)
                || empty($tel)
                || empty($email)
                || empty($geschlecht)
                || empty($spiellevel)
                || empty($mitgliedschaft)
                || empty($kontoinhaber)
                || empty($konto_iban)
            ) {
                // Validierung und Fehlerbehandlung, z.B. den Nutzer benachrichtigen
                die("Bitte füllen Sie alle mit * gekennzeichneten Felder aus.");
            }

            // Speicherung in Datenbank, E-Mail Versand, etc.

            $email_verification_token = md5(random_bytes(20));

            try {

                $sql = <<<EOT
INSERT INTO reg_applicants (
    vorname, 
    nachname, 
    erziehungsberechtigter, 
    strasse, 
    plz, 
    ort, 
    geburtsdatum, 
    tel, 
    email, 
    geschlecht, 
    nationalitaet, 
    spiellevel,
    mitgliedschaft, 
    kontoinhaber, 
    konto_iban, 
    bemerkungen,
    email_verification_token
) VALUES (
    :vorname, 
    :nachname, 
    :erziehungsberechtigter, 
    :strasse, 
    :plz, 
    :ort, 
    :geburtsdatum, 
    :tel, 
    :email, 
    :geschlecht, 
    :nationalitaet, 
    :spiellevel,
    :mitgliedschaft, 
    :kontoinhaber, 
    :konto_iban, 
    :bemerkungen, 
    :email_verification_token
)
EOT;
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':vorname', $vorname);
                $stmt->bindParam(':nachname', $nachname);
                $stmt->bindParam(':erziehungsberechtigter', $erziehungsberechtigter);
                $stmt->bindParam(':strasse', $strasse);
                $stmt->bindParam(':plz', $plz);
                $stmt->bindParam(':ort', $ort);
                $stmt->bindParam(':geburtsdatum', $geburtsdatum);
                $stmt->bindParam(':tel', $tel);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':geschlecht', $geschlecht);
                $stmt->bindParam(':nationalitaet', $nationalitaet);
                $stmt->bindParam(':spiellevel', $spiellevel);
                $stmt->bindParam(':mitgliedschaft', $mitgliedschaft);
                $stmt->bindParam(':kontoinhaber', $kontoinhaber);
                $stmt->bindParam(':konto_iban', $konto_iban);
                $stmt->bindParam(':bemerkungen', $bemerkungen);
                $stmt->bindParam(':email_verification_token', $email_verification_token);

                $stmt->execute();
            } catch (PDOException $e) {
                die("Datenbankfehler: " . $e->getMessage());
            } catch (Exception $e) {
                die("Allgemeiner Fehler: " . $e->getMessage());
            }




            // Mail versenden
            $empfaenger = "$email";
            $betreff = "Deinen Aufnahmeantrag beim TC Olching abschließen";
            $from = "From: " . $CONFIG['webmasterMailAddress'] . "\r\n";
            $from .= "Bcc: " . $CONFIG['webmasterMailAddress'] . "\r\n";
            $from .= "Reply-To: " . $CONFIG['webmasterMailAddress'] . "\r\n";
            $from .= "Content-Type: text/html; charset=utf-8\r\n";

            $text = <<<EOT
<p>Hallo $vorname $nachname,</p>

<p>
vielen Dank für Dein Interesse am TC Olching für eine Mitgliedschaft als: $mitgliedschaft. 
<strong>Bestätige den Antrag jetzt, indem du diesen Link anklickst: <a href="https://www.tcolching.de/verein-aufnahme_3.php?t=$email_verification_token">Aufnahmeantrag bestätigen</a><strong><br>
</p>

<p>Vielen Dank und beste Grüße</p>
<p>Der Vorstand des TC Olching e.V.</p>
EOT;
            error_log("EMPFÄNGER: $empfaenger, SUBJECT: $betreff, TEXT: $text, FROM: $from");
            if (DEBUG) {
                echo ("<pre>mail($empfaenger, $betreff, $text, $from)</pre>");
            } else {
                if (mail($empfaenger, $betreff, $text, $from)) {
                    echo '<br><div class="h5 my-2">Vielen Dank! <br><strong>Bitte überprüfe Deine Mails und bestätige den Aufnahmeantrag.</strong></div><br>';
                } else {
                    die('<div class="h5 text-danger my-2">Beim Versenden der Bestätigungsmail ist leider ein Fehler aufgetreten. Bitte benachrichtige ' . $CONFIG['webmasterMailAddress'] . '<br></div>');
                }
            }
        }

        ?>
    </section>
</div>
<?php
include 'footer.php';
?>