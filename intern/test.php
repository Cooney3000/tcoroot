<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
// error_log (join(" # ", $user));

$title = "Intern - Aktionen";
include("templates/header.inc.php");
?>

<h1>Platzbelegungen</h1>
    
<script>

  let hostLocal = true
  const config = {
  testuser: {id:211, vorname:'Hart', nachname:'VerdrahtetAdm', permissions: 65535}, // mit Adminrechten
  // testuser: {id:211, vorname:'Hart', nachname:'VerdrahtetUsr', permissions: 0}, // mit normalen Benutzerrechten
  // testuser: {id:357, vorname:'Hart', nachname:'VerdrahtetUsr2', permissions: 432}, // mit normalen Benutzerrechten
  stringSeparator: ' ',
  smartphoneWidth: 578,
  anzahlPlaetze: 6,
  platzArray: [],
  daypickerMaxDays: 180,
  daypickerDaysBeforeToday: 3, 
  daypickerDaysBeforeTodayWide: 9, 
  buchungenlog: '/intern/api/buchungenlog.php',
  platzbuchungen: '/intern/api/platz.php',

  dailyStartTime: 8,
  dailyEndTime: 20,
  eveningTime: 1700,  // 17:00 Uhr, alte Platzordnung war 18:00 Uhr
  maxMinutesDistance: 15, // Gäste und Jugendliche dürfen abends erst kurz vor der Spielzeit buchen
  singleTime: 60, // = 1 Stunde
  doubleTime: 120, // = 2 Stunden 
  turnierTime: 120, // = 2 Stunden 
  gastId: 1,
  mitgliedId: 25,
}
if (hostLocal) {
  config.hostname = 'localhost'
  config.protokoll = 'http://'
  config.loginPage = '/intern/login.php'
  config.prod = false
} else {    
  config.hostname = 'www.tcolching.de'
  config.protokoll = 'https://'
  config.loginPage = '/intern/login.php'
  config.prod = true
}



  // Alle Belegungen des Tages für die Belegungsprüfung laden    
  url = config.protokoll + config.hostname + "/intern/api/belegungenabjetzt.php";
  fetch(url, { credentials: 'same-origin' })
    .then(result => {
      if (result.ok) {
        // console.log(result);
        return result.json();
      } else {
        throw new Error('Fehler beim Laden der Belegungsdaten');
      }
    })
    .then(result => {
      console.log("getSelectFill: ", getSelectFill(result.records));
    })


  const getSelectFill = (belegungen) => {
    // console.log(belegungen) 

    // Erzeuge alle Zeiten als Timestamps für den HTML-Select in einem zweidimensionalen Objekt
    // mit Uhrzeiten im Viertelstunden-Takt
    // in der Form {<uhrzeit> : {platz: <platz>, <aktiv|inaktiv>}}
    let zeit = new Date()
    let endeTag = new Date()
    
    // TESTDATEN ***************************************************
    zeit = new Date(2020, 4, 22)
    endeTag = new Date(2020, 4, 22)
    
    zeit.setHours(8,0,0,0)
    endeTag.setHours(21,0,0,0)
    const timetable = {}
    for ( ; 
         zeit <= endeTag; 
         zeit = new Date(zeit.getTime() + 900000) ) // 900000 Millisekunden sind 15 Minuten
    {
        timetable[zeit] = []
        for(let i = 0; i<config.anzahlPlaetze; i++) 
        {
          timetable[zeit].push(true)
        }
    }
    
    //TEST###############
    // for (k in timetable){timetable[k][0] = false}
    // console.log(timetable)

    // Wir haben 2 Objekte: 
    // 1. Wir iterieren über die Belegungen, sortiert nach Anfangszeit und Platz. 
    // 2. timetable, auf das wir direkt über die Zeit zugreifen

    // console.log(belegungen)
    const viertelMs = 15*1000*60 // eine Viertelstunde in Millisekunden
    for(let bKey in belegungen) 
    {
      let sa = new Date(belegungen[bKey].starts_at)
      let ea = new Date(belegungen[bKey].ends_at)

      let anzahlViertel = (ea - sa)/viertelMs
      for (let i = 0; i < anzahlViertel; i++) 
      {
        let saTmp = new Date(sa.getTime() + (i * viertelMs))
        let cTmp = Number(belegungen[bKey].court) - 1
        timetable[saTmp][cTmp] = false
        console.log(saTmp, timetable[saTmp][cTmp], ', court: ', cTmp)
      }
      

      // console.log("Starts: ", sa, " Ende: ", ea, " Dauer: ", anzahlViertel, " Timetable: ", timetable[sa])
    }
    return timetable
  }
</script>

