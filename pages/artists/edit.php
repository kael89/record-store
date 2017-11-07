<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("class", "artist");
requirePhp("api", "artist");
requirePhp("view");

// If $id is valid, we are updating an existing artist.
// Otherwise, we are adding a new artist
$id = getId();
if ($id) {
    $artist = getArtistById($id);

    $name = outHtml($artist->getName());
    $country = outHtml($artist->getCountry());
    $foundationYear = (int)$artist->getFoundationYear();
    $logo = outHtml($artist->getLogoImage("m"));
    $photo = outHtml($artist->getPhotoImage("m"));
    $bio = outHtml($artist->getBio());
    $records = $artist->getRecords();

    $logoAlt = "alt=\"$name logo\"";
    $photoAlt = "alt=\"$name photo\"";
    $saveBtnText = "Save";
    $action = "edit_artist";
} else {
    if (!getSession("admin")) {
        die("Please <a href=\"index.php?page=login\" title=\"Login page\">login</a> in order to add an artist");
    }

    $name = "";
    $country = "";
    $foundationYear = "";
    $logo = "";
    $photo = "";
    $bio = "";
    $records = [];

    $logoAlt = "";
    $photoAlt = "";
    $saveBtnText = "Add artist";
    $action = "add_artist";
}

/*** View ***/
?>
<form class="form-horizontal form-edit overflow" enctype="multipart/form-data">
    <div id="logoRow" class="form-group">
        <div class="col-xs-12 text-center">
            <fieldset class="form-inline">
                <div class="img-upload">
                    <img src="<?= $logo ?>" class="details-logo img-responsive center-block" <?= $logoAlt ?>>
                    <label for="logoFile">Upload new logo:</label>
                    <input id="logoFile" class="form-control" type="file" name="logoFile" accept="image/*">
                </div>
            </fieldset>
        </div>
    </div>
    <div id="addArtistMain" class="form-group">
        <div class="col-xs-6 text-center">
            <fieldset class="form-inline">
                <div class="img-upload">
                    <img src="<?= $photo ?>" class="details-photo img-responsive center-block" <?= $photoAlt ?>>
                    <label for="photoFile">Upload new photo:</label>
                    <input id="photoFile" class="form-control" type="file" name="photoFile" accept="image/*">
                </div>
                <table class="table table-info">
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
            </fieldset>
        </div>
        <div class="col-xs-6 artist-bio">
            <textarea id="bio" class="form-control" name="bio" rows="20" cols="50" placeholder="Insert biography"><?= $bio ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-9">
            <?php printRecords($records, 3, false) ?>
        </div>
        <div class="col-xs-3"></div>
    </div>
</form>
<div class="save-btns">
    <?php if ($id) { ?>
        <button class="btn btn-danger btn-cancel" type="button">Cancel</button>
    <?php } ?>
    <button class="btn btn-primary btn-save" type="button" data-action="<?= $action ?>"><?= $saveBtnText ?></button>
</div>
