<?php

namespace Fluent\Component;

use Fluent\Fluent;
use Fluent\Node;

class NavTabContent extends Node
{
    private $maxHeight = 900;
    private $active = FALSE;

    public function __construct($id, $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    public function active() {
        $this->active = TRUE;
        return $this;
    }

    public function maxHeight($value) {
        $this->maxHeight = $value;
        return $this;
    }

    public function make() {

        $this->addChild(
            Fluent::div($this->id)
                ->addClass('tab-pane')
                ->addClass(($this->active)? 'active':null)
                ->addChild(
                    Fluent::div()
                        ->maxHeight($this->maxHeight)
                        ->addStyle('overflow-y', 'scroll')
                        ->addStyle('overflow-x', 'hidden')
                        ->addChild(
                            $this->content->addStyle('max-height', $this->maxHeight)
                        )
                )
            );

        return $this;
    }
}