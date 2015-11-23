<?php

namespace Fluent\Component;

use Fluent\Node;

class Col extends Node
{
    public function __construct($id = null) {
        $this->id = $id;
        $this->tag = 'div';
    }
}