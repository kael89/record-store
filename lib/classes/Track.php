<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("api");

class Track {
    private $id;
    private $artistId;
    private $genreId;
    private $title;
    private $duration;

    private $artist;
    private $genre;

    public function __construct($id, $artistId = 0, $genreId = 0, $title = "", $duration = 0) {
        $this->id = $id;
        $this->artistId = $artistId;
        $this->genreId = isGenre($genreId) ? $genreId : 0;
        $this->title = $title;
        $this->duration = ($duration > 0) ? $duration : 0;

        $artist = getArtistById($artistId);
        $this->artist = ($artist) ? $artist->getName() : "";

        $genre = getGenreById($genreId);
        $this->genre = ($genre) ? $genre->getName() : "";
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        if (updateTrack($this->id, ["title" => $title])) {
            $this->title = $title;
        } else {
            return false;
        };
    }

    public function getDuration() {
        return $this->duration;
    }

    public function setDuration($duration) {
        if ($duration < 0) {
            return false;
        }

        if (updateTrack($this->id, ["duration" => $duration])) {
            $this->duration = $duration;
        } else {
            return false;
        };
    }

    public function getArtist() {
        return $this->artist;
    }

    public function setArtist($id) {
        if (!isArtist($id)) {
            return false;
        }

        if (updateTrack($this->id, ["artistId" => $id])) {
            $this->artistId = $id;
            $this->artist = getArtistById($id)->getName();
            return true;
        }
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($id) {
        if (!isGenre($id)) {
            return false;
        }

        if (updateTrack($this->id, ["genreId" => $id])) {
            $this->genreId = $id;
            $this->genre = getGenreById($id)->getName();
        }
    }
}
