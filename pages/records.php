<?php
/*** Program ***/
requirePhp("class");
requirePhp("api");

$letter = getGet("letter");
if (!$letter) {
    $letter = "a";
}
$records = getRecordsByTitle("$letter%", true);
// Debug: get all records
$records = getRecordsByTitle("%", true);

/*** View ***/
?>
<div class="row text-center">
    <nav class="letter-navbar">
        <?php printLetterNavbar("records") ?>
    </nav>
</div>

<?php printRecords($records); ?>
