<?php
/**
 * Blackthorn php framework
 *
 * Blackthorn path helper class
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

class Path
{
    /**
     * isBaseUrl function.
     *
     * @access public
     * @return string
     */
    public function isBaseUrl()
    {
        return Config::BASE_URL;
    }

    /**
     * getUrlPath function.
     *
     * @access public
     * @return string
     */
    public function getUrlPath()
    {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        $path = preg_replace(Config::ALLOWED_URI_CHAR, "", $path);

        if (strpos($path, $this->isBaseUrl()) !== false) {
            $path = substr($path, strlen($this->isBaseUrl()) + 1);
        }
        
        return $path;
    }

    /**
     * getUrlHost function.
     *
     * @access public
     * @return string
     */
    public function getUrlHost()
    {
        $host =  'http://' . $_SERVER['HTTP_HOST'];
        
        if (Config::BASE_URL != '' and Config::BASE_URL != '/' and Config::BASE_URL != null) {
            return $host . '/' . Config::BASE_URL;
        } else {
            return $host;
        }
    }

    /**
     * isUserLocalhost function.
     *
     * @access public
     * @return bool
     */
    public function isUserLocalhost()
    {
        return in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', "::1"));
    }

    /**
     * getSmartyCachePath function.
     *
     * @access public
     * @return string
     */
    public function getSmartyCachePath()
    {
        return APPPATH . '/Cache/';
    }

    /**
     * getSmartyTemplatePath function.
     *
     * @access public
     * @return string
     */
    public function getSmartyTemplatePath()
    {
        return APPPATH . Config::TEMPLATE_PATH;
    }
}