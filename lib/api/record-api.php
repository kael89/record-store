<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("tables");
requirePhp("api");
requirePhp("class", "record");

function insertRecord($genreId, $title, $releaseDate = "", $cover = "", $price = 0) {
    $row = [];

    if (!isGenre($genreId) && $title === "") {
        return 0;
    }

    $row["genreId"] = $genreId;
    $row["title"] = $title;
    $row["releaseDate"] = $releaseDate;
    $row["cover"] = $cover;
    $row["price"] = $price;

    return insertRow("records", $row);
}

function updateRecord($id, $row) {
    return updateRows("records", $row, ["recordId" => $id]);
}

function deleteRecord($id) {
    deleteRows("records", ["recordId" => $id]);
}

function isRecord($id) {
    return isRow("records", "recordId", $id);
}

function getRecordsAll($sort = true) {
    $orderyBy = ($sort) ? "ORDER BY records.title" : "";

    $results = getRows("records", [], [], false, $orderyBy);
    if (!$results) {
        return [];
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $genreId, $title, $releaseDate, $cover, $price);
    }

    return $records;
}

function getRecordById($id) {
    if ($id < 1) {
        return null;
    }

    $conditions = [
        ["recordId =", $id]
    ];

    $result = getRows("records", $conditions);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Record($recordId, $genreId, $title, $releaseDate, $cover, $price);
}

function getRecordsByGenreId($id) {
    if ($id < 1) {
        return [];
    }

    $conditions = [
        ["genreId =", $id]
    ];

    $results = getRows("records", $conditions);
    if (!$results) {
        return [];
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $genreId, $title, $releaseDate, $cover, $price);
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

// Sort results by title
function getRecordsByTitle($title, $search = false) {
    if ($search) {
        $conditions = [
            ["title LIKE", $title]
        ];
    } else {
        $conditions = [
            ["title =", $title]
        ];
    }

    $order = "ORDER BY records.title";

    $results = getRows("records", $conditions, [], false, $order);
    if (!$results) {
        return [];
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $genreId, $title, $releaseDate, $cover, $price);
    }

    return $records;
}

function getRecordsByYear() {
    // to be implemented
}

// $price: either single value (exact match) or array of two values (inclusive range)
function getRecordsByPrice($price) {
    if (is_array($price)) {
        $conditions= [
            ["price >=", $price[0]]
        ];
        $conditions = [
            ["price <=", $price[1]]
        ];
    } else {
        $conditions = [
            ["price =", $price]
        ];
    }

    $results = getRows("records", $conditions);
    if (!$results) {
        return [];
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $genreId, $title, $releaseDate, $cover, $price);
    }

    return $records;
}

function getRecordsByArtistId($id) {
    if ($id < 1) {
        return [];
    }

    $joins = [
        "tracks" => [
            "tracks.recordId = records.recordId",
            ["artistId =", $id]
        ]
    ];

    $results = getRows("records", [], $joins, true);
    if (!$results) {
        return [];
    }

    $records = [];
    foreach ($results as $result) {
        extract($result);
        $records[] = new Record($recordId, $genreId, $title, $releaseDate, $cover, $price);
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

function getRecordByTrackId($id) {
    if ($id < 1) {
        return null;
    }

    $joins = [
        "tracks" => [
            "tracks.recordId = records.recordId",
            ["trackId =", $id]
        ]
    ];

    $results = getRows("records", [], $joins);
    if (!$results) {
        return null;
    }

    extract($results[0]);
    return new Record($recordId, $genreId, $title, $releaseDate, $cover, $price);
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
