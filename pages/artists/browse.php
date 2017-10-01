<?php
/*** Program ***/
requirePhp("class");
requirePhp("api");

$letter = getGet("letter");
if (!$letter) {
    $letter = "a";
}
$artist = getArtistsByName("$letter%", true);
// Debug: get all artists
$artists = getArtistsByName("%", true);

/*** View ***/
?>
<div class="row text-center">
    <nav class="letter-navbar">
        <?php printLetterNavbar("artists") ?>
    </nav>
</div>

<?php printArtists($artists); ?>

<?php
/*** Functions ***/
function printArtists($artists, $lineCount) {
    $size = (int)(12 / $lineCount);
    if ($size < 1) {
        $size = 1;
    }

    foreach ($artists as $i => $artist) {
        $rowStart = ($i % $lineCount == 0) ? "<div class=\"row\">" : "";
        $rowEnd = ($i % $lineCount == $lineCount - 1) ? "</div>" : "";

        $id = $artist->getId();
        $name = $artist->getName();
        $logo = $artist->getLogoImage("lg");

        echo <<<_END
$rowStart
    <div class="artist col-sm-$size">
        <figure class="text-center">
            <img src="$logo" class="img-thumbnail" alt="$name logo"><br>
            <figcaption><a href="artists.php?page=details&id=$id" title ="$name details">$name</a></figcaption>
        </figure>
    </div>
$rowEnd
_END;
    }
}
