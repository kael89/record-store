<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/artist-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/label-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/record-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/track-api.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/classes/Genre.php";

// Returns 0 if name already exists in the table
function createGenre($name) {
    if ($name === "") {
        return null;
    }

    $insertId = insertRow("genres", ["name" => $name]);
    return new Genre($insertId, $name);
}

function updateGenre($id, $row) {
    return updateRow("genres", $row, ["genreId =" => $id]);
}

function isGenre($id) {
    return isRow("genres", "genreId", $id);
}

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
    $columns["genres.name"]  = ($search) ? " LIKE '$name'" : "='$name'";

    $result = getRows("genres", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Genre($genreId, $name);
}

function getGenresByArtistId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("genres");
    $columns["tracks.artistId"] = "=$id";
    $joins = ["tracks" => "tracks.genreId=genres.genreId"];

    $genres = [];
    $results = getRows("genres", $columns, $joins, true);
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
}

function getGenresByArtistName($name, $search = false) {
    $artists = getArtistsByName($name, $search);
    $genres = [];
    foreach ($artists as $artist) {
        $newGenres = getGenresByArtistId($artist->getId());
        if ($newGenres) {
            $genres = array_merge($genres, $newGenres);
        }
    }

    return $genres;
}

function getGenresByLabelId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("genres");
    $columns["records.labelId"] = "=$id";
    $joins = [
        "tracks" => "tracks.genreId=genres.genreId",
        "recordsTracks" => "recordsTracks.trackId=tracks.trackId",
        "records" => "records.recordId=recordsTracks.recordId"
    ];

    $genres = [];
    $results = getRows("genres", $columns, $joins, true);
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
}

function getGenresByLabelName($name, $search = false) {
    $labels = getLabelsByName($name, $search);
    $artists = [];
    foreach ($labels as $label) {
        $newGenres = getGenresByLabelId($label->getId());
        if ($newGenres) {
            $artists = array_merge($artists, $newGenres);
        }
    }

    return $artists;
}

function getGenresByRecordId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("genres");
    $columns["recordsTracks.recordId"] = "=$id";
    $joins = [
        "tracks" => "tracks.genreId=genres.genreId",
        "recordsTracks" => "recordsTracks.trackId=tracks.trackId",
    ];

    $genres = [];
    $results = getRows("genres", $columns, $joins, true);
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
}

function getGenresByRecordTitle($name, $search = false) {
    $records = getRecordsByTitle($name, $search);
    $genres = [];
    foreach ($records as $record) {
        $newRecords = getGenresByRecordId($record->getId());
        if ($newRecords) {
            $genres = array_merge($genres, $newRecords);
        }
    }

    return $genres;
}

function getGenreByTrackId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("genres");
    $columns["tracks.trackId"] = "=$id";
    $joins = [
        "tracks" => "tracks.genreId=genres.genreId",
    ];

    $genres = [];
    $results = getRows("genres", $columns, $joins, true);
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
}

function getGenresByTrackTitle() {
    $tracks = getTracksByTitle($name, $search);
    $genres = [];
    foreach ($tracks as $track) {
        $newTracks = getGenreBytrackId($track->getId());
        if ($newTracks) {
            $genres = array_merge($genres, $newTracks);
        }
    }

    return $genres;
}
