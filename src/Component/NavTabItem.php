<?php

namespace Fluent\Component;

use Fluent\Fluent;
use Fluent\Node;

class NavTabItem extends Node
{
    protected $name;
    protected $color;
    protected $count;
    public $content;
    private $active = FALSE;

    public function __construct($id = null) {

        $this->id = $id;
    }

    public function active() {
        $this->active = TRUE;
        return $this;
    }

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function color($color) {
        $this->color = $color;
        return $this;
    }

    public function count($count) {
        $this->count = $count;
        return $this;
    }

    public function content($content = null) {

        $this->content = new NavTabContent($this->id, $content);

        if ($this->active)
            $this->content->active();

        return $this;
    }

    public function make() {

        $this->addChild(
            Fluent::li()
                ->addClass(($this->active)? 'active' : null)
                ->addChild(
                    Fluent::a()
                        ->href('#'.$this->id)
                        ->dataToggle('tab')
                        ->color('black')
                            ->addChild(
                                Fluent::text($this->name.'&nbsp;'))
                            ->addChild(($this->count)?
                                Fluent::span()
                                    ->addClass('badge')
                                    ->backgroundColor($this->color)
                                    ->text($this->count)
                                :null)
                )
        );

        return $this;
    }
}