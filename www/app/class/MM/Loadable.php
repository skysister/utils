<?php

namespace MM;

trait Loadable
{
    public function load($class, $name = null)
    {
        if (isset($this->$class)) {
            return $this->$class;
        }
        if ($name === null) {
            $name = $class;
        }

        if (class_exists($class)) {
            $this->$name = new $class($name);
        }

        return $this->$name;
    }
}
