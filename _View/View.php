<?php
abstract class View {
    protected $elements;

    public function __construct() {
        $this->elements = [];
    }

    public function &addElement($elements) {
        array_push($this->elements, $elements);
        return ($this);
    }

    protected function renderChild() {
        $render = "";

        foreach($this->elements as $elements) {
            $render .= $elements . PHP_EOL;
        }
        return ($render);
    }
}
?>