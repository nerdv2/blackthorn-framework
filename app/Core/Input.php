<?php
/**
 * Blackthorn php framework
 *
 * Blackthorn input class
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

class Input
{
    public function get($get)
    {
        $getdata = $_GET["$get"];

        return $getdata;
    }

    public function post($post)
    {
        $postdata = $_POST["$post"];

        return $postdata;
    }
}