<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("api", "artist");

class Artist {
    private $id;
    private $name;
    private $country;
    private $foundationYear;
    private $logo;
    private $photo;
    private $bio;

    // Array of Record objects
    private $records;

    public function __construct($id, $name, $country = "", $foundationYear = 0, $logo = "", $photo = "", $bio = "") {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->foundationYear = $foundationYear;
        $this->logo = $logo;
        $this->photo = $photo;
        $this->bio = $bio;
    }

    public function create($name, $country, $foundationYear, $logo = "", $photo = "", $bio = "") {
        $insertId = insertArtist($name, $country, $foundationYear, $logo, $photo, $bio);
        if (!$insertId) {
            return null;
        }

        return new Artist($insertId, $name, $country, $foundationYear, $logo, $photo, $bio);
    }

    public function delete() {
        foreach ($this->getRecords() as $record) {
            $record->delete();
        }
        deleteArtist($this->id);
    }

    public function deleteImages() {
        unlink($this->getLogoPath());

        unlink($this->getPhotoPath());
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

    public function setFoundationYear($year) {
        if (!updateArtist($this->id, ["foundationYear" => (int)$year])) {
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

    public function getLogoImage() {
        return getImageSrc("artists", "logos", $this->logo);
    }

    public function getLogoPath() {
        return getImageDir("artists", "logos") . "/" . $this->getLogo();
    }

    public function uploadLogo($logoFile) {
        $logo = uploadImage($logoFile, "artists", "logos", $this->id);
        if (!$logo) {
            return false;
        }

        return $this->setLogo($logo);
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

    public function getPhotoImage() {
        return getImageSrc("artists", "photos", $this->photo);
    }

    public function getPhotoPath() {
        return getImageDir("artists", "photos") . "/" . $this->getPhoto();
    }

    public function uploadPhoto($photoFile) {
        $photo = uploadImage($photoFile, "artists", "photos", $this->id);
        if (!$photo) {
            return false;
        }

        return $this->setPhoto($photo);
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

    public function getRecords() {
        if (!isset($this->records)) {
            $this->records = getRecordsByArtistId($this->id);
        }

        return $this->records;
    }
}
