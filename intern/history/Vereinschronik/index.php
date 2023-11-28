<?php
session_start();
require_once("../../inc/config.inc.php");
require_once("../../inc/functions.inc.php");
require_once("../../inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "TCO Vereinschronik";
include("../../inc/header.inc.php");
?>

  <h2>TCO Vereinschronik</h2>

  <table class="table table-bordered table-light tbl-small">
    <tr>
      <th>Jahr</th>
      <th>1. Vorsitzende:r</th>
      <th>2. Vorsitzende:r</th>
      <th>3. Vorsitzende:r, Schatzmeister</th>
      <th>Sportwart:in</th>
      <th>Jugendsportwart:in</th>
      <th>Schriftführer:in</th>
      <th>Presse</th>
      <th>Beisitzer:in</th>
      <th>Rechnungsprüfer:in</th>
      <th>Trainer</th>
      <th>Wirt:in</th>
      <th>Mitglieder</th>
      <th>Bemerkung</th>
    </tr>

    <?php

// Diese Daten kann man einfach *direkt* in einer Excel-Tabelle kopieren und hier einfügen:
$data =<<<EOT
1957													Kinderarzt Dr. Wolfgang Bauer findet 20 Interessierte, die einen Platz aus den Dreißigerjahren beim Kinderheim wieder bespielbar machen.
1959	Hans Wammetsberger											20	Gründung des TCO, Gespräche mit der Gemeinde Olching, Start des Baus von drei Plätzen (heute Plätze 4,5,6)
1960												20	"Registrierung beim BLSV am 8.6.1960 unter der Nr. 44711 | Gründungsmitglieder: Konrad + Lilly Bauer, Horst + Anna Brehmer, Hedi Ermer, Anton + Hilde Fritz, Karl + Dora Höng, Hilde + Arthur KlemtRichard + Carola Knoll, Fred Lieglein, Götz + Marielle Peiseler, Josef + Xaver Rackl, Hans und Hanna Wammetsberger"
1961												32	Bau von zwei weiteren Plätzen
1962												43	Wahljahr
1963												50	
1964												48	
1965												65	"Wahljahr | Bau des Clubheims"
1966												63	
1967	Konrad Bauer(?)											73	Hans Wammetsberger verstirbt unerwartet
1968	Konrad Bauer(?)											84	Wahljahr
1969	Konrad Bauer	Karl Höng	Ermer Hedi	Karl Höng		Strippel					Eheleute Nagy	101	
1970												123	
1971												140	Wahljahr
1972													
1973													
1974													Wahljahr
1975													
1976													
1977													Wahljahr
1978													
1979													
1980													Wahljahr
1981													
1982													
1983													Wahljahr
1984													
1985													
1986													Wahljahr
1987													
1988				Hitscherich									
1989	Karl Höng	Hr. Schießl	Dieter Schmidt	Hr. Paul	Peter Klar	Renate Killi	Fr. Fill						Wahljahr
1990	Karl Höng	Hr. Schießl	Dieter Schmidt	Hr. Paul					Adam			361	Peter Schmid Clubmeister
1991	Karl Höng	Hr. Schießl	Dieter Schmidt	Hr. Paul	Thomas Kaspar								
1992	Karl Höng	Hr. Schießl	Dieter Schmidt	Hr. Paul	Thomas Kaspar	Christel Schwarz							Wahljahr
1993	Lorenz-Jürgen Kohlmaier	Hr. Schießl	Wolfgang Stöbe	Thomas Schek	Thomas Kaspar	Ulrike Friedmann							
1994	Lorenz-Jürgen Kohlmaier	Hr. Schießl	Wolfgang Stöbe	Thomas Schek	Thomas Kaspar	Ulrike Friedmann							
1995	Lorenz-Jürgen Kohlmaier	Walter Tesche	Wolfgang Stöbe	Thomas Schek	Thomas Kaspar	Ulrike Friedmann	Heide Fill	Georg Köhler	Peter Geyer, Hitscherich			338	Wahljahr
1996	Lorenz-Jürgen Kohlmaier	Walter Tesche	Herr Stöbe	Klaus Hartmann	Thomas Kaspar	Ulrike Friedmann	Heide Fill	Georg Köhler --> Ralf Küstner	Peter Geyer, Hitscherich		Eheleute Nagy	329	
1997	Lorenz-Jürgen Kohlmaier	Herr Schmid	Herr Stöbe	Klaus Hartmann	Thomas Kaspar	Ulrike Friedmann	Heide Fill	Ralf Küstner	Peter Geyer, Hitscherich		Fam.Tomaso  Folcarelli		
1998	Lorenz-Jürgen Kohlmaier	Herr Schmid	Thomas Sagasser	Thomas Schek	Stefan Nagy	Nicola Freundorfer (später: Schmid)	Thomas Stief	Ralf Küstner	Peter Geyer, Hitscherich				Wahljahr
1999	Lorenz-Jürgen Kohlmaier	Herr Schmid	Thomas Sagasser	Thomas Schek	Stefan Nagy -> Heiko Tesche	Nicola Freundorfer (später: Schmid)	Thomas Stief	Ralf Küstner	Geyer, Hitscherich			299	"Drop-In wird von Familien v. Dittrich und Heydenaber ins Leben gerufen | Clubmeister Peter Schmidt, Babsi Feldmann"
2000	Lorenz-Jürgen Kohlmaier	Thomas Schek	Thomas von Heydenaber	Thomas Schek	Heiko Tesche (kommissarisch)	Nicola Freundorfer (später: Schmid)	Thomas Stief	Ralf Küstner	Geyer, Hitscherich				
2001	Torsten v. Dittrich	Thomas Schek	Thomas von Heydenaber	Werner Keßler	Heiko Tesche	Nicola Freundorfer (später: Schmid)	Thomas Stief	Ralf Küstner	Thomas Sagasser, Jürgen Kohlmaier			287	Wahljahr
2002	Torsten v. Dittrich	Thomas Schek	Thomas von Heydenaber	Werner Keßler	Heiko Tesche	Nicola Freundorfer (später: Schmid)	Thomas Stief	Ralf Küstner	Thomas Sagasser, Jürgen Kohlmaier				
2003	Torsten v. Dittrich	Thomas Schek	Thomas von Heydenaber	Werner Keßler	Heiko Tesche	Nicola  Schmid	Thomas Stief	Ralf Küstner	Thomas Sagasser, Jürgen Kohlmaier		Hermine Schmidt, Gerda Ossiander		
2004	Torsten v. Dittrich	Rainer Schmidt	Thomas von Heydenaber	Werner Keßler	Heiko Tesche	Brigitte Heienbrock	Walter Engelhard	Ralf Küstner	Thomas Sagasser, Jürgen Kohlmaier				Wahljahr
2005	Torsten v. Dittrich	Rainer Schmidt	Thomas von Heydenaber	Werner Keßler	Heiko Tesche	Brigitte Heienbrock	Walter Engelhard	Ralf Küstner	Thomas Sagasser, Jürgen Kohlmaier			256	
2006	Torsten v. Dittrich	Rainer Schmidt	Thomas von Heydenaber	Werner Keßler	Heiko Tesche	Gerda Ossiander		Ursi Hochholzer, Philipp Federau	Thomas Sagasser, Jürgen Kohlmaier				
2007	Torsten v. Dittrich	Rainer Schmidt	Hartmut Barichs	Ralf Küstner	Heiko Tesche	Gerda Ossiander		Ursi Hochholzer, Philipp Federau	Thomas Sagasser, Jürgen Kohlmaier		Roswitha Forthofer		Wahljahr
2008	Torsten v. Dittrich	Rainer Schmidt		Ralf Küstner	Heiko Tesche		- unbesetzt -	Ursi Hochholzer, Philipp Federau	Thomas Sagasser, Jürgen Kohlmaier		Klaus Obermaier	257	
2009	Torsten v. Dittrich	Rainer Schmidt	Matthias May (nur Kasse, nicht 3. Vors)	Ralf Küstner	Heiko Tesche	Gerda Ossiander	- unbesetzt -	Ursi Hochholzer, Philipp Federau	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy, Josef Hasler	Christine Oberstein	239	
2010	Heiko Tesche	Peter Schmidt	Andrea Gallert	Ralf Küstner	Karin Schmidt	Britta Göttling	- unbesetzt -	Ursi Hochholzer, Dieter Geyer, Michael Sachse	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Dagmar (Wurzer) + Memo Kücük	257	Wahljahr
2011	Heiko Tesche	Peter Schmidt	Andrea Gallert	Ralf Küstner	Karin Schmidt	Britta Göttling	- unbesetzt -	Ursi Hochholzer, Dieter Geyer, Michael Sachse	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Dagmar (Wurzer) + Memo Kücük		
2012	Heiko Tesche	Peter Schmidt	Andrea Gallert	Ralf Küstner	Karin Schmidt	Britta Göttling	- unbesetzt -	Ursi Hochholzer, Dieter Geyer, Michael Sachse	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Dagmar Wurzer + Lilo		
2013	Heiko Tesche	Michael Sachse	Andrea Gallert	Petra Maier (später: Eder)	Ralf Küstner	Britta Göttling	Thomas Stief	Petra Streif, Ursi Hochholzer	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Dagmar Wurzer		Wahljahr
2014	Heiko Tesche	Michael Sachse	Andrea Gallert	Petra Maier (später: Eder)	Ralf Küstner	Britta Göttling	Thomas Stief	Petra Streif, Ursi Hochholzer	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Dagmar Wurzer		
2015	Heiko Tesche	Michael Sachse	Andrea Gallert	Petra Maier (später: Eder)	Ralf Küstner	Britta Göttling	Thomas Stief	Petra Streif, Ursi Hochholzer	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Dagmar Wurzer	271	
2016	Heiko Tesche	Michael Sachse	Andrea Gallert	Heiko Tesche	Petra Streif	Britta Göttling	Thomas Stief	Ursi Hochholzer	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Dagmar Wurzer	252	Wahljahr
2017	Heiko Tesche	Michael Sachse	Andrea Gallert	Heiko Tesche	Petra Streif	Britta Göttling	Thomas Stief	Ursi Hochholzer	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Emanuele Stara	260	
2018	Heiko Tesche	Michael Sachse	Andrea Gallert	Heiko Tesche	Petra Streif	Britta Göttling	Thomas Stief	Ursi Hochholzer	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Marco Stara		
2019	Heiko Tesche	Michael Sachse	Andrea Gallert	Conny Roloff	Petra Streif	Britta Göttling	Thomas Stief	Lisa Fuchs	Thomas Sagasser, Jürgen Kohlmaier	Sascha Glinskiy	Marco Stara		Wahljahr
2020	Heiko Tesche	Michael Sachse	Andrea Gallert	Conny Roloff	Petra Streif	Britta Göttling	Thomas Stief	Lisa Fuchs	Thomas Sagasser, Jürgen Kohlmaier	Michael Görzen	Birgit Kruse (Volvere)	246	
2021	Heiko Tesche	Michael Sachse	Andrea Gallert	Conny Roloff	Petra Streif	Britta Göttling	Thomas Stief	Lisa Fuchs	Thomas Sagasser, Jürgen Kohlmaier	Michael Görzen	Marco Stara		Umstellung auf Online-Platzbuchung
2022	Benjamin Vollrath	Michael Sachse	Andrea Gallert	Cornelia Dutka	Moni Traub	Conny Roloff	Thomas Stief	Lisa Fuchs	Thomas Sagasser, Ralf Küstner	Michael Görzen	Mia Görzen		Wahljahr
2023	Conny Roloff	Michael Sachse	Andrea Gallert	Thomas Schek	Heiko Tesche	Daniela Ulrich	Thomas Stief	Lisa Fuchs	Thomas Sagasser, Ralf Küstner	Michael Görzen	Mia Görzen		Rücktritt der Vorsitzenden und Sport-/Jugendsportwart --> Neuwahl in einer außerordentlichen Mitgliederversammlung am 6.11.2023
EOT;
// Explodiere die Daten in Zeilen
$rows = explode("\n", $data);

foreach ($rows as $index => $row) {
  // Explodiere die Zeile in Zellen
  $cells = explode("\t", $row);

  // Bestimme die Hintergrundfarbe basierend auf dem Index
  $rowBgColor = $index % 2 == 0 ? 'white' : 'lightgrey';

  // Starte eine HTML-Zeile mit Hintergrundfarbe für Zeilen
  echo '<tr style="background-color: ' . $rowBgColor . ';">';

  // Füge jede Zelle als HTML-TD-Element hinzu
  foreach ($cells as $colIndex => $cell) {
      // Bestimme die Hintergrundfarbe basierend auf dem Spaltenindex
      $colBgColor = $colIndex % 2 == 0 ? ($index % 2 == 0 ? 'white' : '#F1F1F1') : ($index % 2 == 0 ? '#F6F8F3' : '#EFF1ED');

      // Füge eine TD-Zelle mit Hintergrundfarbe für Spalten hinzu
      echo '<td style="background-color: ' . $colBgColor . ';">' . $cell . '</td>';
  }

  // Schließe die HTML-Zeile
  echo '</tr>';
}







?>
</table>

<?php
include("inc/footer.inc.php")
?>