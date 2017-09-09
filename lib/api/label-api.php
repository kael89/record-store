<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("tables");
requirePhp("api");
requirePhp("class", "label");

function createLabel($name, $country = "", $foundationYear = 0, $logo = "") {
    $row = [];

    if ($name !== "") {
        $row["name"] = $name;
    } else {
        return null;
    }

    $row["country"] = $country;
    $row["foundationYear"] = $foundationYear;
    $row["logo"] = $logo;
    
    if ($insertId = insertRow("labels", $row)) {
        return new Label($insertId, $name, $country, $foundationYear, $logo);
    } else {
        return null;
    }
}

function updateLabel($id, $row) {
    return updateRow("labels", $row, ["labelId =" => $id]);
}

function isLabel($id) {
    return isRow("labels", "labelId", $id);
}

function getLabelById($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("labels");
    $columns["labels.labelId"] = "=$id";

    $result = getRows("labels", $columns);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Label($labelId, $name, $country, $foundationYear, $logo);
}

function getLabelsByName($name, $search = false) {
    $columns = getColumns("labels");
    $columns["labels.name"] = ($search) ? " LIKE '$name'" : "='$name'";

    $results = getRows("labels", $columns);
    if (!$results) {
        return [];
    }

    $labels = [];
    foreach ($results as $result) {
        extract($result);
        $labels[] = new Label($labelId, $name, $country, $foundationYear, $logo);
    }

    return $labels;
}

function getLabelsByCountry($country, $search = false) {
    $columns = getColumns("labels");
    $columns["labels.country"] = ($search) ? " LIKE '$country'" : "='$country'";

    $results = getRows("labels", $columns);
    if (!$results) {
        return [];
    }

    $labels = [];
    foreach ($results as $result) {
        extract($result);
        $labels[] = new Label($labelId, $name, $country, $foundationYear, $logo);
    }

    return $labels;
}

function getLabelsByFoudationYear() {
    //to be implemented
}

function getLabelByRecordId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("labels");
    $columns["records.recordId"] = "=$id";
    $joins = ["records" => "records.labelId=labels.labelId"];

    $result = getRows("labels", $columns, $joins, true);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Label($labelId, $name, $country, $foundationYear, $logo);
}

function getLabelsByRecordTitle($title, $search = false) {
    $records = getRecordsByTitle($title, $search);
    if (!$records) {
        return [];
    }

    $labels = [];
    foreach ($records as $record) {
        $labels[] = getLabelByRecordId($record->getId());
    }

    return $labels;
}

function getLabelsByArtistId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("labels");
    $columns["tracks.artistId"] = "=$id";
    $joins = [
        "records" => "records.labelId=labels.labelId",
        "tracks" => "tracks.recordId=records.recordId",
    ];

    $results = getRows("labels", $columns, $joins, true);
    if (!$results) {
        return [];
    }

    $labels = [];
    foreach ($results as $result) {
        extract($result);
        $labels[] = new Label($labelId, $name, $country, $foundationYear, $logo);
    }

    return $labels;
}

function getLabelsByArtistName($name, $search = false) {
    $artists = getArtistsByName($name, $search);
    if (!$artists) {
        return [];
    }

    $labels = [];
    foreach ($artists as $artist) {
        $labels[] = getLabelByRecordId($artist->getId());
    }

    return $labels;
}

function getLabelsByGenreId($id) {
    if ($id < 1) {
        return [];
    }

    $columns = getColumns("labels");
    $columns["tracks.genreId"] = "=$id";
    $joins = [
        "records" => "records.labelId=labels.labelId",
        "tracks" => "tracks.recordId=records.recordId",
    ];

    $results = getRows("labels", $columns, $joins, true);
    if (!$results) {
        return [];
    }

    $labels = [];
    foreach ($results as $result) {
        extract($result);
        $labels[] = new Label($labelId, $name, $country, $foundationYear, $logo);
    }

    return $labels;
}

function getLabelsByGenreName($name, $search = false) {
    $genre = getGenreByName($name, $search);
    if (!$genre) {
        return [];
    }

    return getLabelsByGenreId($genre->getId());
}

function getLabelByTrackId($id) {
    if ($id < 1) {
        return null;
    }

    $columns = getColumns("labels");
    $columns["tracks.trackId"] = "=$id";
    $joins = [
        "records" => "records.labelId=labels.labelId",
        "tracks" => "tracks.recordId=records.recordId",
    ];

    $result = getRows("labels", $columns, $joins);
    if (!$result) {
        return null;
    }

    extract($result[0]);
    return new Label($labelId, $name, $country, $foundationYear, $logo);
}

function getLabelsByTrackTitle($title, $search = false) {
    $tracks = getTracksByTitle($title, $search);
    if (!$tracks) {
        return [];
    }

    $labels = [];
    foreach ($tracks as $track) {
        $labels[] = getLabelByTrackId($track->getId());
    }

    return $labels;
}
