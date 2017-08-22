<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/artist-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/genre-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/label-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/track-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/user-api.php";

class Record {
    private $id;
    private $labelId;
    private $title;
    private $releaseDate;
    private $cover;
    private $price;

    // Array - artist names whose tracks are featured in the record (sorted)
    private $artists;
    // String
    private $label;
    // Array (assoc.) - ["title", "artist", "genre", "duration"]
    private $tracks;
    
    public function __construct($id, $labelId, $title = "", $releaseDate = "", $cover = "", $price = "") {
        $this->id = $id;
        $this->labelId = $labelId;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->cover = $cover;
        $this->price = $price;

        $artists = getArtistsByRecordId($id);
        $this->artists = [];
        foreach ($artists as $artist) {
            $this->artists[] = $artist->getName();
        }

        $this->label = getLabelById($labelId)->getName();

        $this->tracks = [];
        if ($tracks = getTracksByRecordId($id)) {
            foreach ($tracks as $track) {
                $this->tracks[] = [
                    "title" => $track->getTitle(),
                    "artist" => $track->getArtist(),
                    "genre" => $track->getGenre(),
                    "duration" => $track->getDuration()
                ];
            }
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getLabelId() {
        return $this->labelId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle() {
        // to be implemented
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function setReleaseDate() {
        // to be implemented
    }

    public function getCover() {
        return $this->cover;
    }

    public function setCover() {
        // to be implemented
    }

    public function getPrice() {
        return $this->title;
    }

    public function setPrice() {
        // to be implemented
    }

    public function getArtists() {
        return $this->artists;
    }

    public function setRecordArtist() {
        // to be implemented
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel() {
        // to be implemented
    }

    public function getTracks() {
        return $this->tracks;
    }

    public function setTracks($tracks) {
        // to be implemented
    }
}
