<?php

function getTable($tableName) {
    $columns = [];

    $columns["artists"] = [
        "artists.artistId" => "i",
        "artists.name" => "s",
        "artists.country" => "s",
        "artists.foundationYear" => "s",
        "artists.logo" => "s",
        "artists.photo" => "s",
        "artists.bio" => "s",
    ];

    $columns["genres"] = [
        "genres.genreId" => "i",
        "genres.name" => "s"
    ];

    $columns["labels"] = [
        "labels.labelId" => "i",
        "labels.name" => "s",
        "labels.country" => "s",
        "labels.foundationYear" => "s",
        "labels.logo" => "s"
    ];

    $columns["records"] = [
        "records.recordId" => "i",
        "records.labelId" => "i",
        "records.title" => "s",
        "records.releaseDate" => "s",
        "records.cover" => "s",
        "records.price" => "d"
    ];

    $columns["tracks"] = [
        "tracks.trackId" => "i",
        "tracks.artistId" => "i",
        "tracks.recordId" => "i",
        "tracks.genreId" => "i",
        "tracks.title" => "s",
        "tracks.duration" => "i"
    ];

    $columns["users"] = [
        "users.userId" => "i",
        "users.firstName" => "s",
        "users.lastName" => "s",
        "users.email" => "s",
        "users.password" => "s",
        "users.admin" => "i"
    ];

    return $columns[$tableName];
}

function getColumns($tableName) {
    $table = array_keys(getTable($tableName));
    if (empty($table)) {
        return null;
    }

    return array_fill_keys($table, "");
}

function getParams($tableName, $columns) {
    $params = "";

    $table = getTable($tableName);
    if (!empty($table)) {
        foreach ($columns as $column) {
            $value = $table[$tableName . "." . $column];
            if (!$value) {
                continue;
            }

            $params .= $value; 
        }
    }

    return $params;
}
