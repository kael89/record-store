<?php
requirePhp("class", "record");

function viewArtistName($record) {
    $artists = $record->getArtists();
    return (count($artists) == 1) ? $artists[0] : "V.A."; 
}

function viewDate($date) {
    return date_format(new DateTime($date), "F j, Y");
}

function viewDuration($secs) {
    $min = $secs / 60;
    $secs -= $min * 60;

    return $min . ":" . $secs;
}