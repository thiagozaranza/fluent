<?php

namespace Fluent\Component;

use Fluent\Node;

class Img extends Node
{
    public function __construct($id = null) {

        $this->tag = 'img';

        if ($id)
            $this->id($id);
    }

    public function circle() {
        return $this->addClass('img-circle');
    }

    public function rounded() {
        return $this->addClass('img-rounded');
    }
}