<?php
$title = 'Browse Records';

require_once "lib/classes/Record.php";
require_once "lib/classes/Label.php";
require_once "lib/api/record-api.php";
require_once "lib/api/label-api.php";
require_once "templates/head.php";
require_once "templates/header.php";
?>

<nav>
    <ul class="pagination">
        <li>
            <span>&laquo;</span></a>
        </li>
        <li><a href="#">A</a></li>
        <li><a href="#">B</a></li>
        <li><a href="#">C</a></li>
        <li><a href="#">D</a></li>
        <li><a href="#">E</a></li>
        <li><a href="#">F</a></li>
        <li><a href="#">G</a></li>
        <li><a href="#">H</a></li>
        <li><a href="#">I</a></li>
        <li><a href="#">J</a></li>
        <li><a href="#">K</a></li>
        <li><a href="#">L</a></li>
        <li><a href="#">M</a></li>
        <li><a href="#">N</a></li>
        <li><a href="#">O</a></li>
        <li><a href="#">P</a></li>
        <li><a href="#">Q</a></li>
        <li><a href="#">R</a></li>
        <li><a href="#">S</a></li>
        <li><a href="#">T</a></li>
        <li><a href="#">U</a></li>
        <li><a href="#">V</a></li>
        <li><a href="#">W</a></li>
        <li><a href="#">X</a></li>
        <li><a href="#">Y</a></li>
        <li><a href="#">Z</a></li>
        <li>
            <a href="#"><span>&raquo;</span></a>
        </li>
    </ul>
</nav>

<?php
$record = getRecordsByTitle('Black Sabbath')[0];
var_dump($record);
echo $record->getLabel();
echo "<br><br>";
var_dump(getLabelsByCountry('UK'));
?>


<?php require_once "templates/footer.php";