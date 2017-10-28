<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("tables");
requirePhp("api");
requirePhp("class", "genre");

// Returns 0 if name already exists in the table
function createGenre($name) {
    if ($name === "") {
        return null;
    }

    $insertId = insertRow("genres", ["name" => $name]);
    return new Genre($insertId, $name);
}

function updateGenre($id, $row) {
    return updateRows("genres", $row, ["genreId" => $id]);
}

function isGenre($id) {
    return isRow("genres", "genreId", $id);
}

function getGenresAll() {
    $columns = getColumns("genres");

    $results = getRows("genres", $columns);
    if (!$results) {
        return [];
    }

    $genres = [];
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
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

function getGenresByRecordId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("genres");
    $columns["tracks.recordId"] = "=$id";
    $joins = ["tracks" => "tracks.genreId=genres.genreId"];

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
    $joins = ["tracks" => "tracks.genreId=genres.genreId"];

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
