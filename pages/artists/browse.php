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
<div class="row">
    <div class="col-xs-12">
        <?php printArtists($artists, 4); ?>
    </div>
</div>

<?php
/*** Functions ***/
function printArtists($artists, $lineCount) {
    $size = (int)(12 / $lineCount);
    if ($size < 1) {
        $size = 1;
    }

    foreach ($artists as $i => $artist) {
        $rowStart = ($i % $lineCount == 0) ? "<div class=\"row\">" : "";
        if (($i % $lineCount == $lineCount - 1) || $i == count($artists) - 1) {
            $rowEnd = "</div>";
        } else {
            $rowEnd = "";
        }

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
