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
    
    public function __construct($id, $labelId, $title = "", $releaseDate = "", $cover = "", $price = 0) {
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

        $tracks = getTracksByRecordId($id);
        $this->setTracks($tracks);
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

    public function setTitle($title) {
        if (updateRecord($this->id, ["title" => $title])) {
            $this->title = $title;
        } else {
            return false;
        };
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function setReleaseDate($date) {
        if (updateArtist($this->id, ["releaseDate" => $date])) {
            $this->releaseDate = $date;
        } else {
            return false;
        };
    }

    public function getCover() {
        return $this->cover;
    }

    public function setCover($cover) {
        if (updateArtist($this->id, ["cover" => $cover])) {
            $this->cover = $cover;
        } else {
            return false;
        };
    }

    public function getPrice() {
        return $this->title;
    }

    public function setPrice($price) {
        if ($price < 0) {
            return false;
        }

        if (updateArtist($this->id, ["price" => $price])) {
            $this->price = $price;
        } else {
            return false;
        };
    }

    public function getArtists() {
        return $this->artists;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($id) {
        if (!isLabel($id) || !updateTrack($this->id, ["labelId" => $id])) {
            return false;
        }

        $this->labelId = $id;
        $this->label = getLabelById($id)->getName();
        return true;

    }

    public function getTracks() {
        return $this->tracks;
    }

    public function setTracks($tracks) {
        foreach ($tracks as $track) {
            $this->tracks[] = [
                "title" => $track->getTitle(),
                "artist" => $track->getArtist(),
                "genre" => $track->getGenre(),
                "duration" => $track->getDuration()
            ];
        }
    }

    public function updateTrack($track, $number) {
        $this->tracks[$number] = [
            "title" => $track->getTitle(),
            "artist" => $track->getArtist(),
            "genre" => $track->getGenre(),
            "duration" => $track->getDuration()
        ];
    }
}
