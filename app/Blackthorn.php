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
 * @license   MIT
 * @license   https://opensource.org/licenses/MIT
 * @version   0.1-alpha
 * @since     File available since 0.1-alpha
 */

namespace Blackthorn;

use Blackthorn\Config\Config;
use Blackthorn\Core\Path;
use Blackthorn\Core\Security;
use Blackthorn\Core\Input;
use Blackthorn\Functions\Db;
use \Smarty as Smarty;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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
        $this->initializeEnvironment();

        // check session management
        $this->initializeSession();
        
        // initialize built-in helper
        $this->path                  = new Path();
        $this->db                    = new Db();
        $this->security              = new Security();
        $this->input                 = new Input();
        
        // initialize smarty
        $this->smarty                = new Smarty();
        $this->smarty->compile_dir   = $this->path->getSmartyCachePath();
        $this->smarty->template_dir  = $this->path->getSmartyTemplatePath();
        $this->smarty->assign("fulldomain", $this->path->getUrlHost());
        $this->smarty->escape_html   = Config::SMARTY_ESCAPE_HTML;
        if(Config::SMARTY_SECURE_MODE)
        {
            $this->smarty->enableSecurity();
        }

        // initialize monolog
        $log_fileformat              = Config::LOG_FILEFORMAT;
        
        if (Config::LOG_FILEWITHDATE) {
            $log_fileformat          = date(Config::LOG_FILEDATEFORMAT).Config::LOG_FILEFORMAT;
        }
        
        $log_folder                  = Config::LOG_FOLDER.$log_fileformat;
        $log                         = new Logger(Config::LOG_NAME);
        $log->pushHandler(new StreamHandler($log_folder));

        $this->log                   = $log;

        // url path management
        $path = explode('/', $this->path->getUrlPath());

        foreach ($path as $key => $value)
        {
            if($key === 0) {
                $this->smarty->assign("canal", $value);
                $this->canal         = $value;
            } 
            if($key === 1) {
                $this->smarty->assign("action", $value);
                $this->action        = $value;
            }

            $this->smarty->assign("pathlevel".$key, $value);
            $this->{'pathlevel'.$key}    = $value;

        }
    }

    private function initializeEnvironment()
    {
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
    }

    private function initializeSession()
    {
        if (!isset($_SESSION)) {
            session_name(Config::COOKIE_NAME);
            session_start([
                'cookie_lifetime' => Config::COOKIE_LIFETIME,
                'cookie_httponly' => Config::COOKIE_HTTPONLY,
                'cookie_secure' => Config::COOKIE_SECURE
            ]);
        }
    }

    /**
     * This define where application uses controller class from url.
     *
     * @return void
     */
    public function appOverride()
    {
        @list($controller, $action) = explode("/", $this->path->getUrlPath());

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
