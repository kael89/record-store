<?php
requirePhp("class", "record");

/*** FORMAT DATA ***/
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

/*** PRINT HTML ***/
function printLetterNavbar($page) {
    echo "<ul class=\"pagination\">";
    for ($char = ord('a'); $char <= ord('z'); $char++) {
        $letter = chr($char);
        echo "<li><a href=\"?page=$page&letter=$letter\">$letter</a></li>\n";
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

        $recordId = $record->getId();
        $title = $record->getTitle();
        $cover = $record->getCoverImage();

        $artists = $record->getArtists();
        $artistName = viewArtistName($record);
        if (!$showArtists) {
            $artist = "";
        } elseif (count($artists) == 1) {
            $artistId = $artists[0]->getId();
            $artist = "<a href=\"?page=artist-details&id=$artistId\" title=\"$artistName details\">$artistName</a> - ";
        } else {
            $artist = "$artistName - ";
        }

        echo <<<_END
$rowStart
    <div class="record col-sm-$size">
        <figure class="text-center">
            <img src="$cover" class="img-thumbnail" alt="$title cover"><br>
            <figcaption>$artist<a href="?page=record-details&id=$recordId" title ="$title details">$title</a></figcaption>
        </figure>
    </div>
$rowEnd
_END;
    }
}