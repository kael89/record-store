<?php
requirePhp("class");

/*** View ***/
function viewArtistName($artists) {
    switch (count($artists)) {
        case 0:
            return "N/A";
            break;
        case 1:
            return outHtml($artists[0]->getName());
            break;
        default:
            return "Various";
            break;
    }
}

function viewArtistLink($artists) {
    $name = outHtml(viewArtistName($artists));

    if (count($artists) == 1) {
        $id = (int)$artists[0]->getId();
        $link = "<a title=\"$name details\" href=\"artists.php?page=details&id=$id\">$name</a>";
    } else {
        $link = $name;
    }

    return $link;
}

function viewRecordLink($record) {
    $id = (int)$record->getId();
    $title = outHtml($record->getTitle());

    return "<a title=\"$title details\" href=\"records.php?page=details&id=$id\">$title</a>";
}

function viewDate($date) {
    $date = outHtml($date);
    return (intval($date)) ? date("Y-m-d", strtotime($date)) : "";
}

function viewDuration($secs) {
    $min = (int)($secs / 60);
    $secs -= $min * 60;

    return $min . ":" . str_pad($secs, 2, '0', STR_PAD_LEFT);
}

function viewPrice($price) {
    $price = filter_var($price, FILTER_VALIDATE_FLOAT);
    if (strlen($price) < 5) {
        $price = "&nbsp;$price";
    }

    return str_pad($price, 5, "&nbsp;", STR_PAD_LEFT) . " $";
}

/*** Print ***/
function printLetterNavbar($cat) {
    echo <<<_END
        <ul class="pagination">
            <li><a href="$cat.php?page=browse&letter=">All</a></li>
_END;
    for ($char = ord('A'); $char <= ord('Z'); $char++) {
        $letter = chr($char);
        echo "<li><a href=\"$cat.php?page=browse&letter=$letter\">$letter</a></li>\n";
    }
    echo "</ul>";
}

function printRecords($records, $lineCount, $showArtists = true) {
    $size = (int)(12 / $lineCount);
    if ($size < 1) {
        $size = 1;
    }

    $x = "";
    foreach ($records as $i => $record) {
        $rowStart = ($i % $lineCount == 0) ? "<div class=\"row\">" : "";
        if (($i % $lineCount == $lineCount - 1) || $i == count($records) - 1) {
            $rowEnd = "</div>";
        } else {
            $rowEnd = "";
        }

        $artistLink = ($showArtists) ? viewArtistLink($record->getArtists()) . " - " : "";
        $recordLink = viewRecordLink($record);

        echo <<<_END
$rowStart
    <div class="record col-xs-$size">
        <figure class="text-center">
            <img src="{$record->getCoverImage()}" class="img-thumbnail" alt="{$record->getTitle()} cover"><br>
            <figcaption><span class="i">$artistLink</span> $recordLink</figcaption>
        </figure>
    </div>
$rowEnd
_END;

    $x .= <<<_END
$rowStart
    <div class="record col-xs-$size">
        <figure class="text-center">
            <img src="{$record->getCoverImage()}" class="img-thumbnail" alt="{$record->getTitle()} cover"><br>
            <figcaption><span class="i">$artistLink</span> $recordLink</figcaption>
        </figure>
    </div>
$rowEnd
_END;
    }
}