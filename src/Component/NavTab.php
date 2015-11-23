<?php

namespace Fluent\Component;

use Fluent\Fluent;
use Fluent\Node;

class NavTab extends Node
{
    protected $content;
    protected $max_height;
    protected $itens = array();

    public function __construct($id = null)
    {
        $this->id = $id;
        $this->content = Fluent::div()
            ->addChild(
                Fluent::ul()
                    ->addClass('nav')
                    ->addClass('nav-tabs'));
    }

    public function addItem($obj) {
        array_push($this->itens, $obj);
        return $this;
    }

    public function maxHeight($value) {
        $this->max_height = $value;
        return $this;
    }

    public function make() {

        $tabs = Fluent::ul()
            ->addClass('nav')
            ->addClass('nav-tabs');

        foreach ($this->itens as $item) {
            $tabs->addChild($item);
        }

        $content = Fluent::div()
            ->addClass('tab-content');

        foreach ($this->itens as $item) {
            $content->addChild($item->content);
        }

        $this->addChild($tabs);
        $this->addChild($content);

        return $this;
    }
}