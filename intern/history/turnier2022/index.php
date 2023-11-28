<?php
session_start();
require_once("../../inc/config.inc.php");
require_once("../../inc/functions.inc.php");
require_once("../../inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Intern Historie Turnier 2022";
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
    
    <h1>Das Turnier 2022</h1>
    <h2>Spielklassen:</h2>
    <p>
      <a class="btn btn-success m-1" href="#damenergebnisse">Damen</a>
      <a class="btn btn-success m-1" href="#herrenergebnisse">Herren</a>
      <a class="btn btn-success m-1" href="#bildergalerie">Bildergalerie</a>
    </p>
    <h2>Organisatoren: </h2>
    <p>Norbert Maier, Conny Roloff</p>

    <h2 class="mt-3">Ergebnisse:</h2>
  <article id="damenergebnisse">
    <p class="h5">Damen</p>
    <ol>
      <h2 class="my-1"><li>Moni Traub</li></h2>
      <h2 class="my-1"><li>Anja Huber</li></h2>
    </ol>
    <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_damen.jpg"><img id="mannschaftsspieler" src="images/spielplan_damen.jpg" class="w-100" alt="Damen"></a>
    </div>
    
  </article>
    <br>
    <br>
    <article id="damenergebnisseb">
    <p class="h5">Damen B</p>
    <ol>
      <h2 class="my-1"><li>Alexandra Vogg</li></h2>
      <h2 class="my-1"><li>Sofie Traub</li></h2>
    </ol>
    <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_damenb.jpg"><img src="images/spielplan_damenb.jpg" class="w-75" alt="Damen B"></a>
    </div>
    
  </article>
    <br>
  <article id="herrenergebnisse">
    <p class="h5">Herren</p>
    <ol>
      <h2 class="my-1"><li>Kai Kirchhoff</li></h2>
      <h2 class="my-1"><li>Florian Krätzschmar</li></h2>
    </ol>
   <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_herren.jpg"><img id="mannschaftsspieler" src="images/spielplan_herren.jpg" class="w-100" alt="Herren"></a>
    </div>
    
    <br>
  </article>
  <article id="herrenergebnisseB">
    <p class="h5">Herren B</p>
    <ol>
      <h2 class="my-1"><li>David Schmidt</li></h2>
      <h2 class="my-1"><li>Wolfgang Ulrich</li></h2>
    </ol>
   <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_herrenb.jpg"><img src="images/spielplan_herrenb.jpg" class="w-75" alt="Herren B"></a>
    </div>
    
    <br>

</article>
<article id="bildergalerie" class="m-3">
  <p class="h3">Galerie</p>



<!-- ####  GALERIE #### -->

<div class="container">
    <h2>Galerie</h2>
    <div class="gallery-container">
<?php
  // Verzeichnis mit Bildern
  $imageDirectory = 'images/galerie';

  // Bilder im Verzeichnis lesen
  $images = glob($imageDirectory . '/*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);
  sort($images, SORT_REGULAR);
  foreach ($images as $image): 
?>
    <div class="gallery-item">
        <img src="<?= $image ?>" alt="Bild">
    </div>
<?php 
  endforeach; 
?>
    </div>
</div>



</article>
<!-- ### Liste aller Begegnungen 2021 ging verloren #### 
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

<tr style="height:1.3rem"><td class="text-nowrap">06.08. 18:00</td><td>AAAAA</td><td>BBBBB</td><td>1:6 4:6</td><tr>

      </tbody>
</table>

  </article>
-->
</div>
<?php 
include("../../inc/footer.inc.php")
?>

