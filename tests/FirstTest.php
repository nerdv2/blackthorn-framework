<?php
use PHPUnit\Framework\TestCase;

use Blackthorn\Config\Config;

class FirstTest extends TestCase
{
    public function testFirstTime()
    {
        $foo = true;
        $this->assertTrue($foo);
    }

    public function testConfigConstant()
    {
        echo Config::DEV_MODE;
        $this->assertTrue(Config::DEV_MODE !== null);
    }
}