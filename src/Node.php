<?php

namespace Fluent;

class Node
{
    protected $id;
    protected $tag;
    protected $classes = array();
    protected $styles = array();
    protected $extra_properties = array();
    protected $childs = array();
    protected $data = array();

    public function __construct($tag = null)
    {
        $this->tag = $tag;
    }

    public function __call($name, $args)
    {
        if (isset($this->$name)) {
            $func = $this->$name;
            return call_user_func_array($func, $args);
        }

        if (sizeof($args) == 1)
            return $this->addProperty($this->from_camel_case($name), $args[0]);
        else
            return $this->addProperty($this->from_camel_case($name), '');
    }

    public function build() {

        if ($this->tag)
            return '<'.$this->tag.' '.$this->buildProperties().'>'.$this->buildChilds().'</'.$this->tag.'>';
        else
            return $this->buildChilds();
    }

    protected function buildExtraProperties() {

        $_properties = "";

        foreach($this->extra_properties as $key=>$value) {
            $_properties .= " ".$key . '="'.$value.'"';
        }

        return $_properties;
    }

    protected function buildClasses() {

        $_classes = "";

        if (sizeof($this->classes) > 0)
            $_classes = ' class="'.implode(" ", $this->classes).'"';

        return $_classes;
    }

    protected function buildStyles() {

        if (!$this->styles)
            return '';

        $_styles = 'style="';

        foreach ($this->styles as $key => $value) {
            $_styles .= $key.': '.$value . '; ';
        }

        $_styles .= '"';

        return $_styles;
    }

    protected function buildProperties() {
        return $this->buildClasses() . $this->buildStyles() . $this->buildExtraProperties();
    }

    public function text($text) {

        $this->addChild(
            Fluent::text($text)
        );

        return $this;
    }

    public function icon($icon) {

        $this->addChild(
            Fluent::span()
                ->addClass('glyphicon')
                ->addClass('glyphicon-'.$icon)
                ->ariaHidden('true')
        );

        return $this;
    }

    public function make() {
        return $this;
    }

    public function setup($config) {

        if (array_key_exists('title', $config))
            $this->title = $config['title'];

        if (array_key_exists('data', $config))
            $this->data = $config['data'];

        if (array_key_exists('styles', $config))
            $this->parseStyles($config['styles']);

        if (array_key_exists('layout', $config))
            $this->parseLayout($config['layout']);

        if (array_key_exists('childs', $config)) {

            foreach ($config['childs'] as $child) {

                $obj = $this->parse($child);

                if ($obj)
                    $this->addChild($obj);
            }
        }

        return $this;
    }

    private function parse($cfg) {

        if (!array_key_exists('type', $cfg))
            $cfg['type'] = 'Node';

        if (class_exists('Fluent\\Component\\'.$cfg['type']))
            $name = 'Fluent\\Component\\'.$cfg['type'];
        else
            $name = $cfg['type'];

        if (class_exists($name)) {

            $obj = new $name((array_key_exists('id', $cfg))? $cfg['id'] : null);

            return $obj->setup($cfg);
        }
    }

    public function addClass($class) {
        if ($class && !array_key_exists($class, $this->classes))
            array_push($this->classes, $class);
        return $this;
    }

    public function removeClass($class) {

        if(($key = array_search($class, $this->classes)) !== false)
            unset($this->classes[$key]);

        return $this;
    }

    public function addStyle($key, $value) {
        $this->styles[$key] = $value;
        return $this;
    }

    public function removeStyle($key) {

        unset($this->styles[$key]);
        return $this;
    }

    public function addProperty($key, $value) {
        if ($key && $value)
            $this->extra_properties[$key] = $value;

        return $this;
    }

    public function addChild($child = null) {

        if ($child)
            array_push($this->childs, $child->make());

        return $this;
    }

    public function removeText() {

        for ($i = 0; $i < sizeof($this->childs); $i++) {
            if (array_key_exists('text', $this->childs[$i]->data))
                unset($this->childs[$i]);
        }

        return $this;
    }

