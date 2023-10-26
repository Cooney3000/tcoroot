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
include("../../inc/header.inc.php");
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
    
    <h1>Das Turnier 2021</h1>
    <h2>Spielklassen:</h2>
    <p>
      <a class="btn btn-success m-1" href="#damenergebnisse">Damen</a>
      <a class="btn btn-success m-1" href="#herrenergebnisse">Herren</a>
      <a class="btn btn-success m-1" href="#bildergalerie">Bildergalerie</a>
      <a class="btn btn-success m-1" href="#allebegegnungen">Alle Begegnungen  </a>
    </p>
    <h2>Organisatoren: </h2>
    <p>Norbert Maier, Conny Roloff</p>

  <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2021/images/amperkurier.jpg" alt="Amper Kurier" /></div>
    <h2 class="mt-3">Ergebnisse:</h2>
  <article id="damenergebnisse">
    <p class="h5">Damen</p>
    <ol>
      <h2 class="my-1"><li>Luna Streif</li></h2>
      <h2 class="my-1"><li>Moni Traub</li></h2>
    </ol>
    <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_damen.png"><img id="mannschaftsspieler" src="images/spielplan_damen.png" class="w-100" alt="Damen"></a>
    </div>
    
  </article>
    <br>
    <br>
    <article id="damenergebnisseb">
    <p class="h5">Damen B</p>
    <ol>
      <h2 class="my-1"><li>Daniela Kasten</li></h2>
      <h2 class="my-1"><li>Sofie Traub</li></h2>
    </ol>
    <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_damenb.png"><img src="images/spielplan_damenb.png" class="w-50" alt="Damen B"></a>
    </div>
    
  </article>
    <br>
  <article id="herrenergebnisse">
    <p class="h5">Herren</p>
    <ol>
      <h2 class="my-1"><li>Ulf Henke</li></h2>
      <h2 class="my-1"><li>Robert Streif</li></h2>
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
      <h2 class="my-1"><li>Luka Juricev</li></h2>
      <h2 class="my-1"><li>Tim Küstner</li></h2>
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

