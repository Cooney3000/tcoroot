<?php
session_start();
require_once("../../inc/config.inc.php");
require_once("../../inc/functions.inc.php");
require_once("../../inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Intern Historie Turnier 2019";
include("../../templates/header.inc.php");
?>
<script>
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-halloffame").classList.add("active");
    document.getElementById("nav-tafel").classList.remove("active");
    document.getElementById("nav-login").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
    </script>
<div class="container main-container">
  <article class="m-3">
    
    <h1>Das Turnier 2020</h1>
    <h2>Spielklassen:</h2>
    <p>
      <a class="btn btn-success m-1" href="#damenergebnisse">Damen</a>
      <a class="btn btn-success m-1" href="#herrenergebnisse">Herren</a>
      <a class="btn btn-success m-1" href="#bildergalerie">Bildergalerie</a>
      <a class="btn btn-success m-1" href="#allebegegnungen">Alle Begegnungen  </a>
    </p>
    <h2>Organisatoren: </h2>
    <p>Norbert Maier, Conny Roloff</p>

  <!-- <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2021/images/amperkurier.jpg" alt="Amper Kurier" /></div> -->
    <h2 class="mt-3">Ergebnisse:</h2>
    <article id="damenergebnisse">
    <p class="h5">Damen</p>
    <ol>
      <h2 class="my-1"><li>Petra Streif</li></h2>
      <h2 class="my-1"><li>Lisa Fuchs</li></h2>
    </ol>
    <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_damen.png"><img id="mannschaftsspieler" src="images/spielplan_damen.png" class="w-100" alt="Damen"></a>
    </div>
    
    <article id="damenergebnisseb">
    <p class="h5">Damen B</p>
    <ol>
      <h2 class="my-1"><li>Nicola Schmid</li></h2>
      <h2 class="my-1"><li>Helga Weidenböck</li></h2>
    </ol>
    <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_damenb.png"><img src="images/spielplan_damenb.png" class="w-50" alt="Damen B"></a>
    </div>
    
  </article>
    <br>
    <br>
  <article id="herrenergebnisse">
    <p class="h5">Herren</p>
    <ol>
      <h2 class="my-1"><li>Toni Weber</li></h2>
      <h2 class="my-1"><li>Ulf Henke</li></h2>
    </ol>
   <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_herren.png"><img id="mannschaftsspieler" src="images/spielplan_herren.png" class="w-100" alt="Herren"></a>
    </div>
    
    <br>
  </article>
  <article id="herrenergebnisseB">
    <p class="h5">Herren B</p>
    <ol>
      <h2 class="my-1"><li></li></h2>
      <h2 class="my-1"><li></li></h2>
    </ol>
   <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_herrenb.png"><img src="images/spielplan_herrenb.png" class="w-50" alt="Herren B"></a>
    </div>
    
    <br>

</article>
<article id="bildergalerie" class="m-3">
  <p class="h3">Galerie</p>

  <div>
<?php
  $path = "./images/galerie/";
  $files = scandir($path);
  foreach ($files as $file) {
    $img =  $path . $file;
    if ( is_file($img)) {
?>
    <img class="w-100 m-4" src="<?= $img ?>">
<?php
    }
  }
?>
  </div>
</article>
<article id="allebegegnungen" class="m-3">
  <p class="h3">Alle Begegnungen</p>
    <table class="table table-bordered table-light tbl-small">
    <thead>
        <tr>
          <th>Start</th>
          <th>Spieler 1</th>
          <th>Spieler 2</th>
          <th>Kommentar</th>
        </tr>
      </thead>
        <tbody>
<tr style="height:1.3rem"><td class="text-nowrap">06.06.2020 10:00</td><td>Huber Anja</td><td>Wanner Beate</td><td>6:0 6:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">06.06.2020 12:00</td><td>Maier Ronja</td><td>Schmidt Karin</td><td>1:6 / 0:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">07.06.2020 13:00</td><td>Hochholzer Nico</td><td>Henke Sebastian</td><td>Wegen Regen abgebrochen </td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">08.06.2020 16:00</td><td>Fuchs Lisa</td><td>Schmid Nicola</td><td>6:3 6:4</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.06.2020 13:00</td><td>Tristl Andrea</td><td>Schmidt Karin</td><td>2:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.06.2020 14:00</td><td>Schmidt Hermine</td><td>Streif Luna</td><td>0:6 2:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.06.2020 16:00</td><td>Streif Petra</td><td>Weidenbeck Helga</td><td>6:1 6:4</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.06.2020 10:00</td><td>Tiftik Kai</td><td>Dorfner Günter</td><td>Verletzungsbedingte Aufgabe durch Günter. An dieser Stelle gute Besserung! </td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.06.2020 10:00</td><td>Huber Anja</td><td>Dutka Conny</td><td>6:0 6:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.06.2020 15:00</td><td>Hochholzer Nico</td><td>Henke Sebastian</td><td>6:0 6:2</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.06.2020 15:00</td><td>Eder Thomas</td><td>Krause Sven</td><td>0:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.06.2020 17:00</td><td>Wanner Felix</td><td>Leihenseder Hartmut</td><td>1:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.06.2020 11:00</td><td>Streif Rico</td><td>Schmid Wolfgang</td><td>6:4 6:2</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.06.2020 15:00</td><td>Hämmerl Sebastian</td><td>Ulrich Wolfgang</td><td>2:6 4:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.06.2020 18:00</td><td>Wanner Dirk</td><td>Dutka Gerhard</td><td>4:6 3:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">13.06.2020 11:30</td><td>Hertle Andreas</td><td>Mischke Sascha</td><td>7:6 0:6 7:10</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">13.06.2020 15:00</td><td>Vogg Elena</td><td>Roloff Hanna</td><td>6:1 7:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">16.06.2020 15:00</td><td>Schmidt David</td><td>Riede Ronald</td><td>1:6 3:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">16.06.2020 18:00</td><td>Roloff Alina</td><td>Rohde-Kammers Petra</td><td>3:6 2:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">18.06.2020 17:00</td><td>Tesche Heiko</td><td>Vollrath Benjamin</td><td>6:0 6:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">18.06.2020 19:00</td><td>Maier Norbert</td><td>Summer Kevin</td><td>2:6 6:7</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">19.06.2020 17:00</td><td>Dutka Gerhard</td><td>Küstner Tim</td><td>1:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">21.06.2020 14:00</td><td>Traub Leo</td><td>Tristl Luca</td><td>6:4 7:5</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">21.06.2020 16:00</td><td>Leihenseder Hartmut</td><td>Sagasser Thomas</td><td>1:6 2:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">22.06.2020 12:00</td><td>Streif Robert</td><td>Riede Ronald</td><td>6:0 6:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">22.06.2020 16:00</td><td>Fuchs Lisa</td><td>Schmidt Karin</td><td>6:2 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">23.06.2020 16:00</td><td>Tristl Markus</td><td>Hermann Jochen</td><td>6:4 6:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">23.06.2020 17:00</td><td>Vitzagia Johannes</td><td>Godenrath Jürgen</td><td>6:3 6:3</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">23.06.2020 18:30</td><td>Rieber Nikolaus</td><td>Weber Toni</td><td>2:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">24.06.2020 08:00</td><td>Küstner Tim</td><td>Dutka Gerhard</td><td>6:1 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">24.06.2020 16:00</td><td>Streif Luna</td><td>Traub Moni</td><td>4:6 6:2 10:12</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">24.06.2020 17:30</td><td>Kipnis Olga</td><td>Egenberger Sophia</td><td>6:3 6:2</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">25.06.2020 18:30</td><td>Traub Leo</td><td>Soueiha Markus</td><td>1:6 2:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">25.06.2020 19:00</td><td>Henke Ulf</td><td>Mischke Sascha</td><td>6:1 6:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">26.06.2020 15:30</td><td>Vogg Elena</td><td>Haberzettl Elena</td><td>6:0 7:5</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">26.06.2020 16:30</td><td>Mülleneisen Marcus</td><td>Tristl Markus</td><td>0:6 3:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">26.06.2020 18:00</td><td>Krause Sven</td><td>Sachse Michi</td><td>6:2 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">26.06.2020 18:30</td><td>Krätzschmar Florian</td><td>Ulrich Wolfgang</td><td>6 2 6 1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">01.07.2020 16:00</td><td>Vogg Elena</td><td>Streif Petra</td><td>3:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">02.07.2020 16:00</td><td>Tesche Heiko</td><td>Gruev Nayden</td><td>6:4 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">02.07.2020 19:00</td><td>Hochholzer Nico</td><td>Schek Thomas</td><td></td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">08.07.2020 18:00</td><td>Röhlk Andreas</td><td>Tiftik Kai</td><td>1:0 f</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">08.07.2020 19:00</td><td>Küstner Tim</td><td>Henke Ulf</td><td>0:6 0:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">09.07.2020 08:00</td><td>Streif Robert</td><td>Tristl Markus</td><td>w.o. Verletzung Tristl</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">09.07.2020 18:00</td><td>Schreyer Christian</td><td>Vitzagia Johannes</td><td>6:1 / 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">09.07.2020 19:30</td><td>Schek Thomas</td><td>Hochholzer Nico</td><td>Ergebnis 6:4 6:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.07.2020 11:30</td><td>Rohde-Kammers Petra</td><td>Göttling Britta</td><td>1:6 0:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.07.2020 16:00</td><td>Streif Rico</td><td>Summer Kevin</td><td>3:6 2:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.07.2020 10:00</td><td>Huber Anja</td><td>Kipnis Olga</td><td>3:6 4:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">20.07.2020 09:30</td><td>Schmidt David</td><td>Mülleneisen Marcus</td><td>0:6 3:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">21.07.2020 18:00</td><td>Röhlk Andreas</td><td>Weber Toni</td><td>Weber/Röhlk 6:0 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">22.07.2020 16:30</td><td>Tristl Andrea</td><td>Schmid Nicola</td><td>2:6 2:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">22.07.2020 16:45</td><td>Traub Moni</td><td>Göttling Britta</td><td>4:6 6:3 8:10</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">23.07.2020 18:15</td><td>Tesche Heiko</td><td>Soueiha Markus</td><td>3:6 3:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">25.07.2020 11:00</td><td>Roloff Alina</td><td>Weidenbeck Helga</td><td>6:2 2:6 8:10</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">30.07.2020 18:00</td><td>Wanner Dirk</td><td>Tristl Luca</td><td>1:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">31.07.2020 16:00</td><td>Schreyer Christian</td><td>Krätzschmar Florian</td><td>chris : flo  5:7 0:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">31.07.2020 16:00</td><td>Göttling Britta</td><td>Streif Petra</td><td>6:7 5:7</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">05.08.2020 15:00</td><td>Krause Sven</td><td>Sagasser Thomas</td><td>4:6 4:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">05.08.2020 18:30</td><td>Tiftik Kai</td><td>Gruev Nayden</td><td>B-Runde  7:6 4:6 10:6 </td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">06.08.2020 17:30</td><td>Streif Robert</td><td>Krätzschmar Florian</td><td>6:3 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">07.08.2020 12:00</td><td>Wanner Felix</td><td>Hämmerl Sebastian</td><td>1:6 2:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">08.08.2020 10:30</td><td>Mülleneisen Marcus</td><td>Tristl Luca</td><td>6:4 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">09.08.2020 10:00</td><td>Fuchs Lisa</td><td>Kipnis Olga</td><td>6: 4 4: 6 10:4</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.08.2020 10:00</td><td>Wanner Beate</td><td>Weidenbeck Helga</td><td>1:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.08.2020 18:30</td><td>Schlomann Jannik</td><td>Schek Thomas</td><td>2:6 0:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">13.08.2020 10:00</td><td>Tristl Luca</td><td>Schreyer Tobias</td><td>6:1 6:4</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">23.08.2020 17:00</td><td>Haberzettl Elena</td><td>Schmid Nicola</td><td>1:6 3:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">04.09.2020 16:00</td><td>Vollrath Benjamin</td><td>Dutka Conny</td><td>Midcourt: J Tiftik - S Dutka 4:0 5:3 // N Vollrath - S Dutka 1:4 2:4</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">04.09.2020 16:00</td><td>Tiftik Kai</td><td>Furitsch Stefanie</td><td>Midcourt: N Vollrath - C Dutka (5:4 - Abbruch wird nachgeholt) // J Tiftik - J Furitsch 1:4 5:3 6:10</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">05.09.2020 10:00</td><td>Henke Sebastian</td><td>Lippl Lukas</td><td>Jugendtmeisterschaften 6:0 6:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">05.09.2020 15:30</td><td>Vollrath Benjamin</td><td>Arnholz-Tiftik Christina</td><td>Midcourt: Nicolas Vollrath - Jale Tiftik 2:4 / 2:4</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">05.09.2020 17:30</td><td>Henke Sebastian</td><td>Tiftik Kai</td><td>B-Runde 6:0 6:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">06.09.2020 11:30</td><td>Eder Thomas</td><td>Maier Norbert</td><td>0:6 0:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">07.09.2020 10:00</td><td>Henke Sebastian</td><td>Schreyer Tobias</td><td>Jugendmeisterschaften 6:0 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">07.09.2020 13:30</td><td>Henke Sebastian</td><td>Tristl Luca</td><td>Jugendmeisterschaften 6:0 6:4</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">09.09.2020 16:00</td><td>Traub Leo</td><td>Lippl Lukas</td><td>6:1 6:3 für Leo</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09.2020 17:00</td><td>Traub Leo</td><td>Henke Sebastian</td><td>2:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.09.2020 16:00</td><td>Fuchs Lisa</td><td>Streif Petra</td><td>5:7 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">13.09.2020 16:30</td><td>Schmid Nicola</td><td>Weidenbeck Helga</td><td>6:4 1:6 10:2</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">14.09.2020 14:00</td><td>Traub Leo</td><td>Schreyer Tobias</td><td>Leo 6:3 6:1</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">18.09.2020 15:00</td><td>Vollrath Benjamin</td><td>Arnholz-Tiftik Christina</td><td>Es spielen Midcourt Jale:Christoph 4:2 4:0</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">18.09.2020 15:00</td><td>Dutka Conny</td><td>Furitsch Stefanie</td><td>Es spielen Midcourt Sarah - Jan 0:4 1:4 Christoph-Jan 0:4 0:4</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">18.09.2020 16:30</td><td>Sagasser Thomas</td><td>Schek Thomas</td><td>1:6 1:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">20.09.2020 13:00</td><td>Hämmerl Sebastian</td><td>Maier Norbert</td><td>1:6  0:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">22.09.2020 17:00</td><td>Henke Sebastian</td><td>Mülleneisen Marcus</td><td>"0:6 2:6"</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">24.09.2020 17:00</td><td>Tristl Luca</td><td>Traub Leo</td><td>6:4 6:4</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">27.09.2020 14:00</td><td>Henke Ulf</td><td>Weber Toni</td><td>3:6 2:6</td></tr>
<tr style="height:1.3rem"><td class="text-nowrap">04.10.2020 14:00</td><td>Mülleneisen Marcus</td><td>Maier Norbert</td><td>6:7 3:6</td></tr></tbody>
</table>

  </article>
</div>
<?php 
include("../../templates/footer.inc.php")
?>

