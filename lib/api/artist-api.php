<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/genre-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/label-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/record-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/track-api.php";

function updateArtist($id, $row) {
    return updateRow("artists", $row, ["artistId =" => $id]);
}

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
    $columns["artists.name"] = ($search) ? " LIKE '$name'" : "='$name'";

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
    $columns["artists.country"] = ($search) ? " LIKE '$country'" : "='$country'";

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

function getArtistsByGenreId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("artists");
    $columns["genres.genreId"] = "=$id";
    $joins = [
        "tracks" => "tracks.artistId=artists.artistId",
        "genres" => "genres.genreId=tracks.genreId"
    ];

    $results = getRows("artists", $columns, $joins, true);
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

function getArtistsByGenreName($name, $search = false) {
    $genre = getGenreByName($name, $search);
    if (!$genre) {
        return null;
    }

    return getArtistsByGenreId($genre->getId());
}

function getArtistsByLabelId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("artists");
    $columns["records.labelId"] = "=$id";
    $joins = [
        "artistsRecords" => "artistsRecords.artistId=artists.artistId",
        "records" => "records.recordId=artistsRecords.recordId"
        // "labels" => "labels.labelId=records.labelId"
    ];

    $results = getRows("artists", $columns, $joins, true);
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

function getArtistsByLabelName($name, $search = false) {
    $labels = getLabelsByName($name, $search);
    if (!$labels) {
        return null;
    }

    $artists = [];
    foreach ($labels as $label) {
        $artists = array_merge($artists, getArtistsByLabelId($label->getId()));
    }

    return $artists;
}

function getArtistsByRecordId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("artists");
    $columns["records.recordId"] = "=$id";
    $joins = [
        "artistsRecords" => "artistsRecords.artistId=artists.artistId",
        "records" => "records.recordId=artistsRecords.recordId",
    ];

    $results = getRows("artists", $columns, $joins);
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

function getArtistsByRecordTitle($title, $search = false) {
    $records = getRecordsByTitle($title, $search);
    if (!$records) {
        return null;
    }

    $artists = [];
    foreach ($records as $record) {
        $artists = array_merge($artists, getArtistsByRecordId($record->getId()));
    }

    return $artists;
}

function getArtistByTrackId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("artists");
    $columns["tracks.trackId"] = "=$id";
    $joins = [
        "tracks" => "tracks.artistId=artists.artistId",
    ];

    $results = getRows("artists", $columns, $joins);
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

function getArtistsByTrackTitle($title, $search = false) {
    $tracks = getTracksByTitle($title, $search);
    if (!$tracks) {
        return null;
    }

    $artists = [];
    foreach ($tracks as $track) {
        $artists = array_merge($artists, getArtistByTrackId($track->getId()));
    }

    return $artists;
}
