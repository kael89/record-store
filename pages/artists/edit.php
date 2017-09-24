<?php
/*** Program ***/
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
                        <th span="row"><label for="year">Foundation Year:</label></th>
                        <td><input id="year" class="form-control" type="text" name="year" placeholder="Insert year" value="<?= $year ?>"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-6 artist-bio">
            <h2 class="title"><label for="bio">Biography</label></h3>
            <textarea id="bio" class="form-control" name="bio" rows="20" cols="50" placeholder="Insert biography" value="<? $bio ?>"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-6 text-center">
            <button class="btn btn-success">Add records</button> for this artist
        </div>
        <div class="col-xs-6 text-right">
            <button id="add-artist" class="btn btn-primary btn-lg">Save</button>
        </div>
    </div>
</form>
