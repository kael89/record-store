<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

function getGenreById($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("genres");
    $columns["genres.genreId"] = "=$id";

    $result = getRows("genres", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Genre($genreId, $name);
}

function getGenreByName($name, $search = false) {
    $columns = getColumns("genres");
    $columns["genres.name"]  = ($search) ? " LIKE '$name%'" : "='$name'";

    $result = getRows("genres", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Genre($genreId, $name);
}

function getGenresByArtistId() {
    // to be implemented
}

function getGenresByArtistName() {
    // to be implemented
}

function getGenresByLabelId() {
    // to be implemented
}

function getGenresByLabelName() {
    // to be implemented
}

function getGenresByRecordId() {
    // to be implemented
}

function getGenresByRecordTitle() {
    // to be implemented
}

function getGenreByTrackId() {
    // to be implemented
}

function getGenresByTrackTitle() {
    // to be implemented
}
