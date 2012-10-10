<?php

namespace SCLoader;

use SCLoader\ILoader;

require_once 'ILoader.php';
require_once 'ClassNotFoundException.php';

class Loader implements ILoader
{
    protected $namespaces = array();

    protected $baseDir;

    public function __construct()
    {
        if (!$this->baseDir) {
            $this->baseDir = __DIR__ . '/../';
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
        spl_autoload_unregister(array($this, 'loader'), true);
        return $this;
    }

    protected function loader($class)
    {
        //TODO: Implements loader
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
}
