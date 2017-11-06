<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("class", "record");
requirePhp("api", 'record');
requirePhp("view");

// If $id is valid, we are updating an existing artist.
// Otherwise, we are adding a new artist
$id = getId();
$artistOptions = getArtistsAll();
$genreOptions = getGenresAll();

if ($id) {
    $record = getRecordById($id);

    $genreId = (int)$record->getGenreId($id);
    $title = outHtml($record->getTitle());
    $artists = $record->getArtists();
    $artistId = (count($artists) == 1) ? (int)$artists[0]->getId() : 0;
    $tracks = $record->getTracks();
    $cover = outHtml($record->getCoverImage("m"));
    $releaseDate = viewDate($record->getReleaseDate());
    $price = viewPrice($record->getPrice());
    
    $coverAlt = "alt=\"$title cover\"";
    $saveBtnText = "Save";
    $action = "edit_record";
} else {
    $genreId = 0;
    $title = "";
    $artistId = 0;
    $tracks = [];
    $cover = "";
    $releaseDate = "";
    $price = "";

    $coverAlt = "";
    $saveBtnText = "Add record";
    $action = "add_record";
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
                            <select id="artistId" class="form-control" name="artistId">
                                <?php printArtistOptions($artistOptions, $artistId) ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th span="row"><label for="artist">Genre:</label></th>
                        <td>
                            <select id="genreId" class="form-control" name="genreId">
                                <?php printGenreOptions($genreOptions, $genreId) ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th span="row"><label for="title">Title:</label></th>
                        <td><input id="title" class="form-control" type="text" name="title" placeholder="Insert title" value="<?= $title ?>"></td>
                    </tr>
                    <tr>
                        <th span="row"><label for="releaseDate">Release date:</label></th>
                        <td><input id="releaseDate" class="form-control" type="text" name="releaseDate" placeholder="yyyy-mm-dd" value="<?= $releaseDate ?>"></td>
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
    echo "<option value=\"0\">N/A</option>";

    foreach ($artists as $artist) {
        $select = ($artist->getId() == $selectedId) ? "selected" : "";
        $id = (int)$artist->getId();
        $name = outHtml($artist->getName());

        echo "<option value=\"$id\" $select>$name</option>";
    }
}

function printGenreOptions($genres, $selectedId) {
    foreach ($genres as $genre) {
        $select = ($genre->getId() == $selectedId) ? "selected" : "";
        $id = (int)$genre->getId();
        $name = outHtml($genre->getName());

        echo "<option value=\"$id\" $select>$name</option>";
    }
}

function printTracks($tracks) {
    echo <<<_END
<table id="tracklist" class="table list-enum tracks-list">
    <caption>Tracklist</caption>
    <tbody id="tracksDropzone">
_END;

    foreach ($tracks as $track) {
        $id = (int)$track->getId();
        $artistId = (int)$track->getArtistId();
        $position = (int)$track->getPosition();
        $title = outHtml($track->getTitle());
        $duration = viewDuration($track->getDuration());

        echo <<<_END
        <tr id="tracks-$id" class="form-update" draggable="true" data-drop="tracksDropzone">
            <td><a class="btn-remove" href="#" title="Delete track" data-target="tracks-$id"><span class="glyphicon glyphicon-remove"></a></td>
            <td><a class="btn-update" href="#" title="Edit track" data-target="tracks-$id"><span class="glyphicon glyphicon-pencil"></a></td>
            <td id="trackPosition" class="tracks-index">$position.</td>
            <td id="trackArtistId" class="hidden">$artistId</td>
            <td id="trackTitle"><input class="form-control" type="text" value="$title"><span class="update-val">$title</span></td>
            <td id="trackDuration"><input class="form-control" type="text" value="$duration"><span class="update-val">$duration</span></td>
        </tr>
_END;
    }

    echo <<<_END
        <!-- New track row -->
        <tr id="tracks-new" class="form-update form-update-new" draggable="true" data-drop="tracksDropzone">
            <td><a class="btn-remove" href="#" title="Delete track" data-target="tracks-new"><span class="glyphicon glyphicon-remove"></a></td>
            <td><a class="btn-update" href="#" title="Edit track" data-target="tracks-new"><span class="glyphicon glyphicon-pencil"></a></td>
            <td id="trackPosition" class="tracks-index"></td>
            <td id="trackTitle"><input class="form-control" type="text" placeholder="Insert track title"><span class="update-val"></span></td>
            <td id="trackDuration"><input class="form-control" type="text" placeholder="0:00"><span class="update-val"></span></td>
        </tr>
    </tbody>
    <tfoot>
        <tr class="no-border">
            <td colspan="3" class="text-left"><button class="btn btn-sm btn-info btn-insert" type="button" data-target="tracks-new"><span class="glyphicon glyphicon-plus-sign"></span> Add track</button></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
</table>
_END;
}
