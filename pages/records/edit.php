<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("class", "record");
requirePhp("api", 'record');
requirePhp("view");

// If $id is valid, we are updating an existing artist.
// Otherwise, we are adding a new artist
$id = getGet("id");
if ($id) {
    $record = getRecordById($id);
    $title = $record->getTitle();
    $artist = viewArtistName($record->getArtists());
    $tracks = $record->getTracks();
    $cover = $record->getCoverImage("md");
    $releaseDate = viewDate($record->getReleaseDate());
    $label = $record->getLabel();
    $labelname = ($label) ? $label->getName() : "";

    $coverAlt = "alt=\"$title logo\"";
    $insertBtnText = "Save";
    $action = "edit_record";
} else {
    $record = "";
    $title = "";
    $artist = "";
    $tracks = [];
    $cover = "";
    $releaseDate = "";
    $labelName = "";

    $coverAlt = "";
    $insertBtnText = "Add record";
    $action = "insert_record";
}

/*** View ***/
?>
<form class="form-horizontal form-edit overflow" enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-xs-6 text-center">
            <fieldset class="form-inline">
                <img src="<?= $cover ?>" class="details-cover img-responsive center-block" <?= $coverAlt ?>>
                <label for="coverFile">Upload new cover:</label>
                <input id="coverFile" class="form-control" type="file" name="coverFile" accept="image/*">
            </fieldset>
            <table class="table table-info">
                <tbody>
                    <tr>
                        <th span="row"><label for="artist">Artist:</label></th>
                        <td><input id="artist" class="form-control" type="text" name="artist" placeholder="Insert artist" value="<?= $artist ?>"></td>
                    </tr>
                    <tr>
                        <th span="row"><label for="title">Title:</label></th>
                        <td><input id="title" class="form-control" type="text" name="title" placeholder="Insert title" value="<?= $title ?>"></td>
                    </tr>
                    <tr>
                        <th span="row"><label for="releaseDate">Release date:</label></th>
                        <td><input id="releaseDate" class="form-control" type="text" name="releaseDate" placeholder="Insert release date" value="<?= $releaseDate ?>"></td>
                    </tr>
                    <tr>
                        <th span="row"><label for="label">Label:</label></th>
                        <td><input id="label" class="form-control" type="text" name="label" placeholder="Insert Label" value="<?= $labelName ?>"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-6 text-center">
            <?php printTracks($tracks) ?>
            <div class="text-right">
                <?php if ($id) { ?>
                    <button class="btn btn-danger btn-cancel" type="button">Cancel</button>
                <?php } ?>
                <button class="btn btn-primary btn-insert" type="button" data-action="<?= $action ?>"><?= $insertBtnText ?></button>
            </div>
        </div>
    </div>
</form>

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
