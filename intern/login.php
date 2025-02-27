<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

$error_msg = "";

// Function to handle login
function handle_login($pdo, $email, $passwort) {
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email AND NOT (status = 'D')");
    $statement->execute(['email' => $email]);
    return $statement->fetch();
}

// Function to set session and cookies
function set_user_session_and_cookies($user, $pdo) {
    $_SESSION['userid'] = $user['id'];
    $_SESSION['permissions'] = get_user_permissions($pdo, $user['id']);
    
    if (isset($_POST['angemeldet_bleiben'])) {
        set_login_cookies($user['id'], $pdo);
    }
}

// Function to get user permissions
function get_user_permissions($pdo, $user_id) {
    $statement = $pdo->prepare("SELECT * FROM permissions WHERE user_id = :user_id");
    $statement->execute(['user_id' => $user_id]);
    $permissions = $statement->fetch();
    return $permissions ? $permissions['permissions'] : 0;
}

// Function to set login cookies
function set_login_cookies($user_id, $pdo) {
    $identifier = random_string();
    $securitytoken = random_string();
    $insert = $pdo->prepare("INSERT INTO securitytokens (user_id, identifier, securitytoken) VALUES (:user_id, :identifier, :securitytoken)");
    $insert->execute([
        'user_id' => $user_id,
        'identifier' => $identifier,
        'securitytoken' => sha1($securitytoken)
    ]);
    setcookie("identifier", $identifier, time() + (3600 * 24 * 365), "/intern/", "", true, true); // Secure and HTTPOnly
    setcookie("securitytoken", $securitytoken, time() + (3600 * 24 * 365), "/intern/", "", true, true); // Secure and HTTPOnly
}

if (isset($_POST['email']) && isset($_POST['passwort'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $passwort = $_POST['passwort'];
    //TLOG(DEBUG, "User: $email Passwort: $passwort", __LINE__);
    $user = handle_login($pdo, $email, $passwort);

    if ($user && password_verify($passwort, $user['passwort'])) {
        TLOG(DEBUG, "User $email verifiziert", __LINE__);
        session_regenerate_id(true); // Prevent session fixation
        set_user_session_and_cookies($user, $pdo);

        if ($user['status'] == 'W') {
            $error_msg = "Dein Account ist noch nicht aktiviert. Schreibe bitte eine Mail an webmaster@tcolching.de, falls das schon länger so ist.";
        } else {
            $redirect_to = isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : 'internal.php';
            unset($_SESSION['redirect_to']);
            header("Location: $redirect_to");
            exit;
        }
    } else {
        $error_msg = "E-Mail oder Passwort war ungültig";
    }
}

$email_value = isset($_POST['email']) ? htmlentities($_POST['email']) : "";

$title = "Login";
include("inc/loginheader.inc.php");
?>

<div class="container small-container-330 form-signin">
    <form action="login.php" method="post">
        <h2 class="form-signin-heading">Login mit E-Mail-Adresse und Passwort</h2>

        <?php if (!empty($error_msg)) : ?>
            <div class="h5 mb-4 text-danger"><?= $error_msg ?></div>
        <?php endif; ?>

        <label for="inputEmail" class="sr-only">E-Mail</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-Mail" value="<?= $email_value ?>" required autofocus>
        <label for="inputPassword" class="sr-only">Passwort</label>
        <input type="password" name="passwort" id="inputPassword" class="form-control" placeholder="Passwort" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="angemeldet_bleiben" value="1" checked> Angemeldet bleiben (außer, du machst einen Logout)
            </label>
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
        <br>
        <p class="h5 my-2">Passwort vergessen? Setze dein Passwort selbst zurück: <a href="pwvergessen.php">Passwort zurücksetzen</a></p>
    </form>
    <p class="h5 my-2">Noch nicht registriert? <a href="register.php">Zur Registrierung</a></p>
</div>

<?php include("inc/footer.inc.php"); ?>
