<?php
/*** Program ***/
requirePhp("class");
requirePhp("api");

$letter = getGet("letter");
if (!$letter) {
    $letter = "a";
}
$records = getRecordsByTitle("$letter%", true);
// Debug: get all records
$records = getRecordsByTitle("%", true);

/*** View ***/
?>
<div class="row text-center">
    <nav class="letter-navbar">
        <?php printLetterNavbar("records") ?>
    </nav>
</div>

<?php printRecords($records); ?>

<?php
/*** Functions ***/
function printRecords($records) {
    define("RECORDS_PER_LINE", 4);
    $size = (int)(12 / RECORDS_PER_LINE);
    if ($size < 1) {
        $size = 1;
    }

    foreach ($records as $i => $record) {
        $rowStart = ($i % RECORDS_PER_LINE == 0) ? "<div class=\"row\">" : "";
        $rowEnd = ($i % RECORDS_PER_LINE == RECORDS_PER_LINE - 1) ? "</div>" : "";

        $id = $record->getId();
        $title = $record->getTitle();
        $cover = $record->getCoverImage();
        $artist = viewArtistName($record);

        echo <<<_END
$rowStart
    <div class="record col-sm-$size">
        <figure class="text-center">
            <img src="$cover" class="img-thumbnail" alt="$title cover"><br>
            <figcaption>$artist - <a href="?page=record-details&id=$id" title ="$title details">$title</a></figcaption>
        </figure>
    </div>
$rowEnd
_END;
    }
}
