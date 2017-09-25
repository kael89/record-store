<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
requirePhp("class", "artist");
requirePhp("api", "artist");
requirePhp("view");

$id = getGet("id");
$artist = getArtistById($id);
$name = $artist->getName();
$country = $artist->getCountry();
$foundationYear = $artist->getFoundationYear();
$logo = $artist->getLogoImage("md");
$photo = $artist->getPhotoImage("md");
$bio = $artist->getBio();
$records = getRecordsByArtistId($id);

$access = getSession("admin") ? "" : "hidden";

/*** View ***/
?>
<form class="form-horizontal form-add overflow">
    <div class="form-group">
        <div class="col-xs-6 text-center">
            <fieldset class="form-inline">
                <label class="control-label">Name:*<input class="form-control" type="text" name="name" placeholder="Insert name" value="<?= $name ?>"></label>
            </fieldset>
            <figure class="img-upload">
                <figcaption><label for="logo">Logo:</label></figcaption>
                <input id="logo" class="form-control" type="file" name="logo" accept="image/*">
            </figure>
            <figure class="img-upload">
                <figcaption><label for="photo">Photo:</label></figcaption>
                <input id="photo" class="form-control" type="file" name="logo" accept="image/*">
            </figure>
            <table class="table">
                <tbody>
                    <tr>
                        <th span="row"><label for="country">Country:</label></th>
                        <td><input id="country" class="form-control" type="text" name="country" placeholder="Insert country" value="<?= $country ?>"></td>
                    </tr>
                    <tr>
                        <th span="row"><label for="foundationYear">Foundation Year:</label></th>
                        <td><input id="foundationYear" class="form-control" type="text" name="foudationYear" placeholder="Insert year" value="<?= $foundationYear ?>"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-6 artist-bio">
            <div class="text-right">
                <button id="edit" class="btn btn-success">Edit</button>
            </div>
            <h2 class="title"><label for="bio">Biography</label></h3>
            <textarea id="bio" class="form-control" name="bio" rows="20" cols="50" placeholder="Insert biography"><?= $bio ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-6 text-center">
            <button class="btn btn-success">Add records</button> for this artist
        </div>
        <div class="col-xs-6 text-right">
            <button id="cancel" class="btn btn-danger" type="button">Cancel</button>
            <button id="add-artist" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
