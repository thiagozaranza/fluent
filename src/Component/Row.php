<?php

namespace Fluent\Component;

use Fluent\Node;

class Row extends Node
{
    public function __construct($id = null) {
        $this->id = $id;
        $this->tag = 'div';
        $this->addClass('row');
    }
}