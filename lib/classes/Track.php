<?php

class Track {
    private $id;
    private $artistId;
    private $genreId;
    private $title;
    private $duration;

    private $artist;
    private $genre;

    public function __construct($id, $title = "", $duration = 0, $artistId = 0, $genreId = 0) {
        $this->id = $id;
        $this->title = isset($title) ? $title : "";
        $this->duration = isset($duration) ? $duration : 0;
        $this->artistId = isset($artistId) ?$artistId : 0;
        $this->genreId = isset($genreId) ? $genreId : 0;

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

    public function setTitle() {
        // to be implemented
    }

    public function getDuration() {
        return $this->duration;
    }

    public function setDuration() {
        // to be implemented
    }

    public function getArtist() {
        return $this->artist;
    }

    public function setArtist() {
        // to be implemented
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre() {
        // to be implemented
    }
}
