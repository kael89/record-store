<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

function createTrack($artistId, $genreId) {
    if ($artistId < 0) {
        return null;
    }

    $insertId = insertRow("tracks", ["name" => $name]);
    return new Genre($insertId, $name);
}

function updateTrack($id, $row) {
    return updateRow("tracks", $row, ["trackId =" => $id]);
}

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
    return new Track($trackId, $title, $duration, $artistId, $genreId);
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
        $tracks[] = new Track($trackId, $title, $duration, $artistId, $genreId);
    }

    return $tracks;
}

function getTracksByArtistName($name, $search = false) {
    $artists = getArtistsByName($name, $search);
    if (!$artists) {
        return null;
    }

    $tracks = [];
    foreach ($artists as $artist) {
        $tracks[] = getTracksByArtistId($artist->getId());
    }

    return $tracks;
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
        $tracks[] = new Track($trackId, $title, $duration, $artistId, $genreId);
    }

    return $tracks;
}

function getTracksByGenreName($name, $search = false) {
    $genre = getGenreByName($name, $search);
    if (!$genre) {
        return null;
    }

    return getTracksByGenreId($genre->getId());
}

function getTracksByTitle($title, $search = false) {
    $columns = getColumns("tracks");
    $columns["tracks.title"] = ($search) ? " LIKE '$title'" : "='$title'";

    $results = getRows("tracks", $columns);
    if (!$results) {
        return null;
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $title, $duration, $artistId, $genreId);
    }

    return $tracks;
}

// $duration: either single value (exact match) or array of two values (inclusive range)
function getTracksByDuration($duration) {
    $columns = getColumns("tracks");
    $columns["tracks.duration"] = is_array($duration) ? " BETWEEN $duration[0] AND $duration[1]" : "=$duration";

    $results = getRows("tracks", $columns);
    if (!$results) {
        return null;
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $title, $duration, $artistId, $genreId);
    }

    return $tracks;
}

function getTracksByLabelId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("tracks");
    $columns["records.labelId"] = "=$id";
    $joins = [
        "recordsTracks" => "recordsTracks.trackId=tracks.trackId",
        "records" => "records.recordId=recordsTracks.recordId"
    ];
    
    $results = getRows("tracks", $columns, $joins);
    if (!$results) {
        return null;
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $title, $duration, $artistId, $genreId);
    }

    return $tracks;
}

function getTracksByLabelName($name, $search = false) {
    $labels = getLabelsByName($name, $search);
    if (!$labels) {
        return null;
    }

    $tracks = [];
    foreach ($labels as $label) {
        $newTracks = getTracksByLabelId($label->getId());
        if ($newTracks) {
            $tracks = array_merge($tracks, $newTracks);
        }
    }

    return $tracks;
}

function getTracksByRecordId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("tracks");
    $columns["recordsTracks.recordId"] = "=$id";
    $joins = ["recordsTracks" => "recordsTracks.trackId=tracks.trackId"];
    
    $results = getRows("tracks", $columns, $joins);
    if (!$results) {
        return null;
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $title, $duration, $artistId, $genreId);
    }

    return $tracks;
}

function getTracksByRecordTitle($title, $search = false) {
    $records = getRecordsBytitle($title, $search);
    if (!$records) {
        return null;
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
