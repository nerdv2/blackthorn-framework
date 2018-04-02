<?php
/**
 * Blackthorn php framework
 *
 * Blackthorn bootstrap file
 *
 * @category  Apps
 * @package   Blackthorn
 * @author    Gema Aji Wardian <gema_wardian@hotmail.com>
 * @copyright 2018 Gema Aji Wardian
 * @version   0.1-alpha
 * @since     File available since 0.1-alpha
 */

namespace Blackthorn;

use Blackthorn\Config\Config;
use Blackthorn\Core\Path;
use Blackthorn\Functions\Db;
use \Smarty as Smarty;

class Blackthorn
{
    /**
     * Main application construct.
     *
     * All required class and action are defined here.
     */
    public function __construct()
    {
        // check application environment
        if (Config::DEV_MODE) {
            error_reporting(-1);
		    ini_set('display_errors', 1);
        } else {
            ini_set('display_errors', 0);
            if (version_compare(PHP_VERSION, '5.3', '>='))
            {
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
            }
            else
            {
                error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
            }
        }

        // check session management
        if (!isset($_SESSION)) {
            session_name(Config::COOKIE_NAME);
            session_start([
                'cookie_lifetime' => Config::COOKIE_LIFETIME,
                'cookie_httponly' => Config::COOKIE_HTTPONLY,
                'cookie_secure' => Config::COOKIE_SECURE
            ]);
        }
        
        $this->path                  = new Path();
        $this->db                    = new Db();

        $this->smarty                = new Smarty();
        $this->smarty->compile_dir   = $this->path->getSmartyCachePath();
        $this->smarty->template_dir  = $this->path->getSmartyTemplatePath();
        $this->smarty->assign("fulldomain", $this->path->getUrlHost());
    }

    /**
     * This define where application uses controller class from url.
     *
     * @return void
     */
    public function appOverride()
    {
        @list($controller, $action, $params) = explode("/", $this->path->getUrlPath());

        if ($controller == '') {
            $controller = Config::DEFAULT_CONTROLLER;
        }

        if ($action == '') {
            $action = Config::DEFAULT_ACTION;
        }

        $fullController = '\Blackthorn\Controller\\' . ucfirst($controller).Config::CONTROLLER_SUFFIX;
        
        call_user_func_array(array(new $fullController, $action), array());
    }
}
