<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/artist-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/label-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/record-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/track-api.php";

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
    $columns = getColumns("genres");
    $columns["tracks.artistId"] = "=$id";
    $joins = ["tracks" => "tracks.genreId=genres.genreId"];

    $results = getRows("genres", $columns, $joins, true);
    if (!$results) {
        return null;
    }

    $genres = [];
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
}

function getGenresByArtistName($name, $search = false) {
    $artists = getartistsByName($name, $search);
    if (!$artists) {
        return null;
    }

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
    $columns = getColumns("genres");
    $columns["records.labelId"] = "=$id";
    $joins = [
        "tracks" => "tracks.genreId=genres.genreId",
        "recordsTracks" => "recordsTracks.trackId=tracks.trackId",
        "records" => "records.recordId=recordsTracks.recordId"
    ];

    $results = getRows("genres", $columns, $joins, true);
    if (!$results) {
        return null;
    }

    $genres = [];
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
}

function getGenresByLabelName($name, $search = false) {
    $labels = getLabelsByName($name, $search);
    if (!$labels) {
        return null;
    }

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
    $columns = getColumns("genres");
    $columns["recordsTracks.recordId"] = "=$id";
    $joins = [
        "tracks" => "tracks.genreId=genres.genreId",
        "recordsTracks" => "recordsTracks.trackId=tracks.trackId",
    ];

    $results = getRows("genres", $columns, $joins, true);
    if (!$results) {
        return null;
    }

    $genres = [];
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
}

function getGenresByRecordTitle($name, $search = false) {
    $records = getRecordsByTitle($name, $search);
    if (!$records) {
        return null;
    }

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
    $columns = getColumns("genres");
    $columns["tracks.trackId"] = "=$id";
    $joins = [
        "tracks" => "tracks.genreId=genres.genreId",
    ];

    $results = getRows("genres", $columns, $joins, true);
    if (!$results) {
        return null;
    }

    $genres = [];
    foreach ($results as $result) {
        extract($result);
        $genres[] = new Genre($genreId, $name);
    }

    return $genres;
}

function getGenresByTrackTitle() {
    $tracks = getTracksByTitle($name, $search);
    if (!$tracks) {
        return null;
    }

    $genres = [];
    foreach ($tracks as $track) {
        $newTracks = getGenreBytrackId($track->getId());
        if ($newTracks) {
            $genres = array_merge($genres, $newTracks);
        }
    }

    return $genres;
}
