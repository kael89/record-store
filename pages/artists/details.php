<?php
/*** Program ***/
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("class", "artist");
requirePhp("api", "artist");
requirePhp("view");

$id = getId();
$artist = getArtistById($id);
if (!$artist) {
    if (getGet("action") == 'insert') {
        $err = "Error: could not add artist";
    } else {
        $err = "No artist found!";
    }

    die($err);
}

$name = outHtml($artist->getName());
$country = outHtml($artist->getCountry());
$foundationYear = (int)$artist->getFoundationYear();
$logo = outHtml($artist->getLogoImage("m"));
$photo = outHtml($artist->getPhotoImage("m"));
$bio = outHtml($artist->getBio());
$records = $artist->getRecords();

$access = getSession("admin") ? "" : "hidden";
$successMsg = getGet("add") ? "Artist added!" : "Artist details updated!";

/*** View ***/
?>
<div id="logoRow" class="row">
    <div class="col-xs-4 col-xs-offset-4">
        <img src="<?= $logo ?>" class="details-logo img-responsive 
        center-block" alt="<?= "$name logo"?>">
    </div>
    <div class="col-xs-4 text-right <?= $access ?>">
        <button class="btn btn-danger btn-delete" data-id="<?= $id ?>" data-item="<?= $name ?>" data-action="delete_artist">Delete</button>
        <button class="btn btn-success btn-edit">Edit</button>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 text-center">
        <img src="<?= $photo ?>" class="details-photo img-responsive center-block" alt="<?= "$name photo"?>">
        <table class="table table-info">
            <tbody>
                <tr>
                    <th span="row">Name:</th>
                    <td><?= $name ?></td>
                </tr>
                <tr>
                    <th span="row">Country:</th>
                    <td><?= $country ?></td>
                </tr>
                <tr>
                    <th span="row">Foundation Year:</th>
                    <td><?= $foundationYear ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-xs-6 artist-bio ">
        <div class="text-justify">
            <?= $bio ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <?php printRecords($records, 4, false) ?>
    </div>
</div>
<div id="successMsg" class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    <?= $successMsg ?>
</div>