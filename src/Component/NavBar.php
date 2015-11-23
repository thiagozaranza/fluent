<?php

namespace Fluent\Component;

use Fluent\Node;
use Fluent\Fluent;

class NavBar extends Node
{
    public function make() {

        $this->addChild(
            Fluent::div()
                ->addClass('navbar')
                ->addClass('navbar-default')
                ->addProperty('role', 'navigation')
                ->addChild(
                    Fluent::div()
                        ->addClass('navbar-header')
                        ->addChild(
                            Fluent::a('btn-list')
                                ->addClass('navbar-brand')
                                ->href('#')
                                ->text($this->title)
                        )
                )
                ->addChild(
                    Fluent::div('bs-example-navbar-collapse-2')
                        ->addClass('collapse')
                        ->addClass('navbar-collapse')
                        ->addClass('navbar-right')
                        ->padding(0)
                        ->addChild(
                            Fluent::form()
                                ->addClass('navbar-form')
                                ->addClass('navbar-left')
                                ->role('search')
                                ->onsubmit('return false;')
                                ->addChild(
                                    Fluent::div()
                                        ->addClass('form-group')
//                                        ->addChild(
//                                            Fluent::inputText($this->config['search']['id'])
//                                                ->placeholder($this->config['search']['placeholder'])
//                                                ->value($this->config['search']['value'])
//                                                ->marginRight(5)
//                                        )
                                )
                                ->addChild(
                                    Fluent::button('btn-search')
                                        ->icon('search')
                                        ->submit()
                                        ->marginRight(10)
                                )
                        )
                )
        );

        return $this;
    }
}