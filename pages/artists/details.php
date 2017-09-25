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
<div class="row">
    <div class="col-xs-6 text-center">
        <img src="<?= $logo ?>" class="img-logo img-responsive center-block" alt="<?= "$name logo"?>">
        <img src="<?= $photo ?>" class="img-photo img-responsive center-block" alt="<?= "$name photo"?>">
        <table class="table">
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
    <div class="artist-bio col-xs-6">
        <div class="text-right <?= $access ?>">
            <button id="edit" class="btn btn-success">Edit</button>
        </div>
        <h2 class="title">Biography</h2>
        <div class="text-justify">
            <?= $bio ?>
        </div>
    </div>
</div>

<?php printRecords($records, false) ?>
