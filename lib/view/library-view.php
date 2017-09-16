<?php
/*** View ***/
function viewDate($date) {
    return date("F j, Y", strtotime($date));
}

function viewDuration($secs) {
    $min = (int)($secs / 60);
    $secs -= $min * 60;

    return $min . ":" . str_pad($secs, 2, '0', STR_PAD_LEFT);
}

/*** Print ***/
function printLetterNavbar($page) {
    echo "<ul class=\"pagination\">";
    for ($char = ord('a'); $char <= ord('z'); $char++) {
        $letter = chr($char);
        echo "<li><a href=\"?page=$page&letter=$letter\">$letter</a></li>\n";
    }
    echo "</ul>";
}
