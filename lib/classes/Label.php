<?php

class Label {
    private $id;
    private $name;
    private $country;
    private $foundationYear;
    private $logo;

    public function __construct($id, $name = "", $country = "", $foundationYear = 0, $logo = "") {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->foundationYear = $foundationYear;
        $this->logo = $logo;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName() {
        //Write to DB!
    }
}