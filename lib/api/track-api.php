<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

function getTrackById($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("tracks");
    $columns["tracks.trackId"] = "=$id";

    $result = getRows("tracks", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Track($trackId, $title, $duration);
}

function getTracksByArtistId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("tracks");
    $columns["tracks.artistId"] = "=$id";

    $results = getRows("tracks", $columns);
    if (!$results) {
        return null;
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $title, $duration);
    }

    return $tracks;
}

function getTracksByArtistName() {
    // to be implemented
}

function getTracksByGenreId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("tracks");
    $columns["tracks.genreId"] = "=$id";

    $results = getRows("tracks", $columns);
    if (!$results) {
        return null;
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $title, $duration);
    }

    return $tracks;
}

function getTracksByGenreName() {
    // to be implemented
}

function getTracksByTitle($title, $search = false) {
    $columns = getColumns("tracks");
    $columns["tracks.title"] = ($search) ? " LIKE '$title%'" : "='$title'";

    $results = getRows("tracks", $columns);
    if (!$results) {
        return null;
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $title, $duration);
    }

    return $tracks;
}

function getTracksByDuration() {
    // to be implemented
}

function getTracksByLabelId() {
    // to be implemented
}

function getTracksByLabelName() {
    // to be implemented
}

function getTracksByRecordId() {
    // to be implemented
}

function getTracksByRecordTitle() {
    // to be implemented
}
