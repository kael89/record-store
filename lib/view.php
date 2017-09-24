<?php
requirePhp("class");

/*** View ***/
function viewArtistName($artists) {
    switch (count($artists)) {
        case 0:
            return "N/A";
        case 1:
            return $artists[0]->getName();
        default:
            return "V.A";
    }
}

function viewArtistLink($artists) {
    $name = viewArtistName($artists);

    if (count($artists) == 1) {
        $id = $artists[0]->getId();
        $link = "<a title=\"$name details\" href=\"artists.php?page=details&id=$id\">$name</a>";
    } else {
        $link = $name;
    }

    return $link;
}

function viewRecordLink($record) {
    $id = $record->getId();
    $title = $record->getTitle();

    return "<a title=\"$title details\" href=\"records.php?page=details&id=$id\">$title</a>";
}

function viewGenreName($genres) {
    switch (count($genres)) {
        case 0:
            return "Other";
        case 1:
            return $genres[0]->getName();
        default:
            return "Various";
    }
}

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

function printRecords($records, $showArtists = true) {
    define("RECORDS_PER_LINE", 4);
    $size = (int)(12 / RECORDS_PER_LINE);
    if ($size < 1) {
        $size = 1;
    }

    foreach ($records as $i => $record) {
        $rowStart = ($i % RECORDS_PER_LINE == 0) ? "<div class=\"row\">" : "";
        $rowEnd = ($i % RECORDS_PER_LINE == RECORDS_PER_LINE - 1) ? "</div>" : "";

        $artistLink = ($showArtists) ? viewArtistLink($record->getArtists()) . " - " : "";
        $recordLink = viewRecordLink($record);

        echo <<<_END
$rowStart
    <div class="record col-sm-$size">
        <figure class="text-center">
            <img src="{$record->getCoverImage()}" class="img-thumbnail" alt="{$record->getTitle()} cover"><br>
            <figcaption><span class="i">$artistLink</span> $recordLink</figcaption>
        </figure>
    </div>
$rowEnd
_END;
    }
}