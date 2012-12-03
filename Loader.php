<?php
/**
 * Simple ClassLoader
 *
 * @author TheWho <pashaz.exe@gmail.com>
 */

namespace SCLoader;

use SCLoader\ILoader;

require_once 'ILoader.php';
require_once 'ClassNotFoundException.php';

class Loader implements ILoader
{
    /**
     * Array of namespaces
     *
     * @var array
     */
    private $namespaces = array();

    /**
     * Basic directory
     *
     * @var null
     */
    private $baseDir = null;

    /**
     * Class prefix
     *
     * @var null
     */
    private $prefix = null;

    /**
     * Constructor sets the basic directory
     */
    public function __construct()
    {
        if (null == $this->baseDir) {
            $this->baseDir = __DIR__;
        }
    }

    /**
     * @param $namespace
     * @param $path
     *
     * @return Loader
     */
    public function registerNamespace($namespace, $path)
    {
        $this->namespaces[$namespace] = (array) $path;
        return $this;
    }

    /**
     * @param $array
     *
     * @return mixed|Loader
     */
    public function registerNamespaces($array)
    {
        $this->namespaces = array_merge($this->namespaces, $array);
        return $this;
    }

    /**
     * @return mixed|Loader
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loader'), true, false);
        return $this;
    }

    /**
     * @return mixed|Loader
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loader'));
        return $this;
    }

    protected function loader($class)
    {
        /* Separate the absolute path */
        if ('\\' == $class[0]) {
            $class = substr($class, 1);
        }

        $classPosition = strrpos($class, '\\');
        $className = substr($class, $classPosition + 1);
        $namespace = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, 0, $classPosition));

        /* Class without a namespace */
        if (file_exists($file = $this->getFile($class))) {
            require_once $file;
            return;
        }

        /* Class is in the base directory */
        if (file_exists($file = $this->getFile($className, $namespace))) {
            require_once $file;
            return;
        }

        /* Class is in the array $this->namespaces */
        foreach ($this->namespaces as $ns => $paths) {
            if (0 === strcmp($namespace, str_replace('\\', DIRECTORY_SEPARATOR, $ns))) {
                foreach ($paths as $dir) {
                    if (file_exists($file = $this->getFile($className, $namespace, $dir))) {
                        require_once $file;
                        return;
                    }
                }
            }
        }

        if (!class_exists($class, false)
            && !interface_exists($class, false)
            && !trait_exists($class, false)) {
            throw new \ClassNotFoundException($class);
        }
    }
    /**
     * @param $className
     * @param $namespace
     * @param null $dir
     *
     * @return string
     */
    protected function getFile($className, $namespace = null, $dir = null)
    {
        /* \Class_Name => Class/Name.php */
        $className = str_replace('_', DIRECTORY_SEPARATOR, $className);

        if (null == $dir) {
            $dir = $this->baseDir;
        }

        if (null == $namespace) {
            return $dir . DIRECTORY_SEPARATOR . $className
                . (($this->prefix != null) ? '.' . $this->prefix : null) . '.php';
        }

        return $dir . DIRECTORY_SEPARATOR . $namespace . DIRECTORY_SEPARATOR . $className
            . (($this->prefix != null) ? '.' . $this->prefix : null) . '.php';
    }

    /**
     * @param $dir
     *
     * @return Loader
     */
    public function setBaseDir($dir)
    {
        $this->baseDir = $dir;
        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getBaseDir()
    {
        return $this->baseDir;
    }

    /**
     * @param $prefix
     *
     * @return mixed|Loader
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return bool|mixed|null
     */
    public function getPrefix()
    {
        if (null !== $this->prefix) {
            return $this->prefix;
        }

        return false;
    }
}

