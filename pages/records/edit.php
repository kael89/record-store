<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("class", "record");
requirePhp("api", 'record');
requirePhp("view");

$id = getGet("id");
$record = ($id) ? getRecordById($id) : "";
$title = ($id) ? $record->getTitle() : "";
$artist = ($id) ? viewArtistName($record->getArtists()) : "";
$tracks = ($id) ? $record->getTracks() : [];
$cover = ($id) ? $record->getCoverImage("md") : "";
$releaseDate = ($id) ? viewDate($record->getReleaseDate()) : "";
$label = ($id) ? $record->getLabel()->getName() : "";

$access = ($id) ? "" : "hidden";
$insertBtnText = ($id) ? "Save" : "Add record";
$successMsg = ($id) ? "Record details updated!" : "Record successfully added!";

/*** View ***/
?>
<form id="addRecord" class="form-horizontal form-edit">
    <div class="form-group">
        <div class="col-xs-6 text-center">
            <fieldset class="form-inline">
                <div class="img-upload">
                    <img src="<?= $cover ?>" class="details-cover img-responsive center-block" alt="<?= "$title logo" ?>">
                    <label for="cover">Upload new cover:</label>
                    <input id="cover" class="form-control" type="file" name="cover" accept="image/*">
                </div>
            </fieldset>
            <table class="table info-table">
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
                        <td><input id="label" class="form-control" type="text" name="label" placeholder="Insert Label" value="<?= $label ?>"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-6 text-center">
            <div class="text-right">
                <button class="btn btn-success btn-edit <?= $access ?>">Edit</button>
            </div>
            <?php printTracks($tracks) ?>
            <div class="success-msg alert alert-danger alert-dismissible hidden">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <?= $successMsg ?>
            </div>
            <div class="text-right">
                <?php if ($id) { ?>
                <button class="btn btn-danger btn-cancel" type="button">Cancel</button>
                <?php } ?>
                <button class="btn btn-primary btn-insert" type="button"><?= $insertBtnText ?></button>
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
