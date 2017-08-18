<?php

class Track {
    private $id;
    private $title;
    private $duration;

    public function __construct($id, $title = "", $duration = 0) {
        $this->id = $id;
        $this->title = $title;
        $this->duration = $duration;
    }

    public function getId() {
        return $this->id;
    }
}