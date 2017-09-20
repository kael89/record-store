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

/*** View ***/
?>
<div class="row">
    <div class="col-xs-6 text-center">
        <img src="<?= $logo ?>" width="300px">
        <img src="<?= $photo ?>" width="500px">
        <table class="table">
            <tbody>
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
        <h3>Biography</h3>
        <?= $bio ?>
    </div>
</div>

<?php printRecords($records, false) ?>
