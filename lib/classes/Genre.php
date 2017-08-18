<?php

class Genre {
    private $id;
    private $name;

    public function __construct($id, $name = "") {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }
}