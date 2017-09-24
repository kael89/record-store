<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("tables");
requirePhp("api");
requirePhp("class", "artist");

function createArtist($name, $country = "", $foundationYear = 0, $logo = "", $photo = "", $bio = "") {
    if ($name !== "") {
        $row["name"] = $name;
    } else {
        return null;
    }

    $row["country"] = $country;
    $row["foundationYear"] = ($foundationYear > 1900) ? $foundationYear : 0;
    $row["logo"] = $logo;
    $row["photo"] = $photo;
    $row["bio"] = $bio;

    if ($insertId = insertRow("tracks", $row)) {
        return new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
    } else {
        return null;
    }
}

function updateArtist($id, $row) {
    if ($id < 1) {
        return false;
    }

    return updateRow("artists", $row, ["artistId=" => $id]);
}

function isArtist($id) {
    return isRow("artists", "artistId", $id);
}

function getArtistsAll($sort = true) {
    $columns = getColumns("artists");
    $orderyBy = ($sort) ? "ORDER BY artists.name" : "";

    $results = getRows("artists", $columns, [], false, $orderyBy);
    if (!$results) {
        return [];
    }

    $artists = [];
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

    $columns = getColumns("artists");
    $columns["artists.artistId"] = "=$id";

    $result = getRows("artists", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
}

function getArtistsByName($name, $search = false) {
    $columns = getColumns("artists");
    $columns["artists.name"] = ($search) ? " LIKE '$name'" : "='$name'";

    $artists = [];
    $results = getRows("artists", $columns);
    foreach ($results as $result) {
        extract($result);
        $artists[] = new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
    }

    return $artists;
}

function getArtistsByCountry($country, $search = false) {
    $columns = getColumns("artists");
    $columns["artists.country"] = ($search) ? " LIKE '$country'" : "='$country'";

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

    $columns = getColumns("artists");
    $columns["genres.genreId"] = "=$id";
    $joins = [
        "tracks" => "tracks.artistId=artists.artistId",
        "genres" => "genres.genreId=tracks.genreId"
    ];

    $artists = [];
    $results = getRows("artists", $columns, $joins, true);
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

function getArtistsByLabelId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("artists");
    $columns["records.labelId"] = "=$id";
    $joins = [
        "tracks" => "tracks.artistId=artists.artistId",
        "records" => "records.recordId=tracks.recordId"
    ];

    $artists = [];
    $results = getRows("artists", $columns, $joins, true);
    foreach ($results as $result) {
        extract($result);
        $artists[] = new Artist($artistId, $name, $country, $foundationYear, $logo, $photo, $bio);
    }

    return $artists;
}

function getArtistsByLabelName($name, $search = false) {
    $labels = getLabelsByName($name, $search);
    $artists = [];
    foreach ($labels as $label) {
        $artists = array_merge($artists, getArtistsByLabelId($label->getId()));
    }

    return $artists;
}

function getArtistsByRecordId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("artists");
    $columns["tracks.recordId"] = "=$id";
    $joins = ["tracks" => "tracks.artistId=artists.artistId"];

    $artists = [];
    $results = getRows("artists", $columns, $joins, true);
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

    $columns = getColumns("artists");
    $columns["tracks.trackId"] = "=$id";
    $joins = ["tracks" => "tracks.artistId=artists.artistId"];

    $result = getRows("artists", $columns, $joins);
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
