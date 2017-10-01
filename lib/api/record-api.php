<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("tables");
requirePhp("api");
requirePhp("class", "record");

function createRecord($title = "", $labelId = 0, $releaseDate = "", $cover = "", $price = 0) {
    $row = [];

    if ($title !== "" && isLabel($labelId)) {
        $row["title"] = $title;
        $row["labelId"] = $labelId;
    } else {
        return null;
    }

    $row["releaseDate"] = $releaseDate;
    $row["cover"] = $cover;
    $row["price"] = $price;

    if ($insertId = insertRow("records", $row)) {
        return new Record($insertId, $labelId, $title, $releaseDate, $cover, $price);
    } else {
        return null;
    }
}

function updateRecord($id, $row) {
    return updateRow("records", $row, ["recordId" => $id]);
}

function isRecord($id) {
    return isRow("records", "recordId", $id);
}

function getRecordsAll($sort = true) {
    $columns = getColumns("records");
    $orderyBy = ($sort) ? "ORDER BY records.title" : "";

    $results = getRows("records", $columns, [], false, $orderyBy);
    if (!$results) {
        return [];
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $labelId, $title, $releaseDate, $cover, $price);
    }

    return $records;
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
        return [];
    }

    $columns = getColumns("records");
    $columns["records.labelId"] = "=$id";

    $results = getRows("records", $columns);
    if (!$results) {
        return [];
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
        return [];
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
    $order = "ORDER BY records.title";

    $results = getRows("records", $columns, [], false, $order);
    if (!$results) {
        return [];
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
        return [];
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
        return [];
    }

    $columns = getColumns("records");
    $columns["tracks.artistId"] = "=$id";
    $joins = ["tracks" => "tracks.recordId=records.recordId"];

    $results = getRows("records", $columns, $joins, true);
    if (!$results) {
        return [];
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
        return [];
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
        return [];
    }

    $columns = getColumns("records");
    $columns["tracks.genreId"] = "=$id";
    $joins = ["tracks" => "tracks.recordId=records.recordId"];

    $results = getRows("records", $columns, $joins, true);
    if (!$results) {
        return [];
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
        return [];
    }

    return getRecordsByGenreId($genre->getId());
}

function getRecordByTrackId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("records");
    $columns["tracks.trackId"] = "=$id";
    $joins = ["tracks.recordId" => "records.recordId"];

    $results = getRows("records", $columns, $joins);
    if (!$results) {
        return null;
    }

    extract($result[0]);
    return new Record($recordId, $labelId, $title, $releaseDate, $cover, $price);
}

function getRecordsByTrackTitle($title, $search = false) {
    $tracks = getTracksByTitle($title, $search);
    if (!$tracks) {
        return [];
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
