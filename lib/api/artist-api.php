<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("tables");
requirePhp("api");
requirePhp("class", "artist");

function insertArtist($name, $country = "", $foundationYear = 0, $logo = "", $photo = "", $bio = "") {
    if ($name !== "") {
        $row["name"] = $name;
    } else {
        return 0;
    }

    $row["country"] = $country;
    $row["foundationYear"] = ($foundationYear > 1900) ? $foundationYear : 0;
    $row["logo"] = $logo;
    $row["photo"] = $photo;
    $row["bio"] = $bio;

    return insertRow("artists", $row);
}

function updateArtist($id, $row) {
    if ($id < 1) {
        return false;
    }

    return updateRows("artists", $row, ["artistId" => $id]);
}

function deleteArtist($id) {
    deleteRows("artists", ["artistId" => $id]);
}

function isArtist($id) {
    return isRow("artists", "artistId", $id);
}

function getArtistsAll() {
    $order = "ORDER BY artists.name";

    $artists = [];
    $results = getRows("artists", [], [], false, $order);
    foreach ($results as $result) {
        extract($result);
        $artists[] = new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
    }

    return $artists;
}

function getArtistById($id) {
    if ($id < 1) {
        return null;
    }

    $conditions = [
        ["artistId =", $id]
    ];

    $result = getRows("artists", $conditions);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
}

function getArtistsByName($name, $search = false) {
    if ($search) {
        $conditions = [
            ["name LIKE", $name]
        ];
    } else {
        $conditions = [
            ["name =", $name]
        ];
    }
    $order = "ORDER BY artists.name";

    $artists = [];
    $results = getRows("artists", $conditions, [], false, $order);
    foreach ($results as $result) {
        extract($result);
        $artists[] = new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
    }

    return $artists;
}

function getArtistsByCountry($country, $search = false) {
    if ($search) {
        $conditions = [
            ["country LIKE", $country]
        ];
    } else {
        $conditions = [
            ["country =", $country]
        ];
    }
    $order = "ORDER BY artists.country";

    $artists = [];
    $results = getRows("artists", $columns);
    foreach ($results as $result) {
        extract($result);
        $artists[] = new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
    }

    return $artists;
}

function getArtistsByFoundationYear() {
    // to be implemented
}

function getArtistsByGenreId($id) {
    if ($id < 1) {
        return [];
    }

    $joins = [
        "tracks" => ["tracks.artistId = artists.artistId"],
        "records" => [
            "records.recordId = tracks.recordsId",
            ["genreId =", $id],
        ]
    ];

    $artists = [];
    $results = getRows("artists", [], $joins, true);
    foreach ($results as $result) {
        extract($result);
        $artists[] = new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
    }

    return $artists;
}

function getArtistsByGenreName($name, $search = false) {
    $genre = getGenreByName($name, $search);
    $artists = [];
    if ($genre) {
        $artists = getArtistsByGenreId($genre->getId());
    }

    return $artists;
}

function getArtistsByRecordId($id) {
    if ($id < 1) {
        return [];
    }

    $joins = [
        "tracks" => [
            "tracks.artistId = artists.artistId",
            ["recordId =", $id]
        ]
    ];

    $artists = [];
    $results = getRows("artists", [], $joins, true);
    foreach ($results as $result) {
        extract($result);
        $artists[] = new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
    }

    return $artists;
}

function getArtistsByRecordTitle($title, $search = false) {
    $records = getRecordsByTitle($title, $search);
    $artists = [];
    foreach ($records as $record) {
        $artists = array_merge($artists, getArtistsByRecordId($record->getId()));
    }

    return $artists;
}

function getArtistByTrackId($id) {
    if ($id < 1) {
        return null;
    }

    $conditions = [
        ["tracks.trackId =", $id]
    ];
    $joins = [
        "tracks" => [
            "tracks.artistId = artists.artistId",
            ["trackId =", $id]
        ]
    ];

    $result = getRows("artists", $conditions, $joins);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
}

function getArtistsByTrackTitle($title, $search = false) {
    $tracks = getTracksByTitle($title, $search);
    $artists = [];
    foreach ($tracks as $track) {
        $artists[] = getArtistByTrackId($track->getId());
    }

    return $artists;
}
