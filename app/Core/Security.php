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
}