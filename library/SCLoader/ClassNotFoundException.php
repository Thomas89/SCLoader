<?php

class ClassNotFoundException extends \Exception
{
    public function __construct($class)
    {
        parent::__construct("Class '$class' not found.");
    }
}
