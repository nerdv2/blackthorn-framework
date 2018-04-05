<?php
/**
 * Blackthorn php framework
 *
 * Blackthorn security class
 *
 * @category  Apps
 * @package   Blackthorn
 * @author    Gema Aji Wardian <gema_wardian@hotmail.com>
 * @copyright 2018 Gema Aji Wardian
 * @license   MIT
 * @license   https://opensource.org/licenses/MIT
 * @version   0.1-alpha
 * @since     File available since 0.1-alpha
 */

namespace Blackthorn\Core;

use Blackthorn\Config\Config;

class Security
{
    /**
     * hashPassword function.
     *
     * @access public
     * @param mixed $password
     * @return string|bool could be a string on success, or bool false on failure
     */
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * verifyPassword function.
     *
     * @access public
     * @param mixed $password
     * @param mixed $hash
     * @return bool
     */
    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * sanitizeFilename function.
     *
     * @access public
     * @param mixed $string
     * @return string
     */
    public function sanitizeFilename($string)
    {
        $filter_list = array(
            '../',
            './',
            '/'
        );

        $string = str_replace($filter_list, '', $string);
        return stripslashes($string);
    }

    /**
     * generateRandom function.
     *
     * @access public
     * @param int $length
     * @return string
     */
    public function generateRandom($length)
    {
        if (function_exists('random_bytes')) {
            return bin2hex(random_bytes($length));
        }

        if (function_exists('mcrypt_create_iv')) {
            return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
        }

        if (function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
    }
}