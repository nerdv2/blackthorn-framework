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
    /**
     * get function.
     *
     * @access public
     * @param mixed $get
     * @return mixed
     */
    public function get($get)
    {
        $getdata = filter_input(INPUT_GET, $get);

        return $getdata;
    }

    /**
     * post function.
     *
     * @access public
     * @param mixed $post
     * @return mixed
     */
    public function post($post)
    {
        $postdata = filter_input(INPUT_POST, $post);

        return $postdata;
    }
}