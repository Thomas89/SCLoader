<?php

namespace SCLoader;

interface ILoader
{
    /**
     * @return mixed
     */
    public function register();

    /**
     * @return mixed
     */
    public function unregister();

    /**
     * @param $namespace
     * @param $path
     *
     * @return mixed
     */
    public function registerNamespace($namespace, $path);

    /**
     * @param $array
     *
     * @return mixed
     */
    public function registerNamespaces($array);

    /**
     * @param $dir
     *
     * @return mixed
     */
    public function setBaseDir($dir);

    /**
     * @return mixed
     */
    public function getBaseDir();
}