<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/artist-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/genre-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/label-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/track-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/user-api.php";

class Record {
    private $id;
    private $title;
    private $releaseDate;
    private $cover;
    private $price;

    private $label;

    public function __construct($id, $title = "", $releaseDate = "", $cover = "", $price = "", $labelId = 0) {
        $this->id = $id;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->cover = $cover;
        $this->price = $price;

        // if ($labelId > 0) {
        //     $this->label = getLabelById($labelId)->getName();
        // }
    }

    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($labelId) {
        // $this->label = $label;
    }

    public function getArtist() {
        return $this->artist;
    }

    public function setArtist($artist) {
        // $this->artist = $artist;
    }

    public function getTracks() {
        return $this->tracks;
    }

    public function setTracks($tracks) {
        // $this->tracks = $tracks;
    }
}