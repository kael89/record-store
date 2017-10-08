<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
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
    case "insert_artist":
        extract($_POST);
        extract($_FILES);

        $id = insertArtist($name, $country, $foundationYear, "", "", $bio);
        $artist = getArtistById($id);
        if ($artist) {
            $artist->uploadLogo($logoFile);
            $artist->uploadPhoto($photoFile);
        }

        echo $id;
        break;
    case "edit_artist":
        extract($_POST);
        extract($_FILES);

        // Update database through object methods
        $id = getGet("id");
        if ($id) {
            $artist = getArtistById($id);
            $artist->setName($name);
            $artist->setCountry($country);
            $artist->setFoundationYear($foundationYear);
            $artist->uploadLogo($logoFile);
            $artist->uploadPhoto($photoFile);
            $artist->setBio($bio);
        }
        break;
    case "delete_artist":
        $artist = getArtistById(getGet("id"));
        $artist->delete();
        break;
    case "insert_record":
        extract($_POST);
        extract($_FILES);

        $id = insertRecord($title, $labelId, $releaseDate, "", $price);
        $record = getRecordById($id);
        if ($record) {
            $record->uploadCover($coverFile);
        }

        echo $id;
        break;
    case "edit_record":
        extract($_POST);
        extract($_FILES);

        // Update database through object methods
        $id = getGet("id");
        if ($id) {
            $record = getRecordById($id);
            $record->setTitle($title);
            // set tracks
            $record->uploadCover($coverFile);
            $record->setReleaseDate($releaseDate);
            $record->setLabel($labelId);
            $record->setPrice($price);
        }
        break;
    case "delete_record":
        $record = getRecordById(getGet("id"));
        $record->delete();
    case "delete_track":
        $track = getTrackById(getGet("id"));
        $track->delete();
    default:
        break;
}
