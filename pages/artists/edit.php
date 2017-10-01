<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("class", "artist");
requirePhp("api", "artist");
requirePhp("view");

// If $id is valid, we are updating an existing artist.
// Otherwise, we are adding a new artist
$id = getGet("id");
$artist = ($id) ? getArtistById($id) : "";
$name = ($id) ? $artist->getName() : "";
$country = ($id) ? $artist->getCountry() : "";
$foundationYear = ($id) ? $artist->getFoundationYear() : "";
$logo = ($id) ? $artist->getLogoImage("md") : "";
$photo = ($id) ? $artist->getPhotoImage("md") : "";
$bio = ($id) ? $artist->getBio() : "";
$records = ($id) ? getRecordsByArtistId($id) : [];

$access = ($id) ? "" : "hidden";
$insertBtnText = ($id) ? "Save" : "Add artist";

/*** View ***/
?>
<form class="form-horizontal form-edit overflow" enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-xs-6 artist-photos text-center">
            <fieldset class="form-inline">
                <div class="img-upload">
                    <img src="<?= $logo ?>" class="details-logo img-responsive center-block" alt="<?= "$name logo" ?>">
                    <label for="logo">Upload new logo:</label>
                    <input id="logo" class="form-control" type="file" name="logo" accept="image/*">
                </div>
                <div class="img-upload">
                    <img src="<?= $photo ?>" class="details-photo img-responsive center-block" alt="<?= "$name photo" ?>">
                    <label for="photo">Upload new photo:</label>
                    <input id="photo" class="form-control" type="file" name="photo" accept="image/*">
                <div class="form-horizontal"></div>
            </fieldset>
        </div>
        <div class="col-xs-6 artist-bio">
            <div class="text-right">
                <button class="btn btn-success btn-edit <?= $access ?>">Edit</button>
            </div>
            <h2 class="bio-title"><label for="bio">Biography</label></h2>
            <textarea id="bio" class="form-control" name="bio" rows="20" cols="50" placeholder="Insert biography"><?= $bio ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-6">
            <table class="table info-table">
                <tbody>
                    <tr>
                        <th span="row"><label for="name">Name:</label></th>
                        <td><input id="name" class="form-control" type="text" name="name" placeholder="Insert name" value="<?= $name ?>"></td>
                    </tr>
                    <tr>
                        <th span="row"><label for="country">Country:</label></th>
                        <td><input id="country" class="form-control" type="text" name="country" placeholder="Insert country" value="<?= $country ?>"></td>
                    </tr>
                    <tr>
                        <th span="row"><label for="foundationYear">Foundation Year:</label></th>
                        <td><input id="foundationYear" class="form-control" type="text" name="foundationYear" placeholder="Insert year" value="<?= $foundationYear ?>"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-6"></div>
    </div>
    <div class="form-group">
        <div class="col-xs-6 text-center">
            <button class="btn btn-success">Add records</button>
        </div>
        <div class="col-xs-6 text-right">
            <?php if ($id) { ?>
            <button class="btn btn-danger btn-cancel" type="button">Cancel</button>
            <?php } ?>
            <button class="btn btn-primary btn-insert" type="button" data-action="edit_artist"><?= $insertBtnText ?></button>
        </div>
    </div>
</form>
