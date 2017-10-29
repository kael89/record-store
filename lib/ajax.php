<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("tables");
requirePhp("api", "artist");
requirePhp("api", "record");
requirePhp("api", "user");
requirePhp("classes", "user");

switch (getGet("action")) {
    case "get_rows":
        $table = getPost("table");
        $columns = getPost("columns");
        $append = getPost("append");

        $result = (isset($append)) ? getRows($table, $columns, $append) : getRows($table, $columns);
        if ($result) {
            echo json_encode($result);
        }
        break;
    case "login":
        $email = getPost("email");
        $password = getPost("password");

        echo json_encode(loginUser($email, $password));
        break;
    case "add_artist":
        echo ajaxEditArtist(true);
        break;
    case "edit_artist":
        ajaxEditArtist();
        break;
    case "delete_artist":
        ajaxDeleteArtist();
        break;
    case "add_record":
        echo ajaxEditRecord(true);
        break;
    case "edit_record":
        ajaxEditRecord();
        break;
    case "delete_record":
        echo ajaxDeleteRecord();
        break;
    default:
        break;
}

function ajaxEditArtist($insert = false) {
    extract($_POST);
    extract($_FILES);

    if ($insert) {
        $artist = Artist::create($name, $country, $foundationYear, "", "", $bio);
        if (!$artist) {
            return 0;
        }

        $artist->uploadLogo($logoFile);
        $artist->uploadPhoto($photoFile);
        $id = $artist->getId();
    } else {
        // Update database through object methods
        $id = getGet("id");
        if (!$id) {
            return 0;
        }

        $artist = getArtistById($id);
        $artist->setName($name);
        $artist->setCountry($country);
        $artist->setFoundationYear($foundationYear);
        $artist->uploadLogo($logoFile);
        $artist->uploadPhoto($photoFile);
        $artist->setBio($bio);
    }

    return $id;
    
}

function ajaxDeleteArtist() {
    $artist = getArtistById(getGet("id"));
    $artist->delete();
}

function ajaxEditRecord($insert = false) {
    extract($_POST);
    extract($_FILES);
    $tracks = json_decode($tracks, true);

    if ($insert) {
        $record = Record::create($genreId, $title, $releaseDate, "", $price);
        if (!$record) {
            return 0;
        }

        $record->setTracks($tracks);
        $record->uploadCover($coverFile);
        $id = $record->getId();
    } else {
        // Update database through object methods
        $id = getGet("id");
        if (!$id) {
            return 0;
        }

        $record = getRecordById($id);
        $record->setGenreId($genreId);
        $record->setTitle($title);
        $record->setTracks($tracks);
        $record->uploadCover($coverFile);
        $record->setReleaseDate($releaseDate);
        $record->setPrice($price);
    }

    return $id;
    
}

function ajaxDeleteRecord() {
    $record = getRecordById(getGet("id"));
    return $record->delete();
}
