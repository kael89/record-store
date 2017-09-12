<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("api", "artist");

class Artist {
    private $id;
    private $name;
    private $country;
    private $foundationYear;
    private $logo;
    private $photo;
    private $bio;

    public function __construct($id, $name = "", $country = "", $foundationYear = 0, $logo = "", $photo = "", $bio = "") {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->foundationYear = $foundationYear;
        $this->logo = $logo;
        $this->photo = $photo;
        $this->bio = $bio;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        if (!updateArtist($this->id, ["name" => $name])) {
            return false;
        }

        $this->name = $name;
        return true;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        if (!updateArtist($this->id, ["country" => $country])) {
            return false;
        }

        $this->country = $country;
        return true;
    }

    public function getFoundationYear() {
        return $this->foundationYear;
    }

    public function setFoundationYear(int $year) {
        if (!updateArtist($this->id, ["foundationYear" => $year])) {
            return false;
        }

        $this->foundationYear = $year;
        return true;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function setLogo($logo) {
        if (!updateArtist($this->id, ["logo" => $logo])) {
            return false;
        }

        $this->logo = $logo;
        return true;
    }

    public function getLogoImage($size = "sm") {
        return getImage("artists", "logos", $this->logo, $size);
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        if (!updateArtist($this->id, ["photo" => $photo])) {
            return false;
        }

        $this->photo = $photo;
        return true;
    }

    public function getPhotoImage($size = "sm") {
        return getImage("artists", "photos", $this->photo, $size);
    }

    public function getBio() {
        return $this->bio;
    }

    public function setBio($bio) {
        if (!updateArtist($this->id, ["bio" => $bio])) {
            return false;
        }

        $this->bio = $bio;
        return true;
    }
}
