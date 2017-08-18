<?php

class Artist {
    private $id;
    private $name;
    private $country;
    private $foundationYear;
    private $logo;
    private $photo;

    public function __construct($id, $name = "", $country = "", $foundationYear = 0, $logo = "", $photo = "") {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->foundationYear = $foundationYear;
        $this->logo = $logo;
        $this->photo = $photo;
    }

    public function getId() {
        return $this->id;
    }
}