    public function removeIcon() {

        for ($i = 0; $i < sizeof($this->childs); $i++) {
            if (in_array('glyphicon', $this->childs[$i]->classes))
                unset($this->childs[$i]);
        }

        return $this;
    }

    public function getChilds() {
        return $this->childs;
    }

    protected function buildChilds() {

        $code = '';

        foreach ($this->childs as $child) {
            $code .= $child->build();
        }

        return $code;
    }

    public function margin($value) {
        return ($value!==null)? $this->addStyle('margin', $value . 'px') : $this;
    }

    public function marginTop($value) {
        return ($value!==null)? $this->addStyle('margin-top', $value . 'px') : $this;
    }

    public function marginBottom($value) {
        return ($value!==null)? $this->addStyle('margin-bottom', $value . 'px') : $this;
    }

    public function marginLeft($value) {
        return ($value!==null)? $this->addStyle('margin-left', $value . 'px') : $this;
    }

    public function marginRight($value) {
        return ($value!==null)? $this->addStyle('margin-right', $value . 'px') : $this;
    }

    public function padding($value) {
        return ($value!==null)? $this->addStyle('padding', $value . 'px') : $this;
    }

    public function paddingTop($value) {
        return ($value!==null)? $this->addStyle('padding-top', $value . 'px') : $this;
    }

    public function paddingBottom($value) {
        return ($value!==null)? $this->addStyle('padding-bottom', $value . 'px') : $this;
    }

    public function paddingLeft($value) {
        return ($value!==null)? $this->addStyle('padding-left', $value . 'px') : $this;
    }

    public function paddingRight($value) {
        return ($value!==null)? $this->addStyle('padding-right', $value . 'px') : $this;
    }

    public function maxWidth($value) {
        return ($value!==null)? $this->addStyle('max-width', $value . 'px') : $this;
    }

    public function minWidth($value) {
        return ($value!==null)? $this->addStyle('min-width', $value . 'px') : $this;
    }

    public function maxHeight($value) {
        return ($value!==null)? $this->addStyle('max-height', $value . 'px') : $this;
    }

    public function minHeight($value) {
        return ($value!==null)? $this->addStyle('min-height', $value . 'px') : $this;
    }

    public function bold() {
        return $this->addStyle('font-weight', 'bold');
    }

    public function normalFont() {
        return $this->addStyle('font-weight', 'normal');
    }

    public function uppercase() {
        return $this->addStyle('text-transform', 'uppercase');
    }

    public function color($color) {
        return ($color!==null)? $this->addStyle('color', $color) : $this;
    }

    public function backgroundColor($color) {
        return ($color!==null)? $this->addStyle('background-color', $color) : $this;
    }

    public function colXs($value) {
        return ($value!==null)? $this->addClass('col-xs-'.$value) : $this;
    }

    public function colSm($value) {
        return ($value!==null)? $this->addClass('col-sm-'.$value) : $this;
    }

    public function colMd($value) {
        return ($value!==null)? $this->addClass('col-md-'.$value) : $this;
    }

    public function colLg($value) {
        return ($value!==null)? $this->addClass('col-lg-'.$value) : $this;
    }

    public function parseStyles($styles) {

        foreach ($styles as $key=>$value) {
            $this->addStyle($key, $value);
        }
        return $this;
    }

    public function parseLayout($layout) {

        $classes = explode(',', $layout);

        foreach ($classes as $class) {
            $class = trim($class);

            if (is_numeric(strpos($class, 'xs'))) {
                $this->colXs(substr($class, 2, strlen($class)));
            } else if (is_numeric(strpos($class, 'sm'))) {
                $this->colSm(substr($class, 2, strlen($class)));
            } else if (is_numeric(strpos($class, 'md'))) {
                $this->colMd(substr($class, 2, strlen($class)));
            } else if (is_numeric(strpos($class, 'lg'))) {
                $this->colLg(substr($class, 2, strlen($class)));
            }
        }
    }

    private function from_camel_case($input) {

        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('-', $ret);
    }

}