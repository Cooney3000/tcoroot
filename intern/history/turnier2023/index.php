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
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-halloffame").classList.add("active");
    document.getElementById("nav-tafel").classList.remove("active");
    document.getElementById("nav-login").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
    </script>
<div class="container main-container">
  <article class="m-3">
    
    <h1>Das Turnier 2023</h1>
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
      <h2 class="my-1"><li>Lisa Fuchs</li></h2>
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
      <h2 class="my-1"><li>Sophia Egenberger</li></h2>
      <h2 class="my-1"><li>Jale Tiftik</li></h2>
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
      <h2 class="my-1"><li>Thomas Schek</li></h2>
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
          <td class="text-nowrap">22.05. 14:00</td>
          <!-- <td> </td> -->
          <td>Haug Katharina</td>
          <td>Ulrich Daniela</td>
          <td>6:2, 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>2</td>
          <td class="text-nowrap">23.05. 17:00</td>
          <!-- <td> </td> -->
          <td>Tristl Andrea</td>
          <td>Roloff Hanna</td>
          <td>3:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>3</td>
          <td class="text-nowrap">24.05. 16:00</td>
          <!-- <td> </td> -->
          <td>Roloff Alina</td>
          <td>Streif Luna</td>
          <td>2:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>4</td>
          <td class="text-nowrap">28.05. 11:00</td>
          <!-- <td> </td> -->
          <td>Streif Rico</td>
          <td>Mülleneisen Marcus</td>
          <td>5:7 7:5 10:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>5</td>
          <td class="text-nowrap">28.05. 18:00</td>
          <!-- <td> </td> -->
          <td>Soueiha Markus</td>
          <td>Röhlk Andreas</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>6</td>
          <td class="text-nowrap">03.06. 11:00</td>
          <!-- <td> </td> -->
          <td>Schmidt David</td>
          <td>Sagasser Thomas</td>
          <td>1:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>7</td>
          <td class="text-nowrap">04.06. 14:00</td>
          <!-- <td> </td> -->
          <td>Fuchs Lisa</td>
          <td>Egenberger Sophia</td>
          <td>7:5, 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>8</td>
          <td class="text-nowrap">05.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Eder Thomas</td>
          <td>Blau Christoph</td>
          <td>6:0 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>9</td>
          <td class="text-nowrap">07.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Maier Norbert</td>
          <td>Hochholzer Nico</td>
          <td>7:5, 2:6, 10:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>10</td>
          <td class="text-nowrap">07.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Krätzschmar Florian</td>
          <td>Juricev Luka</td>
          <td>6:2, 4:6, 10:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>11</td>
          <td class="text-nowrap">08.06. 10:00</td>
          <!-- <td> </td> -->
          <td>Tiftik Kai</td>
          <td>Gallert Peter</td>
          <td>6:4, 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>12</td>
          <td class="text-nowrap">08.06. 11:00</td>
          <!-- <td> </td> -->
          <td>Vollrath Benjamin</td>
          <td>Dutka Gerhard</td>
          <td>6:3 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>13</td>
          <td class="text-nowrap">09.06. 13:30</td>
          <!-- <td> </td> -->
          <td>Schmid Lara</td>
          <td>Haug Katharina</td>
          <td>6:2 2:6 10:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>14</td>
          <td class="text-nowrap">09.06. 17:00</td>
          <!-- <td> </td> -->
          <td>Vogg Elena</td>
          <td>Tiftik Jale</td>
          <td>6:1 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>15</td>
          <td class="text-nowrap">10.06. 10:00</td>
          <!-- <td> </td> -->
          <td>Maier Ronja</td>
          <td>Dutka Conny</td>
          <td>6:0, 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>16</td>
          <td class="text-nowrap">12.06. 15:00</td>
          <!-- <td> </td> -->
          <td>Fuhrmann Michael</td>
          <td>Schek Phil</td>
          <td>Aufgabe Fuhrmann wegen Verletzung, Sieger Phil Scheck</td>
        </tr>
        <tr style="height:1.3rem">
          <td>17</td>
          <td class="text-nowrap">13.06. 17:00</td>
          <!-- <td> </td> -->
          <td>Wanner Beate</td>
          <td>Eren Tanja</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>18</td>
          <td class="text-nowrap">13.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Mischke Sascha</td>
          <td>Ulrich Wolfgang</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>19</td>
          <td class="text-nowrap">14.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Giebisch Corinna</td>
          <td>Traub Moni</td>
          <td>3:6, 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>20</td>
          <td class="text-nowrap">16.06. 17:00</td>
          <!-- <td> </td> -->
          <td>Schmid Lara</td>
          <td>Vogg Elena</td>
          <td>0:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>21</td>
          <td class="text-nowrap">17.06. 11:00</td>
          <!-- <td> </td> -->
          <td>Wanner Dirk</td>
          <td>Hansen Niels</td>
          <td>7:5, 7:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>22</td>
          <td class="text-nowrap">18.06. 09:00</td>
          <!-- <td> </td> -->
          <td>Huber Anja</td>
          <td>Wanner Beate</td>
          <td>6:3, 6:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>23</td>
          <td class="text-nowrap">20.06. 18:30</td>
          <!-- <td> </td> -->
          <td>Roloff Hanna</td>
          <td>Fuchs Lisa</td>
          <td>2:6 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>24</td>
          <td class="text-nowrap">27.06. 18:30</td>
          <!-- <td> </td> -->
          <td>Vitzagia Johannes</td>
          <td>Schek Thomas</td>
          <td>1:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>25</td>
          <td class="text-nowrap">28.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Goettling Stefan</td>
          <td>Godenrath Jürgen</td>
          <td>6:4, 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>26</td>
          <td class="text-nowrap">28.06. 19:00</td>
          <!-- <td> </td> -->
          <td>Eder Thomas</td>
          <td>Krause Sven</td>
          <td>2:6; 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>27</td>
          <td class="text-nowrap">29.06. 08:00</td>
          <!-- <td> </td> -->
          <td>Küstner Ralf</td>
          <td>Tiftik Kai</td>
          <td>Aufgabe Küstner </td>
        </tr>
        <tr style="height:1.3rem">
          <td>28</td>
          <td class="text-nowrap">29.06. 16:00</td>
          <!-- <td> </td> -->
          <td>Vogg Alexandra</td>
          <td>Maier Ronja</td>
          <td>6:2 2:6 9:11</td>
        </tr>
        <tr style="height:1.3rem">
          <td>29</td>
          <td class="text-nowrap">29.06. 18:00</td>
          <!-- <td> </td> -->
          <td>Tesche Heiko</td>
          <td>Streif Rico</td>
          <td>4:6 7:6 5:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>30</td>
          <td class="text-nowrap">29.06. 18:30</td>
          <!-- <td> </td> -->
          <td>Wanner Dirk</td>
          <td>Traub Leo</td>
          <td>1:6, 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>31</td>
          <td class="text-nowrap">01.07. 10:30</td>
          <!-- <td> </td> -->
          <td>Küstner Tim</td>
          <td>Schek Phil</td>
          <td>6:1 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>32</td>
          <td class="text-nowrap">07.07. 15:00</td>
          <!-- <td> </td> -->
          <td>Streif Luna</td>
          <td>Huber Anja</td>
          <td>5:7, 7:5, 11:9</td>
        </tr>
        <tr style="height:1.3rem">
          <td>33</td>
          <td class="text-nowrap">11.07. 19:00</td>
          <!-- <td> </td> -->
          <td>Maier Norbert</td>
          <td>Tiftik Kai</td>
          <td>6:1 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>34</td>
          <td class="text-nowrap">14.07. 17:30</td>
          <!-- <td> </td> -->
          <td>Traub Moni</td>
          <td>Maier Ronja</td>
          <td>6:1 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>35</td>
          <td class="text-nowrap">18.07. 18:30</td>
          <!-- <td> </td> -->
          <td>Mischke Sascha</td>
          <td>Krause Sven</td>
          <td>6:1;6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>36</td>
          <td class="text-nowrap">18.07. 18:30</td>
          <!-- <td> </td> -->
          <td>Gallert Peter</td>
          <td>Vitzagia Johannes</td>
          <td>1:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>37</td>
          <td class="text-nowrap">19.07. 18:00</td>
          <!-- <td> </td> -->
          <td>Küstner Tim</td>
          <td>Sagasser Thomas</td>
          <td>4:6 6:3 6:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>38</td>
          <td class="text-nowrap">19.07. 19:00</td>
          <!-- <td> </td> -->
          <td>Goettling Stefan</td>
          <td>Krätzschmar Florian</td>
          <td>4:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>39</td>
          <td class="text-nowrap">21.07. 16:00</td>
          <!-- <td> </td> -->
          <td>Ulrich Daniela</td>
          <td>Eren Tanja</td>
          <td>3:2, Abbruch wg. Regen</td>
        </tr>
        <tr style="height:1.3rem">
          <td>40</td>
          <td class="text-nowrap">22.07. 15:00</td>
          <!-- <td> </td> -->
          <td>Juricev Luka</td>
          <td>Godenrath Jürgen</td>
          <td>6:2 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>41</td>
          <td class="text-nowrap">23.07. 17:00</td>
          <!-- <td> </td> -->
          <td>Maier Norbert</td>
          <td>Streif Rico</td>
          <td>6:2 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>42</td>
          <td class="text-nowrap">24.07. 16:00</td>
          <!-- <td> </td> -->
          <td>Fuchs Lisa</td>
          <td>Streif Luna</td>
          <td>6:2, 0:6, 10:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>43</td>
          <td class="text-nowrap">26.07. 10:00</td>
          <!-- <td> </td> -->
          <td>Giebisch Corinna</td>
          <td>Tristl Andrea</td>
          <td>4:6, 4:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>44</td>
          <td class="text-nowrap">28.07. 14:00</td>
          <!-- <td> </td> -->
          <td>Dutka Gerhard</td>
          <td>Hansen Niels</td>
          <td>4:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>45</td>
          <td class="text-nowrap">28.07. 16:00</td>
          <!-- <td> </td> -->
          <td>Riede Ronald</td>
          <td>Traub Leo</td>
          <td>4:6, 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>46</td>
          <td class="text-nowrap">28.07. 16:30</td>
          <!-- <td> </td> -->
          <td>Schek Thomas</td>
          <td>Sachse Michi</td>
          <td>Abbruch Regen! </td>
        </tr>
        <tr style="height:1.3rem">
          <td>47</td>
          <td class="text-nowrap">28.07. 18:00</td>
          <!-- <td> </td> -->
          <td>Blau Christoph</td>
          <td>Ulrich Wolfgang</td>
          <td>0:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>48</td>
          <td class="text-nowrap">29.07. 12:00</td>
          <!-- <td> </td> -->
          <td>Roloff Alina</td>
          <td>Egenberger Sophia</td>
          <td>1:6; 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>49</td>
          <td class="text-nowrap">31.07. 16:00</td>
          <!-- <td> </td> -->
          <td>Vogg Alexandra</td>
          <td>Tiftik Jale</td>
          <td>1:6 5:7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>50</td>
          <td class="text-nowrap">02.08. 15:30</td>
          <!-- <td> </td> -->
          <td>Tiftik Jale</td>
          <td>Tristl Andrea</td>
          <td>6:0 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>51</td>
          <td class="text-nowrap">02.08. 18:00</td>
          <!-- <td> </td> -->
          <td>Juricev Luka</td>
          <td>Mülleneisen Marcus</td>
          <td>Aufgabe wegen Verletzung, Sieger: Mülleneisen Marcus</td>
        </tr>
        <tr style="height:1.3rem">
          <td>52</td>
          <td class="text-nowrap">02.08. 18:30</td>
          <!-- <td> </td> -->
          <td>Schek Thomas</td>
          <td>Sachse Michi</td>
          <td>6:3 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>53</td>
          <td class="text-nowrap">05.08. 15:30</td>
          <!-- <td> </td> -->
          <td>Vogg Elena</td>
          <td>Traub Moni</td>
          <td>6:7 6:0 10:8</td>
        </tr>
        <tr style="height:1.3rem">
          <td>54</td>
          <td class="text-nowrap">08.08. 18:00</td>
          <!-- <td> </td> -->
          <td>Vitzagia Johannes</td>
          <td>Hansen Niels</td>
          <td>6:0;6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>55</td>
          <td class="text-nowrap">11.08. 17:00</td>
          <!-- <td> </td> -->
          <td>Leihenseder Hartmut</td>
          <td>Soueiha Markus</td>
          <td>0:6;2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>56</td>
          <td class="text-nowrap">12.08. 18:00</td>
          <!-- <td> </td> -->
          <td>Röhlk Andreas</td>
          <td>Schek Phil</td>
          <td>6:3, 6:1 für Andreas</td>
        </tr>
        <tr style="height:1.3rem">
          <td>57</td>
          <td class="text-nowrap">17.08. 08:00</td>
          <!-- <td> </td> -->
          <td>Ulrich Daniela</td>
          <td>Eren Tanja</td>
          <td>4:6, 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>58</td>
          <td class="text-nowrap">18.08. 18:00</td>
          <!-- <td> </td> -->
          <td>Ulrich Wolfgang</td>
          <td>Schmidt David</td>
          <td>0:6, 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>59</td>
          <td class="text-nowrap">25.08. 18:00</td>
          <!-- <td> </td> -->
          <td>Röhlk Andreas</td>
          <td>Hochholzer Nico</td>
          <td>0:1, w.o. Andreas</td>
        </tr>
        <tr style="height:1.3rem">
          <td>60</td>
          <td class="text-nowrap">31.08. 17:30</td>
          <!-- <td> </td> -->
          <td>Schek Thomas</td>
          <td>Sagasser Thomas</td>
          <td>Ergebnis: 7:5 / 3:6 / 10:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>61</td>
          <td class="text-nowrap">04.09. 17:30</td>
          <!-- <td> </td> -->
          <td>Mischke Sascha</td>
          <td>Soueiha Markus</td>
          <td>6:1,6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>62</td>
          <td class="text-nowrap">05.09. 17:30</td>
          <!-- <td> </td> -->
          <td>Egenberger Sophia</td>
          <td>Eren Tanja</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>63</td>
          <td class="text-nowrap">09.09. 10:00</td>
          <!-- <td> </td> -->
          <td>Krätzschmar Florian</td>
          <td>Traub Leo</td>
          <td>6:1 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>64</td>
          <td class="text-nowrap">10.09. 12:00</td>
          <!-- <td> </td> -->
          <td>Fuchs Lisa</td>
          <td>Vogg Elena</td>
          <td>6:7 6:7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>65</td>
          <td class="text-nowrap">11.09. 11:00</td>
          <!-- <td> </td> -->
          <td>Egenberger Sophia</td>
          <td>Tiftik Jale</td>
          <td>7:5 6:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>66</td>
          <td class="text-nowrap">11.09. 18:30</td>
          <!-- <td> </td> -->
          <td>Hochholzer Nico</td>
          <td>Vitzagia Johannes</td>
          <td>6:2 7:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>67</td>
          <td class="text-nowrap">16.09. 13:00</td>
          <!-- <td> </td> -->
          <td>Krätzschmar Florian</td>
          <td>Mischke Sascha</td>
          <td>2:6, 5:7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>68</td>
          <td class="text-nowrap">20.09. 17:30</td>
          <!-- <td> </td> -->
          <td>Mülleneisen Marcus</td>
          <td>Schmidt David</td>
          <td>0:6, 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>69</td>
          <td class="text-nowrap">27.09. 17:00</td>
          <!-- <td> </td> -->
          <td>Maier Norbert</td>
          <td>Schek Thomas</td>
          <td>0:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>70</td>
          <td class="text-nowrap">10.10. 16:00</td>
          <!-- <td> </td> -->
          <td>Mischke Sascha</td>
          <td>Schek Thomas</td>
          <td>Endspiel Herren 6:4,2:6,10:8</td>
        </tr>


      </tbody>
</table>

  </article>
</div>
<?php 
include("../../inc/footer.inc.php")
?>

