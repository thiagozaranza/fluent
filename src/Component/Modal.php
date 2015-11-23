<?php

namespace Fluent\Component;

use Illuminate\Support\Facades\Lang;
use Fluent\Fluent;
use Fluent\Node;

class Modal extends Node
{
    protected $title;
    protected $header;
    protected $body;
    protected $footer;
    protected $effect = 'fade';

    public function __construct($id = null) {

        $this->id = $id;
    }

    public function title($title) {
        $this->title = $title;
        return $this;
    }

    public function header($header) {
        $this->header = $header;
        return $this;
    }

    public function body($body) {
        $this->body = $body;
        return $this;
    }

    public function footer($footer) {
        $this->footer = $footer;
        return $this;
    }

    public function fade() {
        $this->effect = 'fade';
        return $this;
    }

    public function make()
    {
        $this->addChild(
            Fluent::div($this->id)
                ->addClass('modal')
                ->addClass($this->effect)
                ->tabindex('-1')
                ->role('dialog')
                ->ariaLabelledby('myModalLabel')
                ->ariaHidden('true')
                ->addChild(
                    Fluent::div()
                        ->addClass('modal-dialog')
                        ->addChild(
                            Fluent::div()
                                ->addClass('modal-content')
                                ->addChild(
                                    Fluent::div()
                                        ->addClass('modal-header')
                                        ->addChild(
                                            Fluent::button('modal-close')
                                                ->addClass('close')
                                                ->dataDismiss('modal')
                                                ->ariaHidden('true')
                                                ->addChild(
                                                    Fluent::text('&times;')
                                                )
                                        )
                                        ->addChild(
                                            Fluent::h4('myModalLabel')
                                                ->addClass('modal-title')
                                                ->text($this->title)
                                        )
                                )
                                ->addChild(
                                    Fluent::div()
                                        ->addClass('modal-body')
                                        ->addChild(
                                            Fluent::row()
                                                ->addChild(
                                                    Fluent::col()
                                                        ->colMd(12)
                                                        ->addChild($this->body)
                                                )
                                        )
                                )
                                ->addChild(
                                    Fluent::div('modal-footer')
                                        ->addClass('modal-footer')
                                        ->addChild(
                                            Fluent::row()
                                                ->addChild(
                                                    Fluent::col()
                                                        ->colMd(10)
                                                        ->align("left")
                                                        ->addChild($this->footer)
                                                )
                                                ->addChild(
                                                    Fluent::col()
                                                        ->colMd(2)
                                                        ->addChild(
                                                            Fluent::button()
                                                                ->dataDismiss('modal')
                                                                ->text(Lang::get('system.close'))
                                                        )
                                                )
                                        )
                                )
                        )
                ));

        return $this;
    }
}