<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("tables");
requirePhp("api");
requirePhp("class", "genre");

// Returns 0 if name already exists in the table
function createGenre($name) {
    if ($name === "") {
        return null;
    }

    $insertId = dbInsert("genres", ["name" => $name]);
    if (!$insertId) {
        return null;
    }

    return new Genre($insertId, $name);
}

function updateGenre($id, $row) {
    if ($id < 1) {
        return false;
    }

    $conditions = [
        ["genreId =", $id]
    ];

    return dbUpdate("genres", $row, $conditions);
}

function isGenre($id) {
    return isRow("genres", "genreId", $id);
}

function getGenresAll() {
    $results = dbSelect("genres");
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

    $conditions = [
        ["genreId =", $id]
    ];

    $result = dbSelect("genres", $conditions);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Genre($genreId, $name);
}

function getGenreByName($name, $search = false) {
    if ($search) {
        $conditions = [
            ["name =", $name]
        ];
    } else {
        $conditions = [
            ["name =", $name]
        ];
    }

    $result = dbSelect("genres", $conditions);
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

    $joins = [
        "records" => ["records.genreId = genres.genreId"],
        "tracks" => [
            "tracks.genreId = genres.genreId",
            ["artistId =", $id]
        ]
    ];

    $genres = [];
    $results = dbSelect("genres", [], $joins, true);
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

function getGenreByRecordId($id) {
    if ($id < 1) {
        return [];
    }

    $joins = [
        "records" => ["records.genreId = genres.genreId"]
    ];

    $result = dbSelect("genres", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Genre($genreId, $name);
}

function getGenresByRecordTitle($name, $search = false) {
    $records = getRecordsByTitle($name, $search);

    $genres = [];
    foreach ($records as $record) {
        $newRecord = getGenreByRecordId($record->getId());
        if ($newRecord) {
            $genres = array_merge($genres, array($newRecord));
        }
    }

    return $genres;
}

function getGenreByTrackId($id) {
    if ($id < 1) {
        return [];
    }

    $joins = [
        "records" => ["records.genreId = genres.genreId"],
        "tracks" => [
            "tracks.recordId = records.recordId",
            ["trackId =", $id]
        ]
    ];

    $genres = [];
    $results = dbSelect("genres", [], $joins, true);
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
}

function getGenresByTrackTitle($name, $search = "false") {
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
