<?php

include_once(BASE_PATH . "intern/inc/password.inc.php");

//
// Checkt, ob der User eingeloggt ist und gibt die User-Daten zurück oder macht einen Redirect zur Login-Page
//

// Check if the user is logged in and return user data or redirect to the login page
function check_user() {
  $user = check_user_silent();
  if (!$user) {
      // Redirect to login page
      $targetPage = 'Location: ' . HOSTNAME . '/intern/login.php';
      header($targetPage);
      exit; // Important in case the browser does not redirect
  } else {
      return $user;
  }
}

// Check if the user is logged in and return user data or false
function check_user_silent() {
  global $pdo;

  // Set server time cookie
  setcookie("servertime", time() * 1000, time() + (3600 * 24 * 365), "/intern/"); // Valid for 1 year

  // Check if session is started
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

  // Check if user is already logged in
  if (!isset($_SESSION['userid']) && isset($_COOKIE['identifier']) && isset($_COOKIE['securitytoken'])) {
      $identifier = $_COOKIE['identifier'];
      $securitytoken = $_COOKIE['securitytoken'];

      $statement = $pdo->prepare("SELECT * FROM securitytokens WHERE identifier = ?");
      $statement->execute([$identifier]);
      $securitytoken_row = $statement->fetch();

      if (!$securitytoken_row || sha1($securitytoken) !== $securitytoken_row['securitytoken']) {
          error_log("Sicherheits-Token ungültig oder gestohlen");
          return false;
      }

      // Set new token
      $neuer_securitytoken = random_string();
      $insert = $pdo->prepare("UPDATE securitytokens SET securitytoken = :securitytoken WHERE identifier = :identifier");
      $insert->execute(['securitytoken' => sha1($neuer_securitytoken), 'identifier' => $identifier]);
      setcookie("identifier", $identifier, time() + (3600 * 24 * 365), "/intern/"); // 1 year validity
      setcookie("securitytoken", $neuer_securitytoken, time() + (3600 * 24 * 365), "/intern/"); // 1 year validity

      // Log in user
      $_SESSION['userid'] = $securitytoken_row['user_id'];
  }

  if (!isset($_SESSION['userid'])) {
      error_log("Benutzer nicht eingeloggt");
      if (!empty($_SERVER['REQUEST_URI'])) {
          $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
      }
      return false;
  }

  // Retrieve user data
  $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id AND NOT (status = 'D' OR status = 'W' OR status = 'X')");
  $statement->execute(['id' => $_SESSION['userid']]);
  $user = $statement->fetch();

  if (!$user) {
      error_log("Benutzer nicht gefunden oder deaktiviert");
      return false;
  }

  // Retrieve permissions
  $statement = $pdo->prepare("SELECT * FROM permissions WHERE user_id = :user_id");
  $statement->execute(['user_id' => $_SESSION['userid']]);
  $permissions = $statement->fetch();

  $_SESSION['permissions'] = $permissions ? $permissions['permissions'] : 0;

  return $user;
}

/**
 * Returns true when the user is checked in, else false
 */
function is_checked_in() {
  return isset($_SESSION['userid']);
}

/**
 * Returns a random string
 */
function random_string() 
{
  if (function_exists('openssl_random_pseudo_bytes')) 
  {
    $bytes = openssl_random_pseudo_bytes(16);
		$str = bin2hex($bytes); 
  } 
  else 
  {
    //Replace your_secret_string with a string of your choice (>12 characters)
		$str = md5(uniqid('jfkfofd#dfoiriPkJhh', true));
	}	
	return $str;
}

/**
 * Returns the URL to the site without the script name
 */
function getSiteURL() {
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/';
}

/**
 * Outputs an error message and stops the further exectution of the script.
 */
function error($error_msg) {
  include(BASE_PATH . "intern/inc/header.inc.php");
	include(BASE_PATH . "intern/inc/error.inc.php");
	include(BASE_PATH . "intern/inc/footer.inc.php");
	exit();
}
function endsWith($haystack, $needle)
{
  $length = strlen($needle);
  if ($length == 0) {
    return true;
  }
  
  return (substr($haystack, -$length) === $needle);
}
// function console_log( $data ) {
  //   echo '<script>';
  //   echo 'console.log('. json_encode( $data ) .')';
  //   echo '</script>';
// }

function TLOG($level, $msg, $line)
{
  if ($level <= SHOWLOGS) {
    $page = basename($_SERVER['PHP_SELF']);
    error_log("[$page, $line]: $msg");
  }
}

function TECHO($level, $msg)
{
  if ($level <= SHOWLOGS) {
    $page = basename($_SERVER['PHP_SELF']);
    echo("<code class=\"text-dark\">\r\n[$page]: $msg</code>");
  }
}

function getFilename($fullpath) {

  $delim = '/';
  if (strpos($fullpath, '\\') !== false) {
    $delim = '\\';
  }

  $a = explode($delim, $fullpath);
  $a = array_pop($a);
  $f = explode('.', $a);

  return ($f[0]);
}

