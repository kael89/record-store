<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("class", "record");
requirePhp("api", 'record');
requirePhp("view");

$id = getGet("id");
$record = getRecordById($id);
if (!$record) {
    if (getGet("action") == 'insert') {
        $err = "Error: could not add record";
    } else {
        $err = "No record found!";
    }

    die($err);
}

$genre = $record->getGenre();
$title = $record->getTitle();
$artist = viewArtistLink($record->getArtists());
$tracks = $record->getTracks();
$cover = $record->getCoverImage("m");
$releaseDate = viewDate($record->getReleaseDate());
$price = viewPrice($record->getPrice());

$access = getSession("admin") ? "" : "hidden";
$successMsg = getGet("add") ? "Record added!" : "Record details updated!";

/*** View ***/
?>
<div class="row">
    <div class="col-xs-6 text-center">
        <img src="<?= $cover ?>" class="details-cover img-responsive center-block" alt="<? "$title logo"?>">
        <table class="table table-info">
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
                    <th span="row">Genre:</th>
                    <td><?= $genre ?></td>
                </tr>
                <tr>
                    <th span="row">Release date:</th>
                    <td><?= $releaseDate ?></td>
                </tr>
                <tr>
                    <th span="row">Price:</th>
                    <td><?= $price ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-xs-6 text-center">
        <div class="text-right <?= $access ?>">
            <button class="btn btn-danger btn-delete" data-id="<?= $id ?>" data-item="<?= $title ?>" data-action="delete_record">Delete</button>
            <button class="btn btn-success btn-edit">Edit</button>
        </div>
        <?php printTracks($tracks) ?>
    </div>
</div>
<div id="successMsg" class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    <?= $successMsg ?>
</div>

<?php
/*** Functions ***/
function printTracks($tracks) {
    echo "<table class=\"table\"><caption>Tracklist</caption><tbody>";
    foreach ($tracks as $track) {
        $position = $track->getPosition();
        $title = $track->getTitle();
        $duration = viewDuration($track->getDuration());

        echo <<<_END
<tr>
    <td>$position.</td>
    <td>$title</td>
    <td>$duration</td>
</tr>
_END;
    }
    echo "</tbody></table>";
}
