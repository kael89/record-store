<?php 
requirePhp("class", "record");
requirePhp("api", "genre");

/*** View ***/
function viewRecord_ArtistLink($record) {
    $artists = $record->getArtists();

    if (count($artists) == 1) {
        $id = $artists[0]->getId();
        $name = $artists[0]->getName();
        $artist = "<a href=\"artists.php?page=details&id=$id\" title=\"$name details\">$name</a>";
    } else {
        $artist = "V.A.";
    }

    return $artist;
}

function viewRecord_RecordLink($record) {
    $id = $record->getId();
    $title = $record->getTitle();

    return "<a href=\"records.php?page=details&id=$id\" title=\"$title details\">$title</a>";
}

function viewRecord_Genre($record) {
    $genres = getGenresByRecordId($record->getId());

    switch (count($genres)) {
        case 0:
            return "Other";
            break;
        case 1:
            return $genres[0]->getName();
            break;
        default:
            return "Various";
            break;
    }
}

/*** Print ***/
function printRecords($records, $showArtists = true) {
    define("RECORDS_PER_LINE", 4);
    $size = (int)(12 / RECORDS_PER_LINE);
    if ($size < 1) {
        $size = 1;
    }

    foreach ($records as $i => $record) {
        $rowStart = ($i % RECORDS_PER_LINE == 0) ? "<div class=\"row\">" : "";
        $rowEnd = ($i % RECORDS_PER_LINE == RECORDS_PER_LINE - 1) ? "</div>" : "";

        $artistLink = ($showArtists) ? viewRecord_ArtistLink($record) . " - " : "";
        $recordLink = viewRecord_RecordLink($record);

        echo <<<_END
$rowStart
    <div class="record col-sm-$size">
        <figure class="text-center">
            <img src="{$record->getCoverImage()}" class="img-thumbnail" alt="{$record->getTitle()} cover"><br>
            <figcaption>$artistLink $recordLink</figcaption>
        </figure>
    </div>
$rowEnd
_END;
    }
}
