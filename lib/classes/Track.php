<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("api");

class Track {
    private $id;
    private $artistId;
    private $recordId;
    private $title;
    private $position;
    private $genreId;
    private $duration;

    public function __construct($id, $artistId, $recordId, $title, $position, $genreId = null, $duration = 0) {
        $this->id = $id;
        $this->artistId = $artistId;
        $this->recordId = $recordId;
        $this->title = $title;
        $this->position = $position;
        $this->genreId = isGenre($genreId) ? $genreId : null;
        $this->duration = parseDuration($duration);
    }

    public static function create($artistId, $recordId, $title, $position, $genreId = null, $duration = 0) {
        $duration = parseDuration($duration);

        $id = insertTrack($artistId, $recordId, $title, $position, $genreId, $duration);
        return new Track($id, $artistId, $recordId, $title, $position, $genreId, $duration);
    }

    public function delete() {
        deleteTrack($this->id);
    }

    public function getId() {
        return $this->id;
    }

    public function getArtistId() {
        return $this->artistId;
    }

    public function setArtistId($id) {
        if (!isArtist($id)) {
            return false;
        }

        if (updateTrack($this->id, ["artistId" => $id])) {
            $this->artistId = $id;
            return true;
        }
    }

    public function getRecordId() {
        return $this->recordId;
    }

    public function setRecordId($id) {
        if (!isRecord($id)) {
            return false;
        }

        if (updateTrack($this->id, ["recordId" => $id])) {
            $this->recordId = $id;
            return true;
        }
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

    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        if (updateTrack($this->id, ["position" => $position])) {
            $this->position = $position;
        }
    }

    public function getGenreId() {
        return $this->genreId;
    }

    public function setGenre($id) {
        if (!isGenre($id)) {
            return false;
        }

        if (updateTrack($this->id, ["genreId" => $id])) {
            $this->genreId = $id;
        }
    }

    public function getDuration() {
        return $this->duration;
    }

    public function setDuration($duration) {
        $duration = parseDuration($duration);

        if (updateTrack($this->id, ["duration" => $duration])) {
            $this->duration = $duration;
        }
    }
}
