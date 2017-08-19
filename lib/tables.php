<?php

function getColumns($table) {
    $columns["artists"] = [
        "artists.artistId" => "",
        "artists.name" => "",
        "artists.country" => "",
        "artists.foundationYear" => "",
        "artists.logo" => "",
        "artists.photo" => "",
    ];

    $columns["genres"] = [
        "genres.genreId" => "",
        "genres.name" => ""
    ];

    $columns["labels"] = [
        "labels.labelId" => "",
        "labels.name" => "",
        "labels.country" => "",
        "labels.foundationYear" => "",
        "labels.logo" => ""
    ];

    $columns["records"] = [
        "records.recordId" => "",
        "records.labelId" => "",
        "records.title" => "",
        "records.releaseDate" => "",
        "records.cover" => "",
        "records.price" => ""
    ];

    $columns["tracks"] = [
        "tracks.trackId" => "",
        "tracks.artistId" => "",
        "tracks.genreId" => "",
        "tracks.title" => "",
        "tracks.duration" => ""
    ];

    return (isset($columns[$table])) ? $columns[$table] : null;
}