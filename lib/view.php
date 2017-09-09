<?php
requirePhp("class", "record");

function viewArtistName($record) {
    $artists = $record->getArtists();
    return (count($artists) == 1) ? $artists[0]->getName() : "V.A."; 
}

function viewDate($date) {
    return date("F j, Y", strtotime($date));
}

function viewDuration($secs) {
    $min = (int)($secs / 60);
    $secs -= $min * 60;

    return $min . ":" . str_pad($secs, 2, '0', STR_PAD_LEFT);
}