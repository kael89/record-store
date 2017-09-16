<?php
/*** Program ***/
requirePhp("class", "record");
requirePhp("api", 'record');

$id = getGet("id");
$record = getRecordById($id);
$title = $record->getTitle();
$artist = viewArtistLink($record);
$tracks = $record->getTracks();
$cover = $record->getCoverImage("md");
$cover = $record->getCoverImage("md");
$releaseDate = viewDate($record->getReleaseDate());
$label = $record->getLabel()->getName();

/*** View ***/
?>
<div class="row">
    <div class="col-xs-6 text-center">
        <img src="<?= $cover ?>">
        <table class="table">
            <tbody>
                <tr>
                    <th span="row">Artist:</th>
                    <td><?= $artist ?></td>
                </tr>
                <tr>
                    <th span="row">Title:</th>
                    <td><?= $title ?></td>
                </tr>
                <tr>
                    <th span="row">Release date:</th>
                    <td><?= $releaseDate ?></td>
                </tr>
                <tr>
                    <th span="row">Label:</th>
                    <td><?= $label ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-xs-6 text-center">
        <?php printTracks($tracks) ?>
    </div>
</div>

<?php
/*** Functions ***/
function printTracks($tracks) {
    echo "<table class=\"table\"><caption>Tracklist</caption><tbody>";
    foreach ($tracks as $i => $track) {
        $no = $i + 1;
        $title = $track->getTitle();
        $duration = viewDuration($track->getDuration());

        echo <<<_END
<tr>
    <td>$no.</td>
    <td>$title</td>
    <td>$duration</td>
</tr>
_END;
    }
    echo "</tbody></table>";
}
