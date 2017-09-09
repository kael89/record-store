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
$releaseDate = viewDate($record->getReleaseDate());
$label = $record->getLabel()->getName();

/*** View ***/
?>
<div class="row">
    <div class="col-xs-12 text-center">
        <img src="<?= $cover ?>">
        <ul>
            <li>Artist: <?= $artist ?></li>
            <li>Title: <?= $title ?></li>
            <li>Release date: <?= $releaseDate ?></li>
            <li>Label: <?= $label ?></li>
        </ul>
        <h3>Tracklist</h3>
        <?php printTracks($tracks) ?>
    </div>
</div>

<?php
/*** Functions ***/
function printTracks($tracks) {
    echo "<table class=\"table\"><tbody>";
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
