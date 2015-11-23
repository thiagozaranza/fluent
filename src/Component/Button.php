<?php

namespace Fluent\Component;

use Fluent\Node;

class Button extends Node {

    public function __construct($id = null) {

        $this->tag = 'button';

        if ($id)
            $this->id($id);

        $this->type('button');

        $this->addClass('btn');
        $this->addClass('btn-default');
    }

    public function make() {

        if ($this->hasText() && $this->hasIcon()) {
            for ($i = 0; $i < sizeof($this->childs); $i++) {
                if (in_array('glyphicon', $this->childs[$i]->classes))
                    $this->childs[$i]->marginRight(5);
            }
        }

        return $this;
    }

    private function hasText() {

        for ($i = 0; $i < sizeof($this->childs); $i++) {
            if (array_key_exists('text', $this->childs[$i]->data))
                return true;
        }

        return false;
    }

    public function hasIcon() {

        for ($i = 0; $i < sizeof($this->childs); $i++) {
            if (in_array('glyphicon', $this->childs[$i]->classes))
                return true;
        }

        return true;
    }

    public function primary() {
        return $this->removeClass('btn-default')->addClass('btn-primary');
    }

    public function success() {
        return $this->removeClass('btn-default')->addClass('btn-success');
    }

    public function info() {
        return $this->removeClass('btn-default')->addClass('btn-info');
    }

    public function warning() {
        return $this->removeClass('btn-default')->addClass('btn-warning');
    }

    public function danger() {
        return $this->removeClass('btn-default')->addClass('btn-danger');
    }

    public function link() {
        return $this->removeClass('btn-default')->addClass('btn-link');
    }

    public function larger() {
        return $this->addClass('btn-lg');
    }

    public function small() {
        return $this->addClass('btn-sm');
    }

    public function extraSmall() {
        return $this->addClass('btn-xs');
    }

    public function submit() {
        return $this->addProperty('type', 'submit');
    }
}