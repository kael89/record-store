<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("tables");
requirePhp("api", "artist");
requirePhp("api", "record");
requirePhp("api", "user");

switch (getGet("action")) {
    case "get_rows":
        echo getRows();
        break;
    case "login":
        echo ajaxLogin();
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

function getRows() {
    $table = getPost("table");
    $conditions = getPost("conditions");

    $result = dbSelect($table, $conditions);
    if ($result) {
        return json_encode($result);
    }
}

function ajaxLogin() {
    $email = getPost("email");
    $password = getPost("password");
    $user = getUser($email, $password);
    if (!$user) {
        return false;
    }

    $user->login();
    return true;
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
        $id = getId();
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
    $artist = getArtistById(getId());
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
        $id = getId();
        if (!$id) {
            return 0;
        }

        $record = getRecordById($id);
        $record->setGenreId($genreId);
        $record->setTitle($title);
        $record->setTracks($tracks);
        $record->uploadCover($coverFile);
        $record->setReleaseDate($releaseDate);
        $record->setPrice(parsePrice($price));
    }

    return $id;
    
}

function ajaxDeleteRecord() {
    $record = getRecordById(getId());
    return $record->delete();
}
