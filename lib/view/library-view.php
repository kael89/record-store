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

function viewPrice($price) {
    if (!is_numeric($price)) {
        return false;
    } elseif (strlen($price) < 5) {
        $price = "&nbsp;$price";
    }

    return str_pad($price, 5, "&nbsp;", STR_PAD_LEFT) . " $";
}

/*** Print ***/
function printLetterNavbar($cat) {
    echo "<ul class=\"pagination\">";
    for ($char = ord('a'); $char <= ord('z'); $char++) {
        $letter = chr($char);
        echo "<li><a href=\"$cat.php?page=browse&letter=$letter\">$letter</a></li>\n";
    }
    echo "</ul>";
}