function handleWirtStatus($file) {
  if (!file_exists($file)) return ['geschlossen', 'hidden', 'Öffnen', 'hidden', 'Deaktiviert', 'Aktivieren'];

  $line = trim(file_get_contents($file));
  $status = substr($line, 0, 1);
  $activeStatus = substr($line, 1, 1);
  $statusDate = substr($line, 2, 8);

  // Handle POST request to update status
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
      if (isset($_POST['SWT'])) {
          $status = abs($status - 1); // Toggle status
          $statusDate = date("d.m.y");
      } else if (isset($_POST['SWS'])) {
          $activeStatus = abs($activeStatus - 1); // Toggle active status
          $statusDate = date("d.m.y");
      }

      // Update the file with new status
      file_put_contents($file, $status . $activeStatus . $statusDate);

      // Regenerate CSRF token
      unset($_SESSION['token']);
      $_SESSION['token'] = bin2hex(random_bytes(32));
  }

  // Determine button classes and text based on status
  $statusClass = ($status && $statusDate == date("d.m.y")) ? "btn-danger" : "btn-success";
  $statusClass .= " rounded  border-start-0 kachel-btn-sm";
  $statusText1 = ($status && $statusDate == date("d.m.y")) ? "Geöffnet" : "Geschlossen";
  $statusText2 = ($status && $statusDate == date("d.m.y")) ? "Schließe" : "Öffne";
  $activeClass = ($activeStatus) ? "btn-secondary" : "btn-dark";
  $activeClass .= " rounded  border-start-0 kachel-btn-sm";
  $activeText1 = ($activeStatus) ? "Aktiv" : "Deaktiviert";
  $activeText2 = ($activeStatus) ? "Deaktiviere" : "Aktiviere";

  return [$statusText1, $statusClass, $statusText2, $activeClass, $activeText1, $activeText2];
}
function generate_csrf_token() {
  if (empty($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['token'];
}

function validate_csrf_token($token) {
  return hash_equals($_SESSION['token'], $token);
}

function uploadProfilePic($userId, $croppedImageData, $pdo) {
  // Entferne den Base64-Header
  list($type, $croppedImageData) = explode(';', $croppedImageData);
  if (strpos($croppedImageData, ',') !== false) {
      list(, $croppedImageData) = explode(',', $croppedImageData);
  } else {
      return "Ungültiges Bildformat. Das Bild konnte nicht verarbeitet werden.";
  }

  // Definiere einen Dateinamen für das neue Bild
  $newFileName = uniqid('profile_', true) . '.jpg';
  $uploadFileDir = './uploads/profile_pics/';

  // Überprüfen, ob das Verzeichnis existiert, wenn nicht, erstellen
  if (!is_dir($uploadFileDir)) {
      mkdir($uploadFileDir, 0755, true);  // Verzeichnis erstellen
  }

  $dest_path = $uploadFileDir . $newFileName;

  // Zuerst das alte Profilbild aus der Datenbank holen
  $stmt = $pdo->prepare("SELECT profile_pic FROM users WHERE id = :userid");
  $stmt->bindValue(':userid', $userId, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  // Überprüfen, ob es ein altes Profilbild gibt und es löschen
  if (!empty($result['profile_pic'])) {
      $oldFilePath = $uploadFileDir . $result['profile_pic'];
      if (file_exists($oldFilePath)) {
          unlink($oldFilePath);  // Altes Bild löschen
      }
  }

  // Speicher das neue Bild
  $croppedImageData = base64_decode($croppedImageData);
  if (file_put_contents($dest_path, $croppedImageData)) {
      // Optional: Bildgröße anpassen
      resizeImage($dest_path, 150, 150);

      // Bildpfad in die Datenbank speichern
      $stmt = $pdo->prepare("UPDATE users SET profile_pic = :profile_pic WHERE id = :userid");
      $stmt->bindValue(':profile_pic', $newFileName, PDO::PARAM_STR);
      $stmt->bindValue(':userid', $userId, PDO::PARAM_INT);

      if ($stmt->execute()) {
          return "Profilbild erfolgreich hochgeladen.";
      } else {
          return "Fehler beim Speichern des Profilbilds in der Datenbank.";
      }
  } else {
      return "Fehler beim Speichern des Bildes.";
  }
}

function resizeImage($file, $width, $height) {
  list($orig_width, $orig_height) = getimagesize($file);
  $image_p = imagecreatetruecolor($width, $height);
  $image = imagecreatefromjpeg($file);
  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
  imagejpeg($image_p, $file, 90);  // Qualität auf 90 setzen
}

function getProfilePicPath($userId, $pdo) {
  $stmt = $pdo->prepare("SELECT profile_pic FROM users WHERE id = :userid");
  $stmt->bindValue(':userid', $userId, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!empty($result['profile_pic'])) {
      return './uploads/profile_pics/' . $result['profile_pic'];
  } else {
      return '/intern/images/user.png';  // Standardbild
  }
}
