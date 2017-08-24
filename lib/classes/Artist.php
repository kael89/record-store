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

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        if (updateArtist($this->id, ["name" => $name])) {
            $this->name = $name;
        } else {
            return false;
        };
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        if (updateArtist($this->id, ["country" => $country])) {
            $this->country = $country;
        } else {
            return false;
        };
    }

    public function getFoundationYear() {
        return $this->FoundationYear;
    }

    public function setFoundationYear(int $year) {
        if (updateArtist($this->id, ["foundationYear" => $year])) {
            $this->foundationYear = $year;
        } else {
            return false;
        };
    }

    public function getLogo() {
        return $this->logo;
    }

    public function setLogo($logo) {
        if (updateArtist($this->id, ["logo" => $logo])) {
            $this->logo = $logo;
        } else {
            return false;
        };
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        if (updateArtist($this->id, ["photo" => $photo])) {
            $this->photo = $photo;
        } else {
            return false;
        };
    }
}
