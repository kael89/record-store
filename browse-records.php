<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/classes/Record.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/classes/Label.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/classes/Genre.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/classes/Track.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/classes/Artist.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/record-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/label-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/genre-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/track-api.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/api/artist-api.php";

$title = 'Browse Records';
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/templates/head.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/templates/header.php";
?>
 
<nav>
    <ul class="pagination">
        <?php printRecordNavbar() ?>
    </ul>
</nav>

<p>Latest releases:</p>

<?php
    $letter = getGet("letter");
    $records = getRecordsByTitle("$letter%", true);
    displayRecords($records);
?>

<script src="js/browse-records.js"></script>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/templates/footer.php";

function printRecordNavbar() {
    for ($char = ord('A'); $char <= ord('Z'); $char++) {
        $letter = chr($char);
        echo "<li><a href=\"browse-records.php?letter=$letter\">$letter</a></li>\n";
    }
}

function displayRecords($records) {
    var_dump($records);
}