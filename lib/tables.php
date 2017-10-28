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
        "artists.deleted" => "i"
    ];

    $columns["genres"] = [
        "genres.genreId" => "i",
        "genres.name" => "s",
        "genres.deleted" => "i"
    ];

    $columns["records"] = [
        "records.recordId" => "i",
        "records.title" => "s",
        "records.releaseDate" => "s",
        "records.cover" => "s",
        "records.price" => "d",
        "records.deleted" => "i"
    ];

    $columns["tracks"] = [
        "tracks.trackId" => "i",
        "tracks.artistId" => "i",
        "tracks.recordId" => "i",
        "tracks.genreId" => "i",
        "tracks.title" => "s",
        "tracks.position" => "i",
        "tracks.duration" => "i",
        "tracks.deleted" => "i"
    ];

    $columns["users"] = [
        "users.userId" => "i",
        "users.firstName" => "s",
        "users.lastName" => "s",
        "users.email" => "s",
        "users.password" => "s",
        "users.admin" => "i",
        "users.deleted" => "i"
    ];

    return array_key_exists($tableName, $columns) ? $columns[$tableName] : [];
}

function getColumns($tableName) {
    $table = array_keys(getTable($tableName));
    if (empty($table)) {
        return null;
    }

    return array_fill_keys($table, "");
}

function getParams($tableName, $columns) {
    $table = getTable($tableName);

    $params = "";
    if (!empty($table)) {
        foreach ($columns as $column) {
            $key = $tableName . "." . $column;
            if (array_key_exists($key, $table)) {
                $params .= $table[$key];
            }
        }
    }

    return $params;
}
