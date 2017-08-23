<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/artist-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/genre-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/label-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/track-api.php";

function updateRecord($id, $row) {
    return updateRow("records", $row, ["recordId =" => $id]);
}

function isRecord($id) {
    return isRow("records", "recordId", $id);
}

function getRecordById($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("records");
    $columns["records.recordId"] = "=$id";

    $result = getRows("records", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Record($recordId, $labelId, $title, $releaseDate, $cover, $price);
}

function getRecordsByLabelId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("records");
    $columns["records.labelId"] = "=$id";

    $results = getRows("records", $columns);
    if (!$results) {
        return null;
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $labelId, $title, $releaseDate, $cover, $price);
    }

    return $records;
}

function getRecordsByLabelName($name, $search = false) {
    $labels = getLabelsByName($name, $search);
    if (!$labels) {
        return null;
    }

    $records = [];
    foreach ($labels as $label) {
        $newRecords = getRecordsByLabelId($label->getId());
        if ($newRecords) {
            $records = array_merge($records, $newRecords);
        }
    }

    return $records;
}

function getRecordsByTitle($title, $search = false) {
    $columns = getColumns("records");
    $columns["records.title"] = ($search) ? " LIKE '$title'" : "='$title'";

    $results = getRows("records", $columns);
    if (!$results) {
        return null;
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $labelId, $title, $releaseDate, $cover, $price);
    }

    return $records;
}

function getRecordsByYear() {
    // to be implemented
}

// $price: either single value (exact match) or array of two values (inclusive range)
function getRecordsByPrice($price) {
    $columns = getColumns("records");
    $columns["records.price"] = is_array($price) ? " BETWEEN $price[0] AND $price[1]" : "=$price";

    $results = getRows("records", $columns);
    if (!$results) {
        return null;
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $labelId, $title, $releaseDate, $cover, $price);
    }

    return $records;
}

function getRecordsByArtistId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("records");
    $columns["records.recordId"] = "=artistsRecords.recordId";
    $joins = ["artistsRecords" => "artistsRecords.artistId=$id"];

    $results = getRows("records", $columns, $joins);
    if (!$results) {
        return null;
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $labelId, $title, $releaseDate, $cover, $price);
    }

    return $records;
}

function getRecordsByArtistName($name, $search = false) {
    $artists = getArtistsByName($name, $search);
    if (!$artists) {
        return null;
    }

    $records = [];
    foreach ($artists as $artist) {
        $newRecords = getRecordsByArtistId($artist->getId());
        if ($newRecords) {
            $records = array_merge($records, $newRecords);
        }
    }

    return $records;
}

function getRecordsByGenreId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("records");
    $columns["records.recordId"] = "=recordsTracks.recordId";
    $joins = [
        "tracks" => "tracks.genreId=$id",
        "recordsTracks" => "recordsTracks.trackId=tracks.trackId"
    ];

    $results = getRows("records", $columns, $joins, true);
    if (!$results) {
        return null;
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $labelId, $title, $releaseDate, $cover, $price);
    }

    return $records;
}

function getRecordsByGenreName($name, $search = false) {
    $genre = getGenreByName($name, $search);
    if (!$genre) {
        return null;
    }

    return getRecordsByGenreId($genre->getId());
}

function getRecordsByTrackId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("records");
    $columns["records.recordId"] = "=recordsTracks.recordId";
    $joins = ["recordsTracks" => "recordsTracks.trackId=$id"];

    $results = getRows("records", $columns, $joins);
    if (!$results) {
        return null;
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $labelId, $title, $releaseDate, $cover, $price);
    }

    return $records;
}

function getRecordsByTrackTitle($title, $search = false) {
    $tracks = getTracksByTitle($title, $search);
    if (!$tracks) {
        return null;
    }

    $records = [];
    foreach ($tracks as $track) {
        $newRecords = getRecordsByTrackId($track->getId());
        if ($newRecords) {
            $records = array_merge($records, $newRecords);
        }
    }

    return $records;
}
