<?php
/*** Program ***/
requirePhp("class", "record");
requirePhp("api", 'record');

$id = getGet("id");
$record = getRecordById($id);
$title = $record->getTitle();
$artist = viewArtistName($record);
$tracks = $record->getTracks();
$cover = $record->getCover("md");
$releaseDate = viewDate("", $record->getReleaseDate());
$label = $record->getLabel();

/*** View ***/
?>
<div class="row">
    <img src="<?= $cover ?>">
</div>
<div class="row">
    <ul>
        <li>Artist: <?= $artist ?></li>
        <li>Title: <?= $title ?></li>
        <li>Release date: <?= $releaseDate ?></li>
        <li>Label: <?= $label ?></li>
    </ul>
</div>
<div class="row">
    <?php printTracks($tracks) ?>
</div>

<?php
/*** Functions ***/
function printTracks($tracks) {
    echo "<table><tbody>";
    consoleLog($tracks); die;
    foreach ($tracks as $i => $track) { //consoleLog($track); die;
        $title = $track->getTitle();
        $duration = $track->getDuration();

        echo <<<_END
<tr>
    <td>$i.</td>
    <td>$title</td>
    <td>$duration</td>
</tr>
_END;
    }
    echo "</tbody></table>";
}
