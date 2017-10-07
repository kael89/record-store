<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("tables");
requirePhp("api");
requirePhp("class", "track");

function insertTrack($title = "", $artistId, $recordId, $genreId = null, $duration = 0) {
    $row = [];

    if ($title === "" || !isArtist($artistId)) {
        return 0;
    }

    $row["title"] = $title;
    $row["artistId"] = $artistId;
    $row["recordId"] = $recordId;
    $row["genreId"] = $genreId;
    $row["duration"] = $duration;

    return insertRow("tracks", $row);
}

function updateTrack($id, $row) {
    return updateRow("tracks", $row, ["trackId" => $id]);
}

function deleteTrack($id) {
    return deleteRows("tracks", ["trackId" => $id]);
}

function deleteTracksByRecord($recordId) {
    return deleteRows("tracks", ["recordId" => $recordId]);
}

function restoreTracks($tracks) {
    foreach ($tracks as $tracks) {
        insertTrack(
            $track->getTitle(),
            $track->getArtistId(),
            $track->getRecordId(),
            $track->getGenreId(),
            $track->getDuration()
        );
    }
}

function isTrack($id) {
    return isRow("tracks", "trackId", $id);
}

function getTracksAll() {
    $columns = getColumns("tracks");

    $results = getRows("tracks", $columns);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $genreId, $duration);
    }

    return $tracks;
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
    return new Track($trackId, $artistId, $recordId, $title, $genreId, $duration);
}

function getTracksByArtistId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("tracks");
    $columns["tracks.artistId"] = "=$id";

    $results = getRows("tracks", $columns);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $genreId, $duration);
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

function getTracksByGenreId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("tracks");
    $columns["tracks.genreId"] = "=$id";

    $results = getRows("tracks", $columns);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $genreId, $duration);
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

function getTracksByTitle($title, $search = false) {
    $columns = getColumns("tracks");
    $columns["tracks.title"] = ($search) ? " LIKE '$title'" : "='$title'";

    $results = getRows("tracks", $columns);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $genreId, $duration);
    }

    return $tracks;
}

// $duration: either single value (exact match) or array of two values (inclusive range)
function getTracksByDuration($duration) {
    $columns = getColumns("tracks");
    $columns["tracks.duration"] = is_array($duration) ? " BETWEEN $duration[0] AND $duration[1]" : "=$duration";

    $results = getRows("tracks", $columns);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $genreId, $duration);
    }

    return $tracks;
}

function getTracksByLabelId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("tracks");
    $columns["records.labelId"] = "=$id";
    $joins = ["records" => "records.recordId=tracks.recordId"];
    
    $results = getRows("tracks", $columns, $joins);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $genreId, $duration);
    }

    return $tracks;
}

function getTracksByLabelName($name, $search = false) {
    $labels = getLabelsByName($name, $search);
    if (!$labels) {
        return [];
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
        return [];
    }

    $columns = getColumns("tracks");
    $columns["tracks.recordId"] = "=$id";
    
    $results = getRows("tracks", $columns);
    if (!$results) {
        return [];
    }

    $tracks = [];
    foreach ($results as $result) {
        extract($result);
        $tracks[] = new Track($trackId, $artistId, $recordId, $title, $genreId, $duration);
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
