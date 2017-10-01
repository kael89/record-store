<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("class", "record");
requirePhp("api", 'record');
requirePhp("view");

$id = getGet("id");
$record = getRecordById($id);
$title = $record->getTitle();
$artist = viewArtistLink($record->getArtists());
$tracks = $record->getTracks();
$cover = $record->getCoverImage("md");
$releaseDate = viewDate($record->getReleaseDate());
$label = $record->getLabel()->getName();

$access = getSession("admin") ? "" : "hidden";

/*** View ***/
?>
<div class="row">
    <div class="col-xs-6 text-center">
        <div class="details-cover">
            <img src="<?= $cover ?>" class="img-responsive center-block" alt="<? "$title logo"?>">
        </div>
        <table class="table info-table">
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
        <div class="text-right <?= $access ?>">
            <button class="btn btn-success btn-edit">Edit</button>
        </div>
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
