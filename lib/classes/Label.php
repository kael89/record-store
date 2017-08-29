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

    public function setName($name) {
        if (updateLabel($this->id, ["name" => $name])) {
            $this->name = $name;
        } else {
            return false;
        };
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        if (updateLabel($this->id, ["name" => $country])) {
            $this->country = $country;
        } else {
            return false;
        };
    }

    public function getFoundationYear() {
        return $this->foundationYear;
    }

    public function setFoundationYear($year) {
        if (updateLabel($this->id, ["foundationYear" => $year])) {
            $this->foundationYear = $year;
        } else {
            return false;
        };
    }

    public function getLogo() {
        return $this->logo;
    }

    public function setLogo($logo) {
        if (!updateLabel($this->id, ["logo" => $logo])) {
            return false;
        }

        $this->logo = $logo;
        return true;
    }
}