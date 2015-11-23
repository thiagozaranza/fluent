<?php

namespace Fluent\Component;

use Fluent\Node;

class Text extends Node
{
    public function __construct($text = null) {
        $this->data['text'] = $text;
    }
    public function build() {
        return $this->data['text'];
    }
}