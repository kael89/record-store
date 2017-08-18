<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

function getArtistById($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("artists");
    $columns["artists.artistId"] = "=$id";

    $result = getRows("artists", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Artist($artistId, $name, $country, $foundationYear, $logo, $photo);
}

function getArtistsByName($name, $search = false) {
    $columns = getColumns("artists");
    $columns["artists.name"] = ($search) ? " LIKE '$name%'" : "='$name'";

    $results = getRows("artists", $columns);
    if (!$results) {
        return null;
    }

    $artists = [];
    foreach ($results as $result) {
        extract($result);
        $artists[] = new Artist($artistId, $name, $country, $foundationYear, $logo, $photo);
    }

    return $artists;
}

function getArtistsByCountry($country, $search = false) {
    $columns = getColumns("artists");
    $columns["artists.country"] = ($search) ? " LIKE '$country%'" : "='$country'";

    $results = getRows("artists", $columns);
    if (!$results) {
        return null;
    }

    $artists = [];
    foreach ($results as $result) {
        extract($result);
        $artists[] = new Artist($artistId, $name, $country, $foundationYear, $logo, $photo);
    }

    return $artists;
}

function getArtistsByFoundationYear() {
    // to be implemented
}

function getArtistsByGenreId() {
    // to be implemented
}

function getArtistsByGenreName() {
    // to be implemented
}

function getArtistsByLabelId() {
    // to be implemented
}

function getArtistsByLabelName() {
    // to be implemented
}

function getArtistsByRecordId() {
    // to be implemented
}

function getArtistsByRecordTitle() {
    // to be implemented
}

function getArtistByTrackId() {
    // to be implemented
}

function getArtistsByTrackTitle() {
    // to be implemented
}
