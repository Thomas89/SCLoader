<?php

namespace Tests;

use SCLoader\Loader;

class SCLoaderTest extends \PHPUnit_Framework_TestCase
{
    protected $loader;

    protected function setUp()
    {
        $this->loader = new Loader();
    }

    public function testBasic()
    {
        $this->assertEquals(1, 1);
    }
}
