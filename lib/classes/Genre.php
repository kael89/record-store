<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

class Genre {
    private $id;
    private $name;

    public function __construct($id, $name = "") {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        if (updateGenre($this->id, ["name" => "$name"])) {
            $this->name = $name;
            return true;
        } else {
            return false;
        }
    }
}
