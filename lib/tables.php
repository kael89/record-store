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
        "genres.name" => "s",
    ];

    $columns["records"] = [
        "records.recordId" => "i",
        "records.genreId" => "i",
        "records.title" => "s",
        "records.releaseDate" => "s",
        "records.cover" => "s",
        "records.price" => "d",
    ];

    $columns["tracks"] = [
        "tracks.trackId" => "i",
        "tracks.artistId" => "i",
        "tracks.recordId" => "i",
        "tracks.title" => "s",
        "tracks.position" => "i",
        "tracks.duration" => "i",
    ];

    $columns["users"] = [
        "users.userId" => "i",
        "users.firstName" => "s",
        "users.lastName" => "s",
        "users.email" => "s",
        "users.password" => "s",
        "users.admin" => "i",
    ];

    return array_key_exists($tableName, $columns) ? $columns[$tableName] : [];
}

function getColumns($tableName) {
    $table = getTable($tableName);
    if (empty($table)) {
        return null;
    }

    return array_keys($table);
}

function getParams($tableName, $columns) {
    $table = getTable($tableName);
    if (!$table) {
        return [];
    }

    $params = "";
    foreach ($columns as $column) {
        $key = $tableName . "." . explode(" ", $column)[0];

        if (array_key_exists($key, $table)) {
            $params .= $table[$key];
        }
    }

    return ($params) ? (array)$params : [];
}
