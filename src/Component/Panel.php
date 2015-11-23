<?php

namespace Fluent\Component;

use Fluent\Fluent;
use Fluent\Node;

class Panel extends Node
{
    protected $title;
    protected $content;
    protected $max_height;
    protected $style = 'panel-default';
    protected $scrol_x = FALSE;
    protected $scrol_y = FALSE;

    public function title($title) {
        $this->title = $title;
        return $this;
    }

    public function content($content) {
        $this->content = $content;
        return $this;
    }

    public function maxHeight($value) {
        $this->max_height = $value;
        return $this;
    }

    public function scrolX() {
        $this->scrol_x = TRUE;
        return $this;
    }

    public function scrolY() {
        $this->scrol_y = TRUE;
        return $this;
    }

    public function scrolXY() {
        $this->scrol_x = TRUE;
        $this->scrol_y = TRUE;
        return $this;
    }

    public function make() {

        $body = Fluent::div()
            ->addClass('panel-body')
            ->maxHeight($this->max_height)
            ->padding(5)
            ->addChild($this->content);

        if ($this->scrol_x && $this->scrol_y)
            $body->addStyle('overflow-x', 'scroll')
                ->addStyle('overflow-y', 'scroll');
        else if ($this->scrol_x)
            $body->addStyle('overflow-x', 'scroll')
                ->addStyle('overflow-y', 'hidden');
        else if ($this->scrol_y)
            $body->addStyle('overflow-x', 'hidden')
                ->addStyle('overflow-y', 'scroll');

        $this->addChild(Fluent::div($this->id)
            ->addClass('panel')
            ->addClass($this->style)
            ->addChild(
                Fluent::div()
                    ->addClass('panel-heading')
                    ->addChild(
                        Fluent::text($this->title)))
            ->addChild($body));

        return $this;
    }
}