<?php
/*** Program ***/
requirePhp("class");
requirePhp("api");
requirePhp("view");

$letter = getGet("letter");
$records = getRecordsByTitle("$letter%", true);

/*** View ***/
?>
<div class="row text-center">
    <nav class="letter-navbar">
        <?php printLetterNavbar("records") ?>
    </nav>
</div>
<div class="row">
    <div class="col-xs-12">
        <?php printRecords($records, 4); ?>
    </div>
</div>
