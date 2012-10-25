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

    public function testNamespaceCollisions()
    {
        $loader = new Loader();
        $loader->registerNamespace('A', __DIR__ . '/fixtures/NS');
        $loader->registerNamespace('B', __DIR__ . '/fixtures/NS');
        $loader->register();

        $this->assertTrue(\A\Foo::$isLoaded);
        $this->assertTrue(\B\Foo::$isLoaded);

        $this->assertTrue(\A\Bar::$isLoaded);
        $this->assertTrue(\B\Bar::$isLoaded);

        $loader->unregister();
    }

    public function testClassesAndParents()
    {
        $loader = new Loader();
        $loader->registerNamespace('ClassesAndParents', __DIR__ . '/fixtures');
        $loader->register();

        $this->assertTrue(\ClassesAndParents\Foo::$paramFoo);
        $this->assertTrue(\ClassesAndParents\Foo::$paramBar);

        $loader->unregister();
    }

    public function testRootNamespace()
    {
        $loader = new Loader();
        $loader->setBaseDir(__DIR__ . '/fixtures');
        $loader->register();

        $this->assertTrue(\RootNS\A\B\Foo::$isLoaded);

        $loader->unregister();
    }

    public function testSubNamespace()
    {
        $loader = new Loader();
        $loader->registerNamespace('A\B', __DIR__ . '/fixtures/SubNS');
        $loader->register();

        $this->assertTrue(\A\B\Foo::$isLoaded);

        $loader->unregister();
    }

    public function testClassPrefix()
    {
        $loader = new Loader();
        $loader->registerNamespace('A', __DIR__ . '/fixtures/ClassPrefix');
        $loader->setPrefix('class');
        $loader->register();

        $this->assertTrue(\A\Baz::$isLoaded);

        $loader->unregister();
    }

    public function testClassesWithoutNamespaces()
    {
        $loader = new Loader();
        $loader->setBaseDir(__DIR__ . '/fixtures/ClassesWithoutNamespaces');
        $loader->register();

        $this->assertTrue(\Quux::$isLoaded);

        $loader->unregister();
    }

    public function testUnderscoresInNamespaces()
    {
        $loader = new Loader();
        $loader->registerNamespace('A\B', __DIR__ . '/fixtures/Underscores');
        $loader->register();

        $this->assertTrue(\A\B\Foo_Bar::$isLoaded);

        $loader->unregister();
    }
}

