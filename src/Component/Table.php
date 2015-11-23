<?php

namespace Fluent\Component;

use Fluent\Node;

class Table extends Node
{
    protected $heads = array();

    public function __construct($id = null) {

        if ($id)
            $this->id($id);

        $this->addClass('table');
    }

    public function build() {

        $code = '<table '.$this->buildProperties().'>';
        $code .= '<thead>';

        foreach ($this->heads as $head):
            $code .= '<th>'.$head.'</th>';
        endforeach;

        $code .= '</thead>';
        $code .= '<tbody>';
        $code .= $this->buildChilds();
        $code .= '</tbody>';
        $code .= '</table>';

        return $code;
    }

    public function addHead($head) {
        array_push($this->heads, $head);
        return $this;
    }

    public function striped() {
        $this->addClass('table-striped');
        return $this;
    }

    public function condensed() {
        $this->addClass('table-condensed');
        return $this;
    }

    public function hover() {
        $this->addClass('table-hover');
        return $this;
    }
}
