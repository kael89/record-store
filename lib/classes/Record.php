<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("api");

class Record {
    private $id;
    private $title;
    private $labelId;
    private $releaseDate;
    private $cover;
    private $price;

    // Array - artist names whose tracks are featured in the record (sorted)
    private $artists;
    // String
    private $label;
    // Associative array of [$trackld => $trackObject] elements
    private $tracks;
    // Array of Genre objects
    private $genres;

    public function __construct($id, $title = "", $labelId = null, $releaseDate = "", $cover = "", $price = 0) {
        $this->id = $id;
        $this->labelId = $labelId;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->cover = $cover;
        $this->price = $price;
    }

    public function delete() {
        $this->initTracks();
        foreach ($this->tracks as $track) {
            $track->delete();
        }
        $this->deleteImages();
        deleteRecord($this->id);
    }

    public function deleteImages() {
        unlink($this->getCoverPath("sm"));
        unlink($this->getCoverPath("md"));
        unlink($this->getCoverPath("lg"));
    }

    public function getId() {
        return $this->id;
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

    public function getLabelId() {
        return $this->labelId;
    }

    public function getLabel() {
        if (!isset($this->label)) {
            $this->label = getLabelById($this->labelId);
        }

        return $this->label;
    }

    public function setLabel($id) {
        if (!isLabel($id) || !updateTrack($this->id, ["labelId" => $id])) {
            return false;
        }

        $this->labelId = $id;
        return true;
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function setReleaseDate($date) {
        if (updateRecord($this->id, ["releaseDate" => $date])) {
            $this->releaseDate = $date;
        } else {
            return false;
        };
    }

    public function getCover() {
        return $this->cover;
    }

    public function setCover($cover) {
        if (updateRecord($this->id, ["cover" => $cover])) {
            $this->cover = $cover;
        } else {
            return false;
        };
    }

    public function uploadCover($coverFile) {
        $cover = uploadImage($coverFile, "records", "covers", "md", $this->id);
        if (!$cover) {
            return false;
        }

        return $this->setCover($cover);
    }

    public function getCoverImage($size = "sm") {
        return getImageSrc("records", "covers", $size, $this->cover);
    }

    public function getCoverPath($size = "sm") {
        return getImageDir("records", "covers", $size) . "/" . $this->getCover();
    }

    public function getPrice() {
        return $this->price;
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
        if (!isset($this->artists)) {
            $this->artists = getArtistsByRecordId($this->id);
        }

        return $this->artists;
    }

    private function initTracks() {
        if (!isset($this->tracks)) {
            $this->tracks = [];
            $tracks = getTracksByRecordId($this->id);
            foreach ($tracks as $track) {
                $this->tracks[$track->getId()] = $track;
            }
        }
    }

    public function getTracks() {
        $this->initTracks();
        return $this->tracks;
    }

    public function addTrack() {
        // to be implemeted
    }

    public function updateTrack($track, $number) {
        $this->tracks[$number] = [
            "title" => $track->getTitle(),
            "artist" => $track->getArtist(),
            "genre" => $track->getGenre(),
            "duration" => $track->getDuration()
        ];
    }

    public function deleteTracks($trackIds) {
        $this->initTracks();
        foreach ($trackIds as $id) {
            $this->tracks[$id]->delete();
            unset($this->tracks[$id]);
        }
    }

    public function getGenres() {
        if (!isset($this->genres)) {
            $this->genres = getGenresByRecordId($this->getId());
        }

        return $this->genres;
    }
}
