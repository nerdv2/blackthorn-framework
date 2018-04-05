<?php
/**
 * Blackthorn php framework
 *
 * Blackthorn main configuration file
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

namespace Blackthorn\Config;

class Config
{
    // application environment configuration
    const DEV_MODE           = true;

    // url configuration
    const BASE_URL           = 'blackthorn-framework/public';

    // smarty configuration
    const TEMPLATE_PATH      = '/View/';

    // controller configuration
    const DEFAULT_CONTROLLER = 'main';
    const DEFAULT_ACTION     = 'index';
    const CONTROLLER_SUFFIX  = 'Controller';
    
    // mysql/mariadb database configuration
    const DB_HOST            = 'localhost';
    const DB_USER            = 'root';
    const DB_PASS            = '';
    const DB_NAME            = 'test';

    // session cookie configuration
    const COOKIE_NAME        = 'blockthorn-framework_cookie';
    const COOKIE_LIFETIME    = 86400;
    const COOKIE_HTTPONLY    = true;
    const COOKIE_SECURE      = false;

    // input post/get configuration
    const GLOBAL_XSS_FILTER  = false; // unfinished placeholder

    // built-in basic authentication helper
    const ENABLE_AUTH_HELPER = false; // unfinished placeholder
    const AUTH_HELPER_DB     = ''; // unfinished placeholder

    // built-in logging configuration (powered by monolog)
    const LOG_FILEFORMAT     = "-blackthorn.log";
    const LOG_FILEWITHDATE   = true;
    const LOG_DATEFORMAT     = "Y-m-d";
    const LOG_FOLDER         = APPPATH . "/Log/";
    const LOG_NAME           = "blackthorn-framework";

}