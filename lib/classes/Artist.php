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
        $this->name = isset($name) ? $name : "";
        $this->country = isset($country) ? $country : "";
        $this->foundationYear = isset($foundationYear) ? $foundationYear : 0;
        $this->logo = isset($logo) ? $logo : "";
        $this->photo = isset($photo) ? $photo : "";
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName() {
        // to be implemented
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry() {
        // to be implemented
    }

    public function getFoundationYear() {
        return $this->FoundationYear;
    }

    public function setFoundationYear() {
        // to be implemented
    }

    public function getLogo() {
        return $this->logo;
    }

    public function setLogo() {
        // to be implemented
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto() {
        // to be implemented
    }
}
