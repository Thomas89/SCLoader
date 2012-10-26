#Description [![Build Status](https://secure.travis-ci.org/The-Who/SCLoader.png)](http://travis-ci.org/The-Who/SCLoader)
SCLoader is a simple classloader for namespaces.

Requires PHP 5.3

#Install with Composer

Run this in your terminal to get the latest Composer version:

    curl -s https://getcomposer.org/installer | php

Create composer.json

    {
        "require": {
            "the-who/scloader": "dev-master"
        }
    }

##Usage
    <?php
        
    use Session\Factory;
    use SCLoader\Loader;

    require_once 'lib/vendor/SCLoader/Loader.php';

    $loader = new Loader();
    $loader->registerNamespace('Session', __DIR__ . '/lib/vendor')

    $loader->register();
    
    /* included class 'lib/vendor/Session/Factory.php' */
    $cache = new Factory();

#Methods

##register()
Registers the autoloader.

##unregister()
Unregisters the autoloader.
   
##registerNamespace($namespace, $path)
Registers a namespace.

##registerNamespaces($array)
Register namespaces in an array:

    $loader->registerNamespaces(array(
        'Session' => array(__DIR__ . '/lib/vendor'),
        'Symfony' => array(__DIR__ . '/lib/vendor/Symfony/lib'),
    ));

##setBaseDir($dir)
Sets the base directory for the classloader.
 
##getBaseDir()
Get the base path.

##setPrefix()
Set prefix.

##getPrefix()
Get prefix.