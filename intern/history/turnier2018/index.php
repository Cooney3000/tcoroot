<?php
session_start();
require_once("../../inc/config.inc.php");
require_once("../../inc/functions.inc.php");
require_once("../../inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Intern Historie Turnier 2018";
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

<h1>Das Turnier 2018</h1>

  <p class="h3">Organisatoren: Norbert Maier, Conny Roloff</p>
  
  <p class="h3">Ergebnisse</p>
  <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2018/images/01_niko_rieber.png" alt="" /></div>
  <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2018/images/02_sascha_mischke.png" alt="" /></div>
  <div class="my-3"><img class="img-fluid" src="/intern/history/turnier2018/images/03_robert_streif.png" alt="" /></div>

  <table class="tables">
  <tr><th>Platz</td><th>Spieler</th></tr>
		<tr><td>1.	</td><td>Rieber, Nikolaus		</td></tr>
		<tr><td>2.	</td><td>Mischke, Sascha        </td></tr>
		<tr><td>3.	</td><td>Streif, Robert         </td></tr>
		<tr><td>4.	</td><td>Schreyer, Christian    </td></tr>
		<tr><td>5.	</td><td>Hertle, Andreas        </td></tr>
		<tr><td>	</td><td>Tristl, Markus         </td></tr>
		<tr><td>7.	</td><td>Küstner, Ralf          </td></tr>
		<tr><td>	</td><td>Maier, Norbert         </td></tr>
		<tr><td>9.	</td><td>Hermann, Jochen        </td></tr>
		<tr><td>	</td><td>Juricev, Luka          </td></tr>
		<tr><td>	</td><td>Krätzschmar, Florian   </td></tr>
		<tr><td>	</td><td>Streif, Rico           </td></tr>
		<tr><td>13.	</td><td>Godenrath, Jürgen      </td></tr>
		<tr><td>	</td><td>Mülleneisen, Marcus    </td></tr>
		<tr><td>	</td><td>Soueiha, Markus        </td></tr>
		<tr><td>	</td><td>Tesche, Heiko          </td></tr>
		<tr><td>17.	</td><td>Göttling, Stefan       </td></tr>
		<tr><td>	</td><td>Küstner, Tim           </td></tr>
		<tr><td>	</td><td>Mitterer, Hermann      </td></tr>
		<tr><td>	</td><td>Petzold, Bernd         </td></tr>
		<tr><td>	</td><td>Riede, Ronald          </td></tr>
		<tr><td>	</td><td>Röhlk, Andreas         </td></tr>
		<tr><td>	</td><td>Roloff, Conny          </td></tr>
		<tr><td>	</td><td>Schmid, Wolfgang       </td></tr>
		<tr><td>25.	</td><td>Amann, Elias           </td></tr>
		<tr><td>	</td><td>Gallert, Peter         </td></tr>
		<tr><td>	</td><td>Hochholzer, Nico       </td></tr>
		<tr><td>	</td><td>Ochsenmeier, Peter     </td></tr>
		<tr><td>	</td><td>Sachse, Michael        </td></tr>
		<tr><td>	</td><td>Sagasser, Thomas       </td></tr>
		<tr><td>	</td><td>Schmidt, Peter         </td></tr>  
  </table>

  

</article>
</div> <!-- container -->
<?php 
include("../../templates/footer.inc.php")
?>

