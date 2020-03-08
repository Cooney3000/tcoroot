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
    
    <h1>Das Turnier 2019</h1>
    <p>
      <a class="btn btn-success m-1" href="#damenergebnisse">Mannschaftsspielerinnen</a>
      <a class="btn btn-success m-1" href="#herrenergebnisse">Mannschaftsspieler</a>
      <a class="btn btn-success m-1" href="#freizeitergebnisse">Freizeitspieler/innen</a>
      <a class="btn btn-success m-1" href="#bildergalerie">Bildergalerie</a>
      <a class="btn btn-success m-1" href="#allebegegnungen">Alle Begegnungen  </a>
    </p>
    <p class="h3">Organisatoren: Norbert Maier, Conny Roloff</p>

  <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/plakat.png" alt="Turnierplakat" /></div>
  
  <p class="h3">Ergebnisse</p>
  <article id="damenergebnisse">
    <p class="h4">Mannschaftsspielerinnen</p>
    <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/01_petra.png" alt="" /></div>
    <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/02_lisa.png" alt="" /></div>
    <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/03_britta.png" alt="" /></div>
    
    <table class="table ">
      <th>Platz</th><th>Spielerin</th>
      <tr><td>1.	</td><td>Streif, Petra         </td></tr>
      <tr><td>2.	</td><td>Fuchs, Lisa           </td></tr>
      <tr><td>3.	</td><td>Göttling, Britta      </td></tr>
      <tr><td>4.	</td><td>Traub, Moni           </td></tr>
      <tr><td>5.	</td><td>Huber, Anja           </td></tr>
      <tr><td>	</td><td>Rohde-Kammers, Petra  </td></tr>
      <tr><td>7.	</td><td>Haberzettl, Elena     </td></tr>
      <tr><td>	</td><td>Streif, Luna          </td></tr>
      <tr><td>9.	</td><td>Giebisch, Corinna     </td></tr>
      <tr><td>	</td><td>Roloff, Hanna         </td></tr>
      <tr><td>	</td><td>Schmid, Nicola        </td></tr>
      <tr><td>	</td><td>Tristl, Andrea        </td></tr>
      <tr><td>13.	</td><td>Eder, Petra           </td></tr>
      <tr><td>	</td><td>Schmid, Lara          </td></tr>
      <tr><td>	</td><td>Wanner, Beate         </td></tr>
    </table>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/mannschaftsspielerinnen.png"><img id="mannschaftsspieler" src="images/mannschaftsspielerinnen.png" class="w-100" alt="Mannschaftsspielerinnen"></a>
    </div>
    
  </article>
  <article id="herrenergebnisse">
    <p class="h4">Mannschaftsspieler</p>
    <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/04_scheki.png" alt="" /></div>
    <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/05_flo.png" alt="" /></div>
    <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/06_sascha.png" alt="" /></div>
    <table class="table">
      <th>Platz</th><th>Spieler</th>
      <tr><td>1.	</td><td>Schek, Thomas      </td></tr>
      <tr><td>2.	</td><td>Krätschmar, Florian</td></tr>
      <tr><td>3.	</td><td>Mischke, Sascha    </td></tr>
      <tr><td>4.	</td><td>Streif, Robert     </td></tr>
      <tr><td>5.	</td><td>Tristl, Markus     </td></tr>
      <tr><td>	</td><td>Vogt, Klaus        </td></tr>
      <tr><td>7.	</td><td>Mülleneisen, Markus</td></tr>
      <tr><td>	</td><td>Soueiha, Markus    </td></tr>
      <tr><td>9.	</td><td>Juritschev, Luka   </td></tr>
      <tr><td>	</td><td>Küstner, Ralf      </td></tr>
      <tr><td>	</td><td>Maier, Norbert     </td></tr>
      <tr><td>	</td><td>Tesche, Holger     </td></tr>
      <tr><td>13.	</td><td>Göttling, Stefan   </td></tr>
      <tr><td>	</td><td>Hochholzer, Nico   </td></tr>
      <tr><td>	</td><td>Lazlo, Benni       </td></tr>
      <tr><td>	</td><td>Petzold, Bernd     </td></tr>
      <tr><td>17.	</td><td>Ochsenmeier, Peter </td></tr>
      <tr><td>	</td><td>Riede, Rony        </td></tr>
      <tr><td>	</td><td>Roloff, Conny      </td></tr>
      <tr><td>	</td><td>Sachse, Michi      </td></tr>
      <tr><td>	</td><td>Schreyer, Christian</td></tr>
      <tr><td>	</td><td>Streif, Rico       </td></tr>
      <tr><td>	</td><td>Tesche, Heiko      </td></tr>
      <tr><td>	</td><td>Vitzagia, Johannes </td></tr>
      <tr><td>25.	</td><td>Gallert, Peter     </td></tr>
      <tr><td>	</td><td>Godenrath, Jürgen  </td></tr>
      <tr><td>	</td><td>Herrmann, Jochen   </td></tr>
      <tr><td>	</td><td>Küstner, Tim       </td></tr>
      <tr><td>	</td><td>Rieber, Niko       </td></tr>
      <tr><td>	</td><td>Röhlk, Andreas     </td></tr>
      <tr><td>	</td><td>Schmid, Wolfgang   </td></tr>
      <tr><td>	</td><td>Schmidt, Peter     </td></tr>
    </table>
    <br>
    <div>
      <p class="h5">Turnierbaum</p>
      <a href="images/mannschaftsspieler.png"><img id="mannschaftsspieler" src="images/mannschaftsspieler.png" class="w-100" alt="Mannschaftsspieler"></a>
    </div>
    
    <br>
  </article>
  <article id="freizeitergebnisse">
  <p class="h4">Freizeitspieler</p>
  <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/07_hacky.png" alt="" /></div>
  <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/08_sven.png" alt="" /></div>
  <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2019/images/09_sebastian.png" alt="" /></div>
  <table class="table">
    <th>Platz</th><th>Spielerin</th>
		<tr><td>1.	</td><td>Leihenseder, Hartmut</td></tr>
		<tr><td>2.	</td><td>Krause, Sven</td></tr>
		<tr><td>3.	</td><td>Hämmerl, Sebastian</td></tr>
		<tr><td>4.	</td><td>Mitterer, Hermann</td></tr>
		<tr><td>5.	</td><td>May, Matthias</td></tr>
		<tr><td>	</td><td>v. Heydenaber, Thomas</td></tr>
		<tr><td>7.	</td><td>Schmidt, David</td></tr>
		<tr><td>	</td><td>Vollrath, Benjamin</td></tr>
		<tr><td>9.	</td><td>Eder, Thomas</td></tr>
		<tr><td>	</td><td>Rieber, Johannes</td></tr>
		<tr><td>	</td><td>Schek, Dieter</td></tr>
		<tr><td>	</td><td>Ulrich, Wolfgang</td></tr>
		<tr><td>13.	</td><td>Arndt, Andreas</td></tr>
		<tr><td>	</td><td>Dutka, Conny</td></tr>
		<tr><td>	</td><td>Rank, Andreas</td></tr>
		<tr><td>	</td><td>Schmidt, Hermine</td></tr>
		<tr><td>17.	</td><td>Arnholz-Tiftik, Christina</td></tr>
		<tr><td>	</td><td>Dutka, Gerhard</td></tr>
		<tr><td>	</td><td>Möller, Hanne</td></tr>
		<tr><td>	</td><td>Rieber, Susanne</td></tr>
		<tr><td>	</td><td>Schmidt, Ben</td></tr>
		<tr><td>	</td><td>Tiftik, Kai</td></tr>
		<tr><td>	</td><td>Weidenbeck, Helga</td></tr>
		<tr><td>24.	</td><td>Wanner, Dirk</td></tr>
		<tr><td>	</td><td>Redschuk, Igor</td></tr>
  </table>
  <div>
  <p class="h5">Turnierbaum</p>
    <a href="images/freizeitspieler.png"><img id="freizeitspieler" src="images/freizeitspieler.png" class="w-100" alt="Mannschaftsspieler"></a>
  </div>

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
          <th>#</th>
          <th>Start</th>
          <th>Kat</th>
          <th>Spieler 1</th>
          <th>Spieler 2</th>
          <th>Kommentar</th>
        </tr>
      </thead>
        <tr style="height:1.3rem">
          <td>1</td>
          <td>24.05.2019 10:00</td>
          <td>D</td>
          <td>Giebisch Corinna</td>
          <td>Tristl Andrea</td>
          <td>6:3, 2:6, 10:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>2</td>
          <td>25.05.2019 08:30</td>
          <td>H</td>
          <td>Streif Robert</td>
          <td>Schreyer Christian</td>
          <td>3:6, 6:0, 10:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>3</td>
          <td>26.05.2019 17:00</td>
          <td>H</td>
          <td>Tesche Heiko</td>
          <td>Rieber Nikolaus</td>
          <td>6:4 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>4</td>
          <td>28.05.2019 18:00</td>
          <td>D</td>
          <td>Fuchs Lisa</td>
          <td>Roloff Hanna</td>
          <td>6:3 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>5</td>
          <td>29.05.2019 16:00</td>
          <td>H</td>
          <td>Roloff Conny</td>
          <td>Streif Rico</td>
          <td>4:6 4:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>6</td>
          <td>30.05.2019 12:00</td>
          <td>H</td>
          <td>Röhlk Andreas</td>
          <td>Maier Norbert</td>
          <td> 2:6, 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>7</td>
          <td>30.05.2019 17:00</td>
          <td>H</td>
          <td>Krätzschmar Florian</td>
          <td>Gallert Peter</td>
          <td>6:1 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>8</td>
          <td>31.05.2019 08:00</td>
          <td>F</td>
          <td>Vollrath Benjamin</td>
          <td>Tiftik Kai</td>
          <td>6:0 7:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>9</td>
          <td>31.05.2019 12:00</td>
          <td>D</td>
          <td>Huber Anja</td>
          <td>Wanner Beate</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>10</td>
          <td>31.05.2019 18:00</td>
          <td>F</td>
          <td>Dutka Gerhard</td>
          <td>Wanner Dirk</td>
          <td>7:6; 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>11</td>
          <td>01.06.2019 09:00</td>
          <td>D</td>
          <td>Schmid Lara</td>
          <td>Streif Luna</td>
          <td>6:7 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>12</td>
          <td>01.06.2019 11:00</td>
          <td>H</td>
          <td>Juricev Luka</td>
          <td>Vogt Klaus</td>
          <td>1:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>13</td>
          <td>02.06.2019 09:00</td>
          <td>F</td>
          <td>Rank Andreas</td>
          <td>Schmidt David</td>
          <td>4:6; 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>14</td>
          <td>02.06.2019 09:00</td>
          <td>F</td>
          <td>Arndt Andreas</td>
          <td>Rieber Johannes</td>
          <td>3:6 , 6:7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>15</td>
          <td>02.06.2019 11:00</td>
          <td>F</td>
          <td>Rieber Susanne</td>
          <td>Krause Sven</td>
          <td>1:6; 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>16</td>
          <td>04.06.2019 18:00</td>
          <td>D</td>
          <td>Haberzettl Elena</td>
          <td>Traub Moni</td>
          <td>1:6 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>17</td>
          <td>06.06.2019 16:00</td>
          <td>F</td>
          <td>Möller Hanne</td>
          <td>Ulrich Wolfgang</td>
          <td>0:6 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>18</td>
          <td>06.06.2019 17:00</td>
          <td>H</td>
          <td>Küstner Tim</td>
          <td>Tristl Markus</td>
          <td>1:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>19</td>
          <td>06.06.2019 19:00</td>
          <td>H</td>
          <td>Juricev Luka</td>
          <td>Gallert Peter</td>
          <td>6:0,6:3 </td>
        </tr>
        <tr style="height:1.3rem">
          <td>20</td>
          <td>07.06.2019 12:00</td>
          <td>D</td>
          <td>Eder Petra</td>
          <td>Rohde-Kammers Petra</td>
          <td>0:6, 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>21</td>
          <td>07.06.2019 18:00</td>
          <td>H</td>
          <td>Goettling Stefan</td>
          <td>Hochholzer Nico</td>
          <td>3:6 4:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>22</td>
          <td>07.06.2019 18:30</td>
          <td>H</td>
          <td>Krätzschmar Florian</td>
          <td>Vogt Klaus</td>
          <td>2:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>23</td>
          <td>08.06.2019 10:00</td>
          <td>H</td>
          <td>Sachse Michi</td>
          <td>Riede Ronald</td>
          <td> 3:6 6:2 10:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>24</td>
          <td>08.06.2019 11:30</td>
          <td>H</td>
          <td>Rieber Nikolaus</td>
          <td>Schreyer Christian</td>
          <td>4:6 5:7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>25</td>
          <td>12.06.2019 18:00</td>
          <td>H</td>
          <td>Riede Ronald</td>
          <td>Röhlk Andreas</td>
          <td>6:1, 6:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>26</td>
          <td>13.06.2019 10:00</td>
          <td>D</td>
          <td>Göttling Britta</td>
          <td>Schmid Nicola</td>
          <td>6:1 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>27</td>
          <td>15.06.2019 10:00</td>
          <td>H</td>
          <td>Petzold Bernd</td>
          <td>Schmid Wolfgang</td>
          <td>6:4 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>28</td>
          <td>15.06.2019 10:00</td>
          <td>F</td>
          <td>Hämmerl Sebastian</td>
          <td>Schmidt Benni</td>
          <td>6:2, 7:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>29</td>
          <td>15.06.2019 12:00</td>
          <td>H</td>
          <td>Sachse Michi</td>
          <td>Maier Norbert</td>
          <td>6:7 6:2 9:11</td>
        </tr>
        <tr style="height:1.3rem">
          <td>30</td>
          <td>15.06.2019 14:00</td>
          <td>H</td>
          <td>Mülleneisen Marcus</td>
          <td>Schmidt Peter</td>
          <td>3:6 1:3 Schmidt w/o</td>
        </tr>
        <tr style="height:1.3rem">
          <td>31</td>
          <td>15.06.2019 14:00</td>
          <td>H</td>
          <td>Laszlo Beny</td>
          <td>Godenrath Jürgen</td>
          <td>6:4 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>32</td>
          <td>15.06.2019 14:00</td>
          <td>F</td>
          <td>Dutka Conny</td>
          <td>Eder Thomas</td>
          <td>3:6 6:4 9:11</td>
        </tr>
        <tr style="height:1.3rem">
          <td>33</td>
          <td>15.06.2019 14:00</td>
          <td>F</td>
          <td>Weidenbeck Helga</td>
          <td>Schek Dieter</td>
          <td>1:6 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>34</td>
          <td>15.06.2019 16:00</td>
          <td>H</td>
          <td>Mischke Sascha</td>
          <td>Soueiha Markus</td>
          <td>6:1 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>35</td>
          <td>16.06.2019 18:00</td>
          <td>H</td>
          <td>Vitzagia Johannes</td>
          <td>Ochsenmeier Peter</td>
          <td>6:0 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>36</td>
          <td>18.06.2019 18:30</td>
          <td>H</td>
          <td>Laszlo Beny</td>
          <td>Mischke Sascha</td>
          <td>0:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>37</td>
          <td>20.06.2019 17:30</td>
          <td>H</td>
          <td>Schreyer Christian</td>
          <td>Krätzschmar Florian</td>
          <td>4:6 4:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>38</td>
          <td>21.06.2019 10:00</td>
          <td>D</td>
          <td>Göttling Britta</td>
          <td>Huber Anja</td>
          <td>6:2 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>39</td>
          <td>21.06.2019 13:00</td>
          <td>F</td>
          <td>Schek Dieter</td>
          <td>Dutka Gerhard</td>
          <td>6:2 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>40</td>
          <td>21.06.2019 17:00</td>
          <td>H</td>
          <td>Streif Rico</td>
          <td>Tesche Holger</td>
          <td>2:6; 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>41</td>
          <td>22.06.2019 14:00</td>
          <td>F</td>
          <td>Schmidt David</td>
          <td>Arnholz-Tiftik Christina</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>42</td>
          <td>23.06.2019 15:00</td>
          <td>H</td>
          <td>Vitzagia Johannes</td>
          <td>Mülleneisen Marcus</td>
          <td>5:7 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>43</td>
          <td>23.06.2019 16:00</td>
          <td>H</td>
          <td>Godenrath Jürgen</td>
          <td>Soueiha Markus</td>
          <td>0:6,0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>44</td>
          <td>23.06.2019 16:00</td>
          <td>H</td>
          <td>Streif Robert</td>
          <td>Tesche Heiko</td>
          <td>6:2 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>45</td>
          <td>23.06.2019 17:00</td>
          <td>D</td>
          <td>Schmid Lara</td>
          <td>Roloff Hanna</td>
          <td>3:6 6:7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>46</td>
          <td>23.06.2019 18:00</td>
          <td>F</td>
          <td>Leihenseder Hartmut</td>
          <td>Krause Sven</td>
          <td>4:6 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>47</td>
          <td>25.06.2019 18:30</td>
          <td>H</td>
          <td>Hochholzer Nico</td>
          <td>Tristl Markus</td>
          <td>2:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>48</td>
          <td>26.06.2019 16:30</td>
          <td>D</td>
          <td>Haberzettl Elena</td>
          <td>Eder Petra</td>
          <td>6:4 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>49</td>
          <td>26.06.2019 19:00</td>
          <td>F</td>
          <td>Vollrath Benjamin</td>
          <td>May Matthias</td>
          <td>3:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>50</td>
          <td>27.06.2019 08:30</td>
          <td>F</td>
          <td>Schmidt Benni</td>
          <td>Leihenseder Hartmut</td>
          <td>0:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>51</td>
          <td>27.06.2019 18:00</td>
          <td>F</td>
          <td>Mitterer Hermann</td>
          <td>Hämmerl Sebastian</td>
          <td>6:7,6:4,9:11</td>
        </tr>
        <tr style="height:1.3rem">
          <td>52</td>
          <td>27.06.2019 19:30</td>
          <td>H</td>
          <td>Schek Thomas</td>
          <td>Küstner Ralf</td>
          <td>2:6 6:2 10:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>53</td>
          <td>28.06.2019 16:00</td>
          <td>H</td>
          <td>Hochholzer Nico</td>
          <td>Roloff Conny</td>
          <td>6:7 6:4 10:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>54</td>
          <td>28.06.2019 17:30</td>
          <td>F</td>
          <td>Schmidt Hermine</td>
          <td>Eder Thomas</td>
          <td>1:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>55</td>
          <td>28.06.2019 19:30</td>
          <td>F</td>
          <td>Heydenaber Thomas von</td>
          <td>Ulrich Wolfgang</td>
          <td>1:6 7:5 10:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>56</td>
          <td>30.06.2019 08:30</td>
          <td>F</td>
          <td>Arndt Andreas</td>
          <td>Arnholz-Tiftik Christina</td>
          <td>7:6, 5:7, 10:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>57</td>
          <td>30.06.2019 10:00</td>
          <td>F</td>
          <td>Weidenbeck Helga</td>
          <td>Wanner Dirk</td>
          <td>3:6 6:3 10:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>58</td>
          <td>30.06.2019 18:00</td>
          <td>F</td>
          <td>Ulrich Wolfgang</td>
          <td>Tiftik Kai</td>
          <td>6:4 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>59</td>
          <td>02.07.2019 16:30</td>
          <td>F</td>
          <td>Heydenaber Thomas von</td>
          <td>Schek Dieter</td>
          <td>6:3, 6:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>60</td>
          <td>02.07.2019 18:00</td>
          <td>D</td>
          <td>Traub Moni</td>
          <td>Rohde-Kammers Petra</td>
          <td>6:2 7:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>61</td>
          <td>03.07.2019 10:00</td>
          <td>D</td>
          <td>Streif Petra</td>
          <td>Giebisch Corinna</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>62</td>
          <td>03.07.2019 16:45</td>
          <td>H</td>
          <td>Petzold Bernd</td>
          <td>Schek Thomas</td>
          <td>1:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>63</td>
          <td>03.07.2019 17:00</td>
          <td>H</td>
          <td>Laszlo Beny</td>
          <td>Ochsenmeier Peter</td>
          <td>6:0 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>64</td>
          <td>03.07.2019 17:30</td>
          <td>H</td>
          <td>Juricev Luka</td>
          <td>Tesche Heiko</td>
          <td>4:4, Aufgabe Tesche</td>
        </tr>
        <tr style="height:1.3rem">
          <td>65</td>
          <td>03.07.2019 18:15</td>
          <td>D</td>
          <td>Streif Luna</td>
          <td>Fuchs Lisa</td>
          <td>3:6, 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>66</td>
          <td>03.07.2019 19:00</td>
          <td>F</td>
          <td>Krause Sven</td>
          <td>Rieber Johannes</td>
          <td>6:1; 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>67</td>
          <td>04.07.2019 16:00</td>
          <td>D</td>
          <td>Schmid Nicola</td>
          <td>Wanner Beate</td>
          <td>6:0 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>68</td>
          <td>04.07.2019 18:00</td>
          <td>H</td>
          <td>Schmid Wolfgang</td>
          <td>Küstner Ralf</td>
          <td>2:6 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>69</td>
          <td>04.07.2019 19:45</td>
          <td>H</td>
          <td>Krätzschmar Florian</td>
          <td>Hochholzer Nico</td>
          <td>6:1 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>70</td>
          <td>05.07.2019 15:00</td>
          <td>D</td>
          <td>Huber Anja</td>
          <td>Roloff Hanna</td>
          <td>6:2 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>71</td>
          <td>06.07.2019 18:00</td>
          <td>F</td>
          <td>Heydenaber Thomas von</td>
          <td>Krause Sven</td>
          <td>1:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>72</td>
          <td>07.07.2019 14:00</td>
          <td>F</td>
          <td>May Matthias</td>
          <td>Eder Thomas</td>
          <td>6:1 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>73</td>
          <td>07.07.2019 16:30</td>
          <td>F</td>
          <td>Mitterer Hermann</td>
          <td>Arndt Andreas</td>
          <td>6:0 , 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>74</td>
          <td>08.07.2019 12:00</td>
          <td>F</td>
          <td>Vollrath Benjamin</td>
          <td>Möller Hanne</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>75</td>
          <td>08.07.2019 15:30</td>
          <td>F</td>
          <td>Weidenbeck Helga</td>
          <td>Schmidt Hermine</td>
          <td>4:6;6:3;5:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>76</td>
          <td>09.07.2019 16:00</td>
          <td>F</td>
          <td>Mitterer Hermann</td>
          <td>Schek Dieter</td>
          <td>6:1, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>77</td>
          <td>09.07.2019 18:30</td>
          <td>H</td>
          <td>Vogt Klaus</td>
          <td>Tristl Markus</td>
          <td>6:1, 7:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>78</td>
          <td>10.07.2019 16:00</td>
          <td>D</td>
          <td>Schmid Nicola</td>
          <td>Streif Luna</td>
          <td>3:6 6:7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>79</td>
          <td>10.07.2019 17:30</td>
          <td>H</td>
          <td>Sachse Michi</td>
          <td>Küstner Ralf</td>
          <td>1:6;1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>80</td>
          <td>10.07.2019 20:00</td>
          <td>F</td>
          <td>Hämmerl Sebastian</td>
          <td>Schmidt David</td>
          <td>6:4, 7:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>81</td>
          <td>12.07.2019 15:30</td>
          <td>H</td>
          <td>Schek Thomas</td>
          <td>Mülleneisen Marcus</td>
          <td>6:0 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>82</td>
          <td>13.07.2019 17:00</td>
          <td>F</td>
          <td>Dutka Conny</td>
          <td>Dutka Gerhard</td>
          <td>6:3 4:6 8:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>83</td>
          <td>13.07.2019 17:00</td>
          <td>H</td>
          <td>Goettling Stefan</td>
          <td>Küstner Tim</td>
          <td>6:3 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>84</td>
          <td>14.07.2019 11:00</td>
          <td>D</td>
          <td>Tristl Andrea</td>
          <td>Rohde-Kammers Petra</td>
          <td>0:6. 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>85</td>
          <td>14.07.2019 18:00</td>
          <td>F</td>
          <td>Ulrich Wolfgang</td>
          <td>Dutka Conny</td>
          <td>6:1, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>86</td>
          <td>14.07.2019 18:00</td>
          <td>F</td>
          <td>Rank Andreas</td>
          <td>Leihenseder Hartmut</td>
          <td>0:6, 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>87</td>
          <td>15.07.2019 16:00</td>
          <td>D</td>
          <td>Streif Petra</td>
          <td>Göttling Britta</td>
          <td>6:2, 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>88</td>
          <td>15.07.2019 16:00</td>
          <td>H</td>
          <td>Vitzagia Johannes</td>
          <td>Soueiha Markus</td>
          <td>5:7 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>89</td>
          <td>16.07.2019 17:00</td>
          <td>D</td>
          <td>Giebisch Corinna</td>
          <td>Haberzettl Elena</td>
          <td>2:6 4:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>90</td>
          <td>16.07.2019 19:00</td>
          <td>H</td>
          <td>Streif Rico</td>
          <td>Goettling Stefan</td>
          <td>4:6 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>91</td>
          <td>17.07.2019 16:45</td>
          <td>D</td>
          <td>Rohde-Kammers Petra</td>
          <td>Streif Luna</td>
          <td>6:1 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>92</td>
          <td>17.07.2019 17:30</td>
          <td>H</td>
          <td>Petzold Bernd</td>
          <td>Riede Ronald</td>
          <td>6:0 4:6 10:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>93</td>
          <td>17.07.2019 18:15</td>
          <td>D</td>
          <td>Fuchs Lisa</td>
          <td>Traub Moni</td>
          <td>3:6 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>94</td>
          <td>17.07.2019 18:30</td>
          <td>H</td>
          <td>Mischke Sascha</td>
          <td>Maier Norbert</td>
          <td>6:1 3:6 10:8</td>
        </tr>
        <tr style="height:1.3rem">
          <td>95</td>
          <td>19.07.2019 15:00</td>
          <td>F</td>
          <td>Vollrath Benjamin</td>
          <td>Schmidt Hermine</td>
          <td>6:1 7:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>96</td>
          <td>19.07.2019 18:00</td>
          <td>F</td>
          <td>Ulrich Wolfgang</td>
          <td>Schmidt David</td>
          <td>5:7, 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>97</td>
          <td>19.07.2019 18:00</td>
          <td>F</td>
          <td>Leihenseder Hartmut</td>
          <td>Eder Thomas</td>
          <td>6:0, 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>98</td>
          <td>20.07.2019 10:30</td>
          <td>F</td>
          <td>Schmidt David</td>
          <td>Leihenseder Hartmut</td>
          <td>2:6, 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>99</td>
          <td>20.07.2019 18:00</td>
          <td>H</td>
          <td>Laszlo Beny</td>
          <td>Kuestner Ralf</td>
          <td>2:6 0:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>100</td>
          <td>21.07.2019 11:00</td>
          <td>F</td>
          <td>Vollrath Benjamin</td>
          <td>Rieber Johannes</td>
          <td>4:6, 6:1, 10:7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>101</td>
          <td>21.07.2019 18:00</td>
          <td>D</td>
          <td>Haberzettl Elena</td>
          <td>Huber Anja</td>
          <td>3:6, 6:7 (5:7)</td>
        </tr>
        <tr style="height:1.3rem">
          <td>102</td>
          <td>23.07.2019 19:00</td>
          <td>H</td>
          <td>Vogt Klaus</td>
          <td>Schek Thomas</td>
          <td>3:6 2:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>103</td>
          <td>24.07.2019 09:00</td>
          <td>F</td>
          <td>Leihenseder Hartmut</td>
          <td>Heydenaber Thomas von</td>
          <td>6:2, 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>104</td>
          <td>24.07.2019 19:00</td>
          <td>H</td>
          <td>Krätzschmar Florian</td>
          <td>Maier Norbert</td>
          <td>5:7 7:6 10:4</td>
        </tr>
        <tr style="height:1.3rem">
          <td>105</td>
          <td>24.07.2019 19:00</td>
          <td>H</td>
          <td>Juricev Luka</td>
          <td>Goettling Stefan</td>
          <td>6:1 6:1</td>
        </tr>
        <tr style="height:1.3rem">
          <td>106</td>
          <td>26.07.2019 18:00</td>
          <td>H</td>
          <td>Streif Robert</td>
          <td>Tesche Holger</td>
          <td>7:6 1:6 10;7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>107</td>
          <td>26.07.2019 18:00</td>
          <td>F</td>
          <td>May Matthias</td>
          <td>Hämmerl Sebastian</td>
          <td>7:5 4:6 3:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>108</td>
          <td>27.07.2019 10:30</td>
          <td>H</td>
          <td>Petzold Bernd</td>
          <td>Soueiha Markus</td>
          <td>0:6,3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>109</td>
          <td>27.07.2019 10:30</td>
          <td>D</td>
          <td>Rohde-Kammers Petra</td>
          <td>Göttling Britta</td>
          <td>0:6. 6:4. 4:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>110</td>
          <td>27.07.2019 14:00</td>
          <td>F</td>
          <td>Mitterer Hermann</td>
          <td>Vollrath Benjamin</td>
          <td>6:1, 6:0</td>
        </tr>
        <tr style="height:1.3rem">
          <td>111</td>
          <td>30.07.2019 18:15</td>
          <td>H</td>
          <td>Streif Robert</td>
          <td>Mischke Sascha</td>
          <td>6:3 4:6 7:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>112</td>
          <td>01.08.2019 18:00</td>
          <td>F</td>
          <td>Mitterer Hermann</td>
          <td>May Matthias</td>
          <td>4:6, 6:4, 10:8</td>
        </tr>
        <tr style="height:1.3rem">
          <td>113</td>
          <td>02.08.2019 18:00</td>
          <td>H</td>
          <td>Soueiha Markus</td>
          <td>Krätzschmar Florian</td>
          <td>3:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>114</td>
          <td>06.08.2019 17:45</td>
          <td>H</td>
          <td>Krätzschmar Florian</td>
          <td>Vogt Klaus</td>
          <td>5:7, 7:5, 4:9 (wo) Vogt</td>
        </tr>
        <tr style="height:1.3rem">
          <td>115</td>
          <td>13.08.2019 18:00</td>
          <td>H</td>
          <td>Juricev Luka</td>
          <td>Mülleneisen Marcus</td>
          <td>1:6,6:2,4:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>116</td>
          <td>17.08.2019 17:00</td>
          <td>H</td>
          <td>Mülleneisen Marcus</td>
          <td>Tristl Markus</td>
          <td>2:6, 6:3, 5:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>117</td>
          <td>18.08.2019 10:00</td>
          <td>D</td>
          <td>Fuchs Lisa</td>
          <td>Huber Anja</td>
          <td>6:3 6:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>118</td>
          <td>21.08.2019 18:00</td>
          <td>H</td>
          <td>Mischke Sascha</td>
          <td>Schek Thomas</td>
          <td>4:6 5:7</td>
        </tr>
        <tr style="height:1.3rem">
          <td>119</td>
          <td>04.09.2019 18:00</td>
          <td>D</td>
          <td>Fuchs Lisa</td>
          <td>Göttling Britta</td>
          <td>7:5 2:6 10:3</td>
        </tr>
        <tr style="height:1.3rem">
          <td>120</td>
          <td>11.09.2019 17:30</td>
          <td>D</td>
          <td>Streif Petra</td>
          <td>Traub Moni</td>
          <td>6:1, 7:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>121</td>
          <td>13.09.2019 17:00</td>
          <td>H</td>
          <td>Streif Robert</td>
          <td>Krätzschmar Florian</td>
          <td>6:1, 2:6, 7:10</td>
        </tr>
        <tr style="height:1.3rem">
          <td>122</td>
          <td>13.09.2019 18:00</td>
          <td>F</td>
          <td>Hämmerl Sebastian</td>
          <td>Krause Sven</td>
          <td>1:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>123</td>
          <td>14.09.2019 11:00</td>
          <td>F</td>
          <td>Mitterer Hermann</td>
          <td>Leihenseder Hartmut</td>
          <td>4:6, 4:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>124</td>
          <td>14.09.2019 15:30</td>
          <td>D</td>
          <td>Streif Petra</td>
          <td>Fuchs Lisa</td>
          <td>6:4, 6:2</td>
        </tr>
        <tr style="height:1.3rem">
          <td>125</td>
          <td>21.09.2019 11:30</td>
          <td>F</td>
          <td>Leihenseder Hartmut</td>
          <td>Krause Sven</td>
          <td>4:6 6:4 10:5</td>
        </tr>
        <tr style="height:1.3rem">
          <td>126</td>
          <td>21.09.2019 11:30</td>
          <td>F</td>
          <td>Mitterer Hermann</td>
          <td>Hämmerl Sebastian</td>
          <td>5:7 3:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>127</td>
          <td>21.09.2019 13:30</td>
          <td>H</td>
          <td>Krätzschmar Florian</td>
          <td>Schek Thomas</td>
          <td>0:6 1:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>128</td>
          <td>21.09.2019 13:30</td>
          <td>D</td>
          <td>Göttling Britta</td>
          <td>Traub Moni</td>
          <td>6:4 7:6</td>
        </tr>
        <tr style="height:1.3rem">
          <td>129</td>
          <td>02.12.2019 10:00</td>
          <td>D</td>
          <td>Tristl Andrea</td>
          <td>Simon Andreas</td>
          <td></td>
        </tr>
        <tr style="height:1.3rem">
          <td>130</td>
          <td>05.01.2020 08:00</td>
          <td>H</td>
          <td>Röhlk Andreas</td>
          <td>Simon Andreas</td>
          <td></td>
        </tr>
      </table>

  </article>
</div>
<?php 
include("../../templates/footer.inc.php")
?>

