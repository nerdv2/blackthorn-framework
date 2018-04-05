<?php
/**
 * Blackthorn php framework
 *
 * Blackthorn database connectivity class
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

class Database
{
    private static $_instance; //The single instance
    private $_pdoconnection;

    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $host        = Config::DB_HOST;
        $dbname      = Config::DB_NAME;
        $pdo_user    = Config::DB_USER;
        $pdo_pass    = Config::DB_PASS;
        $charset     = 'utf8';

        $pdo_dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $pdo_opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->_pdoconnection = new \PDO($pdo_dsn, $pdo_user, $pdo_pass, $pdo_opt);
    }

    public function getConnection()
    {
        return $this->_pdoconnection;
    }
}