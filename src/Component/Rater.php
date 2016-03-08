<?php

namespace Fluent\Component;

use Fluent\Fluent;
use Fluent\Node;

class Rater extends Node
{
    protected $value;
    protected $color = 'rating-a';

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function make() {

        $this->addChild(
            Fluent::div($this->id)
                ->addClass('input')
                ->addClass('select')
                ->addClass($this->color)
                ->addChild(Fluent::div()->addClass('br-widget')
                    ->addChild(
                        Fluent::a()
                            ->addClass(($this->value > 0)? 'br-selected' : '')
                            ->href("javascript:;")
                            ->addChild(Fluent::span()))
                    ->addChild(
                        Fluent::a()
                            ->addClass(($this->value > 1)? 'br-selected' : '')
                            ->href("javascript:;")
                            ->addChild(Fluent::span()))
                    ->addChild(
                        Fluent::a()
                            ->addClass(($this->value > 2)? 'br-selected' : '')
                            ->href("javascript:;")
                            ->addChild(Fluent::span()))
                    ->addChild(
                        Fluent::a()
                            ->addClass(($this->value > 3)? 'br-selected' : '')
                            ->href("javascript:;")
                            ->addChild(Fluent::span()))
                    ->addChild(
                        Fluent::a()
                            ->addClass(($this->value > 4)? 'br-selected' : '')
                            ->href("javascript:;")
                            ->addChild(Fluent::span()))));

        return $this;
    }

    public function primary() {
        $this->color = 'rating-a';
        return $this;
    }

    public function danger() {
        $this->color = 'rating-aa';
        return $this;
    }

    public function warning() {
        $this->color = 'rating-aaa';
        return $this;
    }
}