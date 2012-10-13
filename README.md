#Description
SCLoader is a simple classloader for namespaces.

Requires PHP 5.3

##Usage
    <?php
        
    use Session\Factory;
    use SCLoader\Loader;

    require_once 'library/SCLoader/Loader.php';

    $loader = new Loader();
    $loader->registerNamespace('Session', __DIR__ . '/library')

    $loader->register();
    
    /* included class 'library/Session/Factory.php' */
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
        'Session' => array(__DIR__ . '/library'),
        'Symfony' => array(__DIR__ . '/library/Symfony/lib'),
    ));

##setBaseDir($dir)
Sets the base directory for the classloader.
 
##getBaseDir()
Get the base path.

##setPrefix()
Set prefix.

##getPrefix()
Get prefix.