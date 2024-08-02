<?php
/**
 * A Compatibility library with PHP 5.5's simplified password hashing API.
 *
 * @author Anthony Ferrara <ircmaxell@php.net>
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright 2012 The Authors
 */

if (!defined('PASSWORD_BCRYPT')) {
    define('PASSWORD_BCRYPT', 1);
    define('PASSWORD_DEFAULT', PASSWORD_BCRYPT);
    define('PASSWORD_BCRYPT_DEFAULT_COST', 10);
}

if (!function_exists('password_hash')) {
    /**
     * Hash the password using the specified algorithm
     *
     * @param string $password The password to hash
     * @param int    $algo     The algorithm to use (Defined by PASSWORD_* constants)
     * @param array  $options  The options for the algorithm to use
     *
     * @return string|false The hashed password, or false on error.
     */
    function password_hash($password, $algo, array $options = array()) {
        if (!function_exists('crypt')) {
            trigger_error("Crypt must be loaded for password_hash to function", E_USER_WARNING);
            return false;
        }
        if (!is_string($password)) {
            trigger_error("password_hash(): Password must be a string", E_USER_WARNING);
            return false;
        }
        if (!is_int($algo)) {
            trigger_error("password_hash() expects parameter 2 to be long, " . gettype($algo) . " given", E_USER_WARNING);
            return false;
        }
        $cost = $options['cost'] ?? PASSWORD_BCRYPT_DEFAULT_COST;
        if ($cost < 4 || $cost > 31) {
            trigger_error(sprintf("password_hash(): Invalid bcrypt cost parameter specified: %d", $cost), E_USER_WARNING);
            return false;
        }

        $hash_format = sprintf("$2y$%02d$", $cost);
        $salt = $options['salt'] ?? random_bytes(16);
        $salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);

        $hash = $hash_format . $salt;
        $ret = crypt($password, $hash);

        if (!is_string($ret) || strlen($ret) != 60) {
            return false;
        }

        return $ret;
    }

    /**
     * Get information about the password hash.
     *
     * @param string $hash The password hash to extract info from
     * @return array The array of information about the hash.
     */
    function password_get_info($hash) {
        $return = array(
            'algo' => 0,
            'algoName' => 'unknown',
            'options' => array(),
        );
        if (substr($hash, 0, 4) == '$2y$' && strlen($hash) == 60) {
            $return['algo'] = PASSWORD_BCRYPT;
            $return['algoName'] = 'bcrypt';
            list($cost) = sscanf($hash, "$2y$%d$");
            $return['options']['cost'] = $cost;
        }
        return $return;
    }

    /**
     * Determine if the password hash needs to be rehashed according to the options provided
     *
     * @param string $hash The hash to test
     * @param int    $algo The algorithm used for new password hashes
     * @param array  $options The options array passed to password_hash
     * @return boolean True if the password needs to be rehashed.
     */
    function password_needs_rehash($hash, $algo, array $options = array()) {
        $info = password_get_info($hash);
        if ($info['algo'] !== (int) $algo) {
            return true;
        }
        $cost = $options['cost'] ?? PASSWORD_BCRYPT_DEFAULT_COST;
        return $cost !== $info['options']['cost'];
    }

    /**
     * Verify a password against a hash using a timing attack resistant approach
     *
     * @param string $password The password to verify
     * @param string $hash The hash to verify against
     * @return boolean If the password matches the hash
     */
    function password_verify($password, $hash) {
        if (!function_exists('crypt')) {
            trigger_error("Crypt must be loaded for password_verify to function", E_USER_WARNING);
            return false;
        }
        $ret = crypt($password, $hash);
        if (!is_string($ret) || strlen($ret) != strlen($hash) || strlen($ret) <= 13) {
            return false;
        }

        return hash_equals($ret, $hash);
    }
}
?>
