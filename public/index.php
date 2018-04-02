<?php
/**
 * Blackthorn php framework
 *
 * Blackthorn index.php
 *
 * @category  Apps
 * @author    Gema Aji Wardian <gema_wardian@hotmail.com>
 * @copyright 2018 Gema Aji Wardian
 * @version   0.1-alpha
 * @since     File available since 0.1-alpha
 */

// enable compression for gzip
ob_start('ob_gzhandler');

// initialize path info for application
$base_path = '../';
$application_path = '../app/';
$public_path = '../public/';

$base_path = realpath($base_path);
$application_path = realpath($application_path);
$public_path = realpath($public_path);

define('APPPATH', $application_path);
define('BASEPATH', $base_path);
define('PUBLICPATH', $public_path);

// load framework autoload
require BASEPATH . '/autoload.php';

// load composer autoload
require BASEPATH . '/vendor/autoload.php';

// execute the application
$main = new \Blackthorn\Blackthorn();
$main->appOverride();