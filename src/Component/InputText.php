<?php

namespace Fluent\Component;

use Fluent\Node;

class InputText extends Node
{
    public function __construct($id) {

        $this->tag = 'input';

        $this->id = $id;
        $this->type('text');

        $this->addClass('form-control');
    }

    public function build() {
        return '<input type="text" '.$this->buildProperties().' />';
    }
}