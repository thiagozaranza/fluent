<?php

namespace Fluent;

class Fluent
{
    public static function __callStatic($name, $arguments)
    {
        if (class_exists('Fluent\\Component\\'.ucfirst($name))) {
            $component = 'Fluent\\Component\\'.ucfirst($name);

            if (sizeof($arguments)>0)
                return new $component($arguments[0]);
            else
                return new $component();
        }
        else {
            $node = new Node($name);

            if (sizeof($arguments)>0)
                $node->id($arguments[0]);

            return $node;
        }
    }
}