<?php

namespace Fluent\Component;

use Fluent\Fluent;
use Fluent\Node;

class Select extends Node
{
    public function __construct($id = null) {

        $this->id = $id;
        $this->tag = 'select';

        $this->addClass('form-control');
        $this->addClass('select-width');
    }

    public function options($list) {

        foreach ($list as $item) {
            $this->addChild(
                Fluent::option()
                    ->value($item->id)
                    ->text($item->name)
            );
        }

        return $this;
    }
}