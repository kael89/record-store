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
<div id="detailsLogo" class="row">
    <div class="col-xs-4 col-xs-offset-4">
        <img src="<?= $logo ?>" class="details-logo img-responsive 
        center-block" alt="<?= "$name logo"?>">
    </div>
    <div class="col-xs-4">
        <div class="text-right <?= $access ?>">
            <button class="btn btn-success btn-edit">Edit</button>
        </div>
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
        <h3 class="bio-title">Biography</h3>
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