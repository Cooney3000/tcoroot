<?php
session_start();
require_once("../../inc/config.inc.php");
require_once("../../inc/functions.inc.php");
require_once("../../inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Intern Historie Turnier 2023";
include("../../inc/header.inc.php");
?>
<script>
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-halloffame").classList.add("active");
    document.getElementById("nav-tafel").classList.remove("active");
    document.getElementById("nav-login").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
    </script>
<div class="container main-container">
  <article class="m-3">
    
    <h1>Das Turnier 2024</h1>
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
      <h2 class="my-1"><li>Elena Vogg</li></h2>
      <h2 class="my-1"><li>Luna Streif</li></h2>
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
      <h2 class="my-1"><li>Melina Schmid</li></h2>
      <h2 class="my-1"><li>Ronja Maier</li></h2>
    </ol>
    <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_damenb.png"><img src="images/spielplan_damenb.png" class="w-75" alt="Damen B"></a>
    </div>
    
  </article>
    <br>
  <article id="herrenergebnisse">
    <p class="h5">Herren</p>
    <ol>
      <h2 class="my-1"><li>Sascha Mischke</li></h2>
      <h2 class="my-1"><li>Florian Krätzschmar</li></h2>
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
      <h2 class="my-1"><li>Marcus Mülleneisen</li></h2>
      <h2 class="my-1"><li>Leo Traub</li></h2>
    </ol>
   <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/spielplan_herrenb.png"><img src="images/spielplan_herrenb.png" class="w-75" alt="Herren B"></a>
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
  // Verzeichnis mit Bildern und Videos
  $mediaDirectory = 'images/galerie';

  // Bilder und Videos im Verzeichnis lesen
  $mediaFiles = glob($mediaDirectory . '/*.{jpg,jpeg,png,gif,mp4,JPG,JPEG,PNG,GIF,MP4}', GLOB_BRACE);
  sort($mediaFiles, SORT_REGULAR);
  foreach ($mediaFiles as $file): 
    $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
?>
    <div class="gallery-item">
        <?php if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
            <img src="<?= $file ?>" alt="Bild">
        <?php elseif ($fileExtension === 'mp4'): ?>
            <video controls>
                <source src="<?= $file ?>" type="video/mp4">
                Ihr Browser unterstützt das Videoformat nicht.
            </video>
        <?php endif; ?>
    </div>
<?php 
  endforeach; 
?>
    </div>
</div>






</article>
<article id="allebegegnungen" class="m-3">
  <p class="h3">Alle Begegnungen</p>
    <table class="table table-bordered table-light tbl-small">
    <thead>
        <tr>
          <th>#</th>
          <th>Start</th>
          <th>Spieler 1</th>
          <th>Spieler 2</th>
          <th>Kommentar</th>
        </tr>
      </thead>
        <tbody>

<!--######################################################-->

<tr style="height:1.3rem">
          <td>1</td>
          <td class="text-nowrap">22.05. 18:00</td>
          <!-- <td> </td> -->
          <td>Blau Christoph</td>
          <td>Sahiner Arda</td>
          <td>2:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>2</td>
          <td class="text-nowrap">25.05. 15:00</td>
          <!-- <td> </td> -->
          <td>Schmid Wolfgang</td>
          <td>Krause Sven</td>
          <td>0:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>3</td>
          <td class="text-nowrap">25.05. 15:00</td>
          <!-- <td> </td> -->
          <td>Ulrich Daniela</td>
          <td>Vogg Alexandra</td>
          <td>5:7   1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>4</td>
          <td class="text-nowrap">25.05. 15:30</td>
          <!-- <td> </td> -->
          <td>Tristl Markus</td>
          <td>Eder Thomas</td>
          <td>6:0 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>5</td>
          <td class="text-nowrap">26.05. 16:00</td>
          <!-- <td> </td> -->
          <td>Tiftik Kai</td>
          <td>Küstner Ralf</td>
          <td>0:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>6</td>
          <td class="text-nowrap">05.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Tristl Markus</td>
          <td>Krause Sven</td>
          <td>6:1, 7:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>7</td>
          <td class="text-nowrap">06.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Roloff Alina</td>
          <td>Maier Ronja</td>
          <td>7:6 6:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>8</td>
          <td class="text-nowrap">07.06. 17:00</td>
          <!-- <td> </td> -->
          <td>Vitzagia Johannes</td>
          <td>Ulrich Wolfgang</td>
          <td>6:0;6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>9</td>
          <td class="text-nowrap">11.06. 19:00</td>
          <!-- <td> </td> -->
          <td>Krätzschmar Florian</td>
          <td>Wanner Dirk</td>
          <td>6:0 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>10</td>
          <td class="text-nowrap">13.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Arndt Andreas</td>
          <td>Laszlo Beny</td>
          <td>1:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>11</td>
          <td class="text-nowrap">18.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Traub Moni</td>
          <td>Roloff Alina</td>
          <td>6:0 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>12</td>
          <td class="text-nowrap">18.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Tesche Heiko</td>
          <td>Mischke Sascha</td>
          <td>1:6,1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>13</td>
          <td class="text-nowrap">20.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Schmid Melina</td>
          <td>Tiftik Jale</td>
          <td>0:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>14</td>
          <td class="text-nowrap">22.06. 16:00</td>
          <!-- <td> </td> -->
          <td>Roloff Hanna</td>
          <td>Eren Tanja</td>
          <td>6:3 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>15</td>
          <td class="text-nowrap">25.06. 17:30</td>
          <!-- <td> </td> -->
          <td>Soueiha Markus</td>
          <td>Heydenaber Thomas von</td>
          <td>6:1 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>16</td>
          <td class="text-nowrap">25.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Maier Norbert</td>
          <td>Mülleneisen Marcus</td>
          <td>6:2 6:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>17</td>
          <td class="text-nowrap">27.06. 17:00</td>
          <!-- <td> </td> -->
          <td>Fuhrmann Michael</td>
          <td>Sachse Michi</td>
          <td>6:7 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>18</td>
          <td class="text-nowrap">28.06. 15:00</td>
          <!-- <td> </td> -->
          <td>Küstner Tim</td>
          <td>Traub Leo</td>
          <td>6:2 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>19</td>
          <td class="text-nowrap">29.06. 11:30</td>
          <!-- <td> </td> -->
          <td>Streif Rico</td>
          <td>Riede Ronald</td>
          <td>6:1 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>20</td>
          <td class="text-nowrap">02.07. 17:30</td>
          <!-- <td> </td> -->
          <td>Sachse Michi</td>
          <td>Krätzschmar Florian</td>
          <td>0:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>21</td>
          <td class="text-nowrap">02.07. 18:00</td>
          <!-- <td> </td> -->
          <td>Küstner Tim</td>
          <td>Hansen Niels</td>
          <td>6:1 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>22</td>
          <td class="text-nowrap">04.07. 18:00</td>
          <!-- <td> </td> -->
          <td>Schmidt David</td>
          <td>Godenrath Jürgen</td>
          <td>6:1, 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>23</td>
          <td class="text-nowrap">07.07. 16:00</td>
          <!-- <td> </td> -->
          <td>Schek Thomas</td>
          <td>Gallert Peter</td>
          <td>6:0, 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>24</td>
          <td class="text-nowrap">16.07. 16:00</td>
          <!-- <td> </td> -->
          <td>Fuhrmann Michael</td>
          <td>Blau Christoph</td>
          <td>6:1 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>25</td>
          <td class="text-nowrap">16.07. 17:00</td>
          <!-- <td> </td> -->
          <td>Mischke Sascha</td>
          <td>Laszlo Beny</td>
          <td>6:0,6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>26</td>
          <td class="text-nowrap">19.07. 18:30</td>
          <!-- <td> </td> -->
          <td>Soueiha Markus</td>
          <td>Sahiner Arda</td>
          <td>6:1, 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>27</td>
          <td class="text-nowrap">21.07. 11:00</td>
          <!-- <td> </td> -->
          <td>Vogg Alexandra</td>
          <td>Streif Luna</td>
          <td>3:6, 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>28</td>
          <td class="text-nowrap">21.07. 15:00</td>
          <!-- <td> </td> -->
          <td>Maier Norbert</td>
          <td>Streif Rico</td>
          <td>6:4 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>29</td>
          <td class="text-nowrap">21.07. 17:00</td>
          <!-- <td> </td> -->
          <td>Tristl Markus</td>
          <td>Krätzschmar Florian</td>
          <td>6:3 5:7 11:13</td>
        </tr>
        <tr style="height:1.3rem">
          <td>30</td>
          <td class="text-nowrap">21.07. 17:00</td>
          <!-- <td> </td> -->
          <td>Fuchs Lisa</td>
          <td>Roloff Hanna</td>
          <td>6:2 6:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>31</td>
          <td class="text-nowrap">22.07. 18:30</td>
          <!-- <td> </td> -->
          <td>Schek Thomas</td>
          <td>Vitzagia Johannes</td>
          <td>6:1 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>32</td>
          <td class="text-nowrap">23.07. 18:00</td>
          <!-- <td> </td> -->
          <td>Arndt Andreas</td>
          <td>Tesche Heiko</td>
          <td>0:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>33</td>
          <td class="text-nowrap">23.07. 18:00</td>
          <!-- <td> </td> -->
          <td>Küstner Ralf</td>
          <td>Schmidt David</td>
          <td>3:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>34</td>
          <td class="text-nowrap">24.07. 18:30</td>
          <!-- <td> </td> -->
          <td>Ulrich Wolfgang</td>
          <td>Mülleneisen Marcus</td>
          <td>0:6;3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>35</td>
          <td class="text-nowrap">25.07. 19:00</td>
          <!-- <td> </td> -->
          <td>Gallert Peter</td>
          <td>Eder Thomas</td>
          <td>3:6, 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>36</td>
          <td class="text-nowrap">27.07. 10:00</td>
          <!-- <td> </td> -->
          <td>Godenrath Jürgen</td>
          <td>Traub Leo</td>
          <td>2:6, 1:6 </td>
        </tr>
        <tr style="height:1.3rem">
          <td>37</td>
          <td class="text-nowrap">28.07. 17:00</td>
          <!-- <td> </td> -->
          <td>Tiftik Kai</td>
          <td>Heydenaber Thomas von</td>
          <td>6:7 6:0 8:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>38</td>
          <td class="text-nowrap">29.07. 16:00</td>
          <!-- <td> </td> -->
          <td>Fuchs Lisa</td>
          <td>Streif Luna</td>
          <td>6:3  3:6  7:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>39</td>
          <td class="text-nowrap">30.07. 18:00</td>
          <!-- <td> </td> -->
          <td>Eren Tanja</td>
          <td>Maier Ronja</td>
          <td>6:2 2:6 4:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>40</td>
          <td class="text-nowrap">30.07. 18:30</td>
          <!-- <td> </td> -->
          <td>Wanner Dirk</td>
          <td>Riede Ronald</td>
          <td>0:6, 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>41</td>
          <td class="text-nowrap">04.08. 10:00</td>
          <!-- <td> </td> -->
          <td>Tesche Heiko</td>
          <td>Heydenaber Thomas von</td>
          <td>6:0 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>42</td>
          <td class="text-nowrap">04.08. 17:00</td>
          <!-- <td> </td> -->
          <td>Maier Norbert</td>
          <td>Schmidt David</td>
          <td>2:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>43</td>
          <td class="text-nowrap">06.08. 18:00</td>
          <!-- <td> </td> -->
          <td>Eder Thomas</td>
          <td>Mülleneisen Marcus</td>
          <td>0:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>44</td>
          <td class="text-nowrap">07.08. 18:00</td>
          <!-- <td> </td> -->
          <td>Krätzschmar Florian</td>
          <td>Schmidt David</td>
          <td>6:7 7:6 10:8</td>
        </tr>
        <tr style="height:1.3rem">
          <td>45</td>
          <td class="text-nowrap">08.08. 18:30</td>
          <!-- <td> </td> -->
          <td>Hansen Niels</td>
          <td>Riede Ronald</td>
          <td>1:6, 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>46</td>
          <td class="text-nowrap">22.08. 18:00</td>
          <!-- <td> </td> -->
          <td>Vogg Elena</td>
          <td>Tiftik Jale</td>
          <td>6:1 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>47</td>
          <td class="text-nowrap">27.08. 17:30</td>
          <!-- <td> </td> -->
          <td>Küstner Tim</td>
          <td>Schek Thomas</td>
          <td>2:6 - 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>48</td>
          <td class="text-nowrap">27.08. 17:30</td>
          <!-- <td> </td> -->
          <td>Tesche Heiko</td>
          <td>Mülleneisen Marcus</td>
          <td>5:7 6:4 7:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>49</td>
          <td class="text-nowrap">03.09. 17:30</td>
          <!-- <td> </td> -->
          <td>Mischke Sascha</td>
          <td>Soueiha Markus</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>50</td>
          <td class="text-nowrap">10.09. 17:00</td>
          <!-- <td> </td> -->
          <td>Fuhrmann Michael</td>
          <td>Traub Leo</td>
          <td>0:6;3:6 Gewinner Leo</td>
        </tr>
        <tr style="height:1.3rem">
          <td>51</td>
          <td class="text-nowrap">17.09. 17:00</td>
          <!-- <td> </td> -->
          <td>Vogg Elena</td>
          <td>Traub Moni</td>
          <td>6:2 7:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>52</td>
          <td class="text-nowrap">18.09. 18:00</td>
          <!-- <td> </td> -->
          <td>Riede Ronald</td>
          <td>Traub Leo</td>
          <td>1:6, 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>53</td>
          <td class="text-nowrap">03.10. 11:00</td>
          <!-- <td> </td> -->
          <td>Mischke Sascha</td>
          <td>Schek Thomas</td>
          <td>4:6 6:0 10:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>54</td>
          <td class="text-nowrap">06.10. 13:00</td>
          <!-- <td> </td> -->
          <td>Streif Luna</td>
          <td>Vogg Elena</td>
          <td>4:6 7:5 6:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>55</td>
          <td class="text-nowrap">12.10. 13:00</td>
          <!-- <td> </td> -->
          <td>Mülleneisen Marcus</td>
          <td>Traub Leo</td>
          <td>4:6 6:3 10:6 </td>
        </tr>

      </tbody>
</table>

  </article>
</div>
<?php 
include("../../inc/footer.inc.php")
?>

