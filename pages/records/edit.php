<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("class", "record");
requirePhp("api", 'record');
requirePhp("view");

// If $id is valid, we are updating an existing artist.
// Otherwise, we are adding a new artist
$id = getGet("id");
$artistOptions = getArtistsAll();
$labelOptions = getLabelsAll();

if ($id) {
    $record = getRecordById($id);
    $artists = $record->getArtists();
    $artistId = (count($artists) == 1) ? $artists[0]->getId() : 0;
    $title = $record->getTitle();
    $tracks = $record->getTracks();
    $cover = $record->getCoverImage("md");
    $releaseDate = viewDate($record->getReleaseDate());
    $label = $record->getLabel();
    $labelId = ($label) ? $label->getId() : 0;
    $labelname = ($label) ? $label->getName() : "";
    $price = $record->getPrice();
    
    $coverAlt = "alt=\"$title cover\"";
    $saveBtnText = "Save";
    $action = "edit_record";
} else {
    $record = "";
    $artistId = 0;
    $title = "";
    $tracks = [];
    $cover = "";
    $releaseDate = "";
    $labelId = 0;
    $labelName = "";
    $price = "";

    $coverAlt = "";
    $saveBtnText = "Add record";
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
                        <td>
                            <select id="artist" class="form-control" name="artist">
                                <?php printArtistOptions($artistOptions, $artistId) ?>
                            </select>
                        </td>
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
                        <td>
                            <select id="label" class="form-control" name="labelId">
                                <?php printLabelOptions($labelOptions, $labelId) ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th span="row"><label for="price">Price:</label></th>
                        <td><input id="price" class="form-control" type="text" name="price" placeholder="Insert price" value="<?= $price ?>"></td>
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
                <button class="btn btn-primary btn-save" type="button" data-action="<?= $action ?>"><?= $saveBtnText ?></button>
            </div>
        </div>
    </div>
</form>

<?php
/*** Functions ***/
function printArtistOptions($artists, $selectedId) {
    echo "<option value=\"0\">V.A.</option>";

    foreach ($artists as $artist) {
        $select = ($artist->getId() == $selectedId) ? "selected" : "";
        echo "<option value=\"{$artist->getId()}\" $select>{$artist->getName()}</option>";
    }
}

function printLabelOptions($labels, $selectedId) {
    $select = ($selectedId) ? "" : "select";
    echo "<option value=\"0\" $select>--</option>";

    foreach ($labels as $label) {
        $select = ($label->getId() == $selectedId) ? "selected" : "";
        echo "<option value=\"{$label->getId()}\" $select>{$label->getName()}</option>";
    }
}

function printTracks($tracks) {
    echo "<table class=\"table list-enum\"><caption>Tracklist</caption><tbody>";
    foreach ($tracks as $i => $track) {
        $id = $track->getId();
        $no = $i + 1;
        $title = $track->getTitle();
        $duration = viewDuration($track->getDuration());

        echo <<<_END
<tr id="track-$id">
    <td><a class="btn-remove" href="#" title="Delete track" data-target="track-$id" data-enum><span class="glyphicon glyphicon-remove"></a></td>
    <td class="list-index">$no.</td>
    <td>$title</td>
    <td>$duration</td>
</tr>
_END;
    }
    echo "</tbody></table>";
}
