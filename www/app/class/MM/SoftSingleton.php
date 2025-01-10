<?php

namespace MM;

trait SoftSingleton
{
    public static function instance()
    {
        static $instance = false;
        if ($instance === false) {
            $instance = new static();
        }
        
        return $instance;
    }
}
