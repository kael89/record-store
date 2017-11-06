<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("tables");
requirePhp("api");
requirePhp("class", "track");

function insertTrack($artistId, $recordId, $title, $position, $duration = 0) {
    $row = [];

    if (!isArtist($artistId) || !isRecord($recordId) || $title === "" || empty($position)) {
        return 0;
    }

    $row["artistId"] = $artistId;
    $row["recordId"] = $recordId;
    $row["title"] = $title;
    $row["position"] = $position;
    $row["duration"] = $duration;

    return insertRow("tracks", $row);
}

function updateTrack($id, $row) {
    return updateRows("tracks", $row, ["trackId" => $id]);
}

function deleteTrack($id) {
    return deleteRows("tracks", ["trackId" => $id]);
}

function isTrack($id) {
    return isRow("tracks", "trackId", $id);
}

function getTracksAll() {
    $results = getRows("tracks");
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $position, $duration);
    }

    return $tracks;
}

function getTrackById($id) {
    if ($id < 1) {
        return null;
    }

    $conditions = [
        ["tracks.trackId =", $id]
    ];

    $result = getRows("tracks", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Track($trackId, $artistId, $recordId, $title, $position, $duration);
}

function getTracksByArtistId($id) {
    if ($id < 1) {
        return [];
    }

    $conditions = [
        ["tracks.artistId =", $id]
    ];

    $results = getRows("tracks", $conditions);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $position, $duration);
    }

    return $tracks;
}

function getTracksByArtistName($name, $search = false) {
    $artists = getArtistsByName($name, $search);
    if (!$artists) {
        return [];
    }

    $tracks = [];
    foreach ($artists as $artist) {
        $tracks[] = getTracksByArtistId($artist->getId());
    }

    return $tracks;
}

function getTracksByTitle($title, $search = false) {
    if ($search) {
        $conditions = [
            ["tracks.title LIKE", $title]
        ];
    } else {
        $conditions = [
            ["tracks.title =", $title]
        ];
    }

    $results = getRows("tracks", $conditions);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $position, $duration);
    }

    return $tracks;
}

// $duration: either single value (exact match) or array of two values (inclusive range)
function getTracksByDuration($duration) {
    if (is_array($duration)) {
        $conditions = [
            ["tracks.duration >=", $duration[0]]
        ];
        $conditions = [
            ["tracks.duration <=", $duration[1]]
        ];
    } else {
        $conditions = [
            ["tracks.duration =", $duration]
        ];
    }

    $results = getRows("tracks", $conditions);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $position, $duration);
    }

    return $tracks;
}

function getTracksByGenreId($id) {
    if ($id < 1) {
        return [];
    }

    $joins = [
        "records" => [
            "records.recordId = tracks.recordId",
            ["records.genreId =", $id]
        ]
    ];

    $results = getRows("tracks", [], $joins, true);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $position, $duration);
    }

    return $tracks;
}

function getTracksByGenreName($name, $search = false) {
    $genre = getGenreByName($name, $search);
    if (!$genre) {
        return [];
    }

    return getTracksByGenreId($genre->getId());
}

// Sort results by position
function getTracksByRecordId($id) {
    if ($id < 1) {
        return [];
    }

    $conditions = [
        ["tracks.recordId =", $id]
    ];
    $order = "ORDER BY tracks.position";
    
    $results = getRows("tracks", $conditions, [], false, $order);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $position, $duration);
    }

    return $tracks;
}

function getTracksByRecordTitle($title, $search = false) {
    $records = getRecordsBytitle($title, $search);
    if (!$records) {
        return [];
    }

    $tracks = [];
    foreach ($records as $record) {
        $newTracks = getTracksByRecordId($record->getId());
        if ($newTracks) {
            $tracks = array_merge($tracks, $newTracks);
        }
    }

    return $tracks;
}
