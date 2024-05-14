<?php
require_once("intern/inc/config.inc.php");
# In der Navigation den aktuellen Menüpunkt auf bold setzen
$_verein = "navcurrent";
$_aktuell = "";
$_mannschaften = "";
$_jugend = "";
$_training = "";
$_header = "Verein - Aufnahme 3";
include 'header.php';
?>
<div id="blatt1">
    <section id="antragbestaetigung" class="seite">

        <?php

        // Prüfen, ob die URL gewrappt ist
        $wrappedUrl = $_GET['url'] ?? null;
        if ($wrappedUrl) {
            // URL ist gewrappt, Dekodierung erforderlich
            $actualUrl = urldecode($wrappedUrl);
            // Extrahieren des Token-Parameters aus der dekodierten URL
            $parsedUrl = parse_url($actualUrl);
            parse_str($parsedUrl['query'], $queryParams);
            $token = $queryParams['t'] ?? null;
        } else {
            // Normales Vorgehen
            $token = $_GET['t'] ?? null;
        }
        // E-Mail verifizieren

        if ($token) {
            $stmt = $pdo->prepare("SELECT * FROM reg_applicants WHERE email_verification_token = :token AND verified IS NULL");
            $stmt->execute(['token' => $token]);
            $user = $stmt->fetch();

            if ($user) {
                // E-Mail an die Verwaltung
                $vorname               = $user['vorname'];
                $nachname              = $user['nachname'];
                $erziehungsberechtigter = $user["erziehungsberechtigter"];
                $strasse               = $user["strasse"];
                $plz                   = $user["plz"];
                $ort                   = $user["ort"];
                $geburtsdatum          = $user["geburtsdatum"];
                $tel                   = $user["tel"];
                $email                 = $user["email"];
                $geschlecht            = $user["geschlecht"];
                $nationalitaet         = $user["nationalitaet"];
                $spiellevel            = $user["spiellevel"];
                $mitgliedschaft        = $user["mitgliedschaft"];
                $kontoinhaber          = $user["kontoinhaber"];
                $konto_iban            = $user["konto_iban"];
                $bemerkungen           = $user["bemerkungen"];

                // Token löschen und Datensatz als valide kennzeichnen
                $stmt = $pdo->prepare("UPDATE reg_applicants SET verified = 1, email_verification_token = NULL WHERE id = :id");
                $stmt->execute(['id' => $user['id']]);

                $empfaenger = "anmeldung@tcolching.de";
                $betreff = "Neuer Aufnahmeantrag von $vorname $nachname";
                $additional_headers = "From: " . $CONFIG['webmasterMailAddress'] . "\r\n";
                $additional_headers .= "CC: " . $CONFIG['trainerMailAddress'] . "\r\n";
                $additional_headers .= "Reply-To: " . $CONFIG['webmasterMailAddress'] . "\r\n";
                $additional_headers .= "Content-Type: text/html; charset=utf-8\r\n";


                $text = "
<p>Liebes Anmeldeteam</p>

<p>
Es ist ein Aufnahmeantrag beim TC Olching eingegangen mit folgenden Daten:
</p>

<table>
<tr><td>Vorname:                </td><td>$vorname              </td></tr> 
<tr><td>Nachname:               </td><td>$nachname             </td></tr> 
<tr><td>Erziehungsberechtigter: </td><td>$erziehungsberechtigter</td></tr> 
<tr><td>Strasse:                </td><td>$strasse              </td></tr> 
<tr><td>Plz:                    </td><td>$plz                  </td></tr> 
<tr><td>Ort:                    </td><td>$ort                  </td></tr> 
<tr><td>Geburtsdatum:           </td><td>$geburtsdatum         </td></tr> 
<tr><td>Tel:                    </td><td>$tel                  </td></tr> 
<tr><td>Email:                  </td><td>$email                </td></tr> 
<tr><td>Geschlecht:             </td><td>$geschlecht           </td></tr> 
<tr><td>Nationalitaet:          </td><td>$nationalitaet        </td></tr> 
<tr><td>Spiellevel:             </td><td>$spiellevel           </td></tr> 
<tr><td>Mitgliedschaft:         </td><td>$mitgliedschaft       </td></tr> 
<tr><td>Kontoinhaber:           </td><td>$kontoinhaber         </td></tr> 
<tr><td>Konto IBAN:             </td><td>$konto_iban           </td></tr> 
<tr><td>Bemerkungen:            </td><td>$bemerkungen          </td></tr> 
</table>

Vielen Dank für Eure Bearbeitung.
</p>

<p>Beste Grüße</p>
<p>Der Vorstand des TC Olching e.V.</p>";

                mail($empfaenger, $betreff, $text, $additional_headers);
                // ACHTUNG!
                // Durch Linkmaskierung von E-Mail-Diensten kann die Seite wiederholt aufgerufen werden, ohne, 
                // dass man Einfluss nehmen kann. Daher werden Mails nur verschickt und in jedem Fall eine Erfolgsmeldung ausgegeben

                // Mail an den Antragsteller:

                $empfaenger = "$email";
                $betreff = "Dein TC Olching-Aufnahmeantrag ist angekommen";
                $additional_headers = "From: anmeldung@tcolching.de\r\n";
                $additional_headers .= "Reply-To: anmeldung@tcolching.de\r\n";
                $additional_headers .= "Content-Type: text/html; charset=utf-8\r\n";

                $text = "
<p>Lieber Antragsteller,</p>

<p>
vielen Dank für Dein Interesse an unserem Verein. Wir freuen uns, dass wir Deinen Aufnahmeantrag beim TC Olching mit folgenden Daten entgegennehmen konnten:
</p>

<table>
<tr><td>Vorname:                </td><td>$vorname              </td></tr> 
<tr><td>Nachname:               </td><td>$nachname             </td></tr> 
<tr><td>Erziehungsberechtigter:  </td><td>$erziehungsberechtigter</td></tr> 
<tr><td>Etrasse:                </td><td>$strasse              </td></tr> 
<tr><td>Plz:                    </td><td>$plz                  </td></tr> 
<tr><td>Ort:                    </td><td>$ort                  </td></tr> 
<tr><td>Geburtsdatum:           </td><td>$geburtsdatum         </td></tr> 
<tr><td>Tel:                    </td><td>$tel                  </td></tr> 
<tr><td>Email:                  </td><td>$email                </td></tr> 
<tr><td>Geschlecht:             </td><td>$geschlecht           </td></tr> 
<tr><td>Nationalitaet:          </td><td>$nationalitaet        </td></tr> 
<tr><td>Spiellevel:             </td><td>$spiellevel           </td></tr> 
<tr><td>Mitgliedschaft:         </td><td>$mitgliedschaft       </td></tr> 
<tr><td>Kontoinhaber:           </td><td>$kontoinhaber         </td></tr> 
<tr><td>Konto_iban:             </td><td>$konto_iban           </td></tr> 
<tr><td>Bemerkungen:            </td><td>$bemerkungen          </td></tr> 
</table>

<p>Wir werden uns nach erfolgreichem Lastschrifteinzug für die gewählte Mitgliedschaft baldmöglichst zurückmelden.</p>

<p>Mit besten Grüßen</p>
<p>Der Vorstand des TC Olching e.V.</p>";

                if (DEBUG) error_log("EMPFÄNGER: $empfaenger, SUBJECT: $betreff, TEXT: $text, ADDITIONAL_HEADERS: $additional_headers");

                mail($empfaenger, $betreff, $text, $additional_headers);
            }
        }


        ?>

        <h1> Anmeldeantrag vollständig gestellt</h1>
        <p>Herzlichen Glückwunsch! Du hast Deinen Antrag erfolgreich gestellt. Wir ziehen nun den entsprechenden Betrag von
            Deinem Konto via Lastschrift ein.
            Sobald die Lastschrift erfolgreich durchgeführt werden konnte, erhältst Du eine Begrüßungsmail
            mit der Bestätigung der erfolgreichen Mitgliedschaft und
            ggf. Anmeldedaten für unser Buchungssystem</p>

    </section>
</div>
<?php
include 'footer.php';
?>