<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/tables.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/database.php";

function getLabelById($id) {
    $columns = getColumns("labels");
    $columns["labels.labelId"] = "=$id";

    $result = getRows("labels", $columns)[0];
    if (!$result) {
        return null;
    }

    extract($result);
    return new Label($labelId, $name, $country, $foundationYear, $logo);
}

function getLabelsByName($name, $search = false) {
    $columns = getColumns("labels");
    $columns["labels.name"] = ($search) ? " LIKE '$name%'" : "='$name'";

    $results = getRows("labels", $columns);
    if (!$results) {
        return null;
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
    $columns["labels.country"] = ($search) ? " LIKE '$country%'" : "='$country'";

    $results = getRows("labels", $columns);
    if (!$results) {
        return null;
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

function getLabelByRecordId() {
    //to be implemented
}

function getLabelsByArtistId() {
    //to be implemented
}

function getLabelsByArtistName() {
    //to be implemented
}

function getLabelsByGenreId() {
    //to be implemented
}

function getLabelsByGenreName() {
    //to be implemented
}
function getLabelsByRecordTitle() {
    //to be implemented
}

function getLabelByTrackId() {
    //to be implemented
}

function getLabelsByTrackTitle() {
    //to be implemented
}