<!--######################################################-->
<tr style="height:1.3rem"><td class="text-nowrap">06.08. 18:00</td><td>Tiftik Kai</td><td>Hämmerl Sebastian</td><td>1:6 4:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">08.08. 18:00</td><td>Tesche Heiko</td><td>Leihenseder Hartmut</td><td>6:26:0</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">15.08. 13:00</td><td>Schmidt David</td><td>Godenrath Jürgen</td><td>6:3 6:1</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">19.08. 15:00</td><td>Tristl Luca</td><td>Heydenaber Thomas von</td><td>7:5 7:5</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">19.08. 18:00</td><td>Hochholzer Nico</td><td>Juricev Luka</td><td>7:5 7:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">20.08. 13:00</td><td>Schmid Wolfgang</td><td>Vitzagia Johannes</td><td>6:4 2:6 9:11</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">02.09. 08:00</td><td>Sachse Michi</td><td>Vollrath Benjamin</td><td>w/o Sachse</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">02.09. 17:00</td><td>Tristl Markus</td><td>Riede Ronald</td><td>6:4 6:3</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">05.09. 14:00</td><td>Kirchhoff Kai</td><td>Küstner Tim</td><td>6:4 6:1</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">07.09. 17:30</td><td>Rieber Nikolaus</td><td>Hermann Jochen</td><td>6:2 6:3</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">08.09. 17:30</td><td>Maier Norbert</td><td>Dorfner Günter</td><td>6:2 6:1</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">09.09. 17:00</td><td>Traub Leo</td><td>Ulrich Wolfgang</td><td>6:7 0:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 13:00</td><td>Tristl Markus</td><td>Schmidt David</td><td>AF Herren A 6:2 4:6 10:2</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 13:30</td><td>Hämmerl Sebastian</td><td>Streif Robert</td><td>AF Herren A 3:6 2:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 15:00</td><td>Tristl Andrea</td><td>Maier Ronja</td><td>AF Damen A 6:0 6:3</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 15:00</td><td>Kasten Daniela</td><td>Vogg Elena</td><td>AF Damen A 0:6 3:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 15:00</td><td>Schmid Melina</td><td>Traub Moni</td><td>AF Damen A 1:6 0:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 15:00</td><td>Tristl Luca</td><td>Soueiha Markus</td><td>AF Herren A 1:6 1:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 16:00</td><td>Vogg Alexandra</td><td>Schmid Nicola</td><td>AF Damen A 6:7 1:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 17:00</td><td>Huber Anja</td><td>Traub Sofie</td><td>AF Damen A 6:2 6:0</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 17:00</td><td>Rieber Nikolaus</td><td>Maier Norbert</td><td>AF Herren A 6:4 6:4</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 17:00</td><td>Henke Ulf</td><td>Vollrath Benjamin</td><td>AF Herren A 6:0 6:0</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 17:00</td><td>Kirchhoff Kai</td><td>Hochholzer Nico</td><td>AF Herren A 5:7 7:5 7:10</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">10.09. 17:00</td><td>Vitzagia Johannes</td><td>Tesche Heiko</td><td>AF Herren A 3:6 2:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 09:00</td><td>Streif Luna</td><td>Schmid Nicola</td><td>VF Damen A 6:3 6:4</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 09:00</td><td>Vogg Elena</td><td>Traub Moni</td><td>VF Damen A 2:6 0:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 09:00</td><td>Schek Thomas</td><td>Ulrich Wolfgang</td><td>AF Herren A 6:0 6:0</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 11:00</td><td>Henke Ulf</td><td>Tesche Heiko</td><td>VF Herren A 6:0 6:0</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 11:00</td><td>Hochholzer Nico</td><td>Streif Robert</td><td>VF Herren A 1:6 0:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 11:00</td><td>Tristl Markus</td><td>Soueiha Markus</td><td>VF Herren A 1:6 0:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 11:00</td><td>Schek Thomas</td><td>Rieber Nikolaus</td><td>VF Herren A 6:2 7:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 13:00</td><td>Godenrath Jürgen</td><td>Küstner Tim</td><td>VF Herren B 2:6 1:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 13:00</td><td>Schmid Wolfgang</td><td>Juricev Luka</td><td>VF Herren B 1:6 4:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 13:00</td><td>Dorfner Günter</td><td>Riede Ronald</td><td>VF Herren B 1:6 4:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 13:00</td><td>Traub Leo</td><td>Heydenaber Thomas von</td><td>VF Herren B 6:2 6:3</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 13:30</td><td>Fuchs Lisa</td><td>Tristl Andrea</td><td>VF Damen A 6:3 6:1</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 15:00</td><td>Soueiha Markus</td><td>Streif Robert</td><td>HF Herren A 1:6 3:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 15:00</td><td>Henke Ulf</td><td>Schek Thomas</td><td>HF Herren A 6:3 6:0</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 15:00</td><td>Kasten Daniela</td><td>Vogg Alexandra</td><td>HF Damen B 7:5 7:5</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 15:00</td><td>Traub Sofie</td><td>Schmid Melina</td><td>HF Damen B 6:1 6:1</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 17:00</td><td>Huber Anja</td><td>Streif Luna</td><td>HF Damen A 1:6 6:4 5:10</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">11.09. 17:00</td><td>Fuchs Lisa</td><td>Traub Moni</td><td>HF Damen A 5:7 0:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.09. 11:00</td><td>Juricev Luka</td><td>Traub Leo</td><td>HF Herren B 6:2 6:1</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.09. 11:00</td><td>Traub Moni</td><td>Streif Luna</td><td>Finale Damen A 5:7 1:6</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.09. 11:00</td><td>Küstner Tim</td><td>Riede Ronald</td><td>HF Herren B 3:6 6:4 10:3</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.09. 13:00</td><td>Kasten Daniela</td><td>Traub Sofie</td><td>Finale Damen B 6:2 6:3</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.09. 13:00</td><td>Henke Ulf</td><td>Streif Robert</td><td>Finale Herren A 6:1 6:2</td><tr>
<tr style="height:1.3rem"><td class="text-nowrap">12.09. 15:00</td><td>Juricev Luka</td><td>Küstner Tim</td><td>Finale Herren B 6:0 4:6 10:7</td><tr>


      </tbody>
</table>

  </article>
</div>
<?php 
include("../../inc/footer.inc.php")
?>

