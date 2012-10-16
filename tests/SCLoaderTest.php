<?php

namespace Tests;

use SCLoader\Loader;

class SCLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testNamespaceA()
    {
        $loader = new Loader();
        $loader->registerNamespace('A', __DIR__ . '/fixtures/NS');
        $loader->register();

        $this->assertTrue(\A\Foo::$isLoaded);
        $this->assertTrue(\A\Bar::$isLoaded);

        $loader->unregister();
    }

    public function testNamespaceB()
    {
        $loader = new Loader();
        $loader->registerNamespace('B', __DIR__ . '/fixtures/NS');
        $loader->register();

        $this->assertTrue(\B\Foo::$isLoaded);
        $this->assertTrue(\B\Bar::$isLoaded);

        $loader->unregister();
    }
}
