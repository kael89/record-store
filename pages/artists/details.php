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
$successMsg = getGet("add") ? "Artist added!" : "Artist details updated!";

/*** View ***/
?>
<div class="row">
    <div class="col-xs-6 text-center">
        <img src="<?= $logo ?>" class="details-logo img-responsive 
        center-block" alt="<?= "$name logo"?>">
        <img src="<?= $photo ?>" class="details-photo img-responsive center-block" alt="<?= "$name photo"?>">
    </div>
    <div class="col-xs-6 artist-bio ">
        <div class="row">
            <div class="col-xs-4">
                <h2 class="bio-title">Biography</h2>
            </div>
            <div class="col-xs-offset-4 col-xs-4 text-right <?= $access ?>">
                <button class="btn btn-success btn-edit">Edit</button>
            </div>
        </div>
        <div class="text-justify">
            <?= $bio ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <table class="table info-table">
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