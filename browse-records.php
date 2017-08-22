<?php
require_once "lib/classes/Record.php";
require_once "lib/classes/Label.php";
require_once "lib/classes/Genre.php";
require_once "lib/classes/Track.php";
require_once "lib/classes/Artist.php";

require_once "lib/api/record-api.php";
require_once "lib/api/label-api.php";
require_once "lib/api/genre-api.php";
require_once "lib/api/track-api.php";
require_once "lib/api/artist-api.php";

$title = 'Browse Records';
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
// var_dump($columns["test"]);
$res = getRecordsByTitle('The Nu%', true);
var_dump($res[0]->getArtists());
echo "<br><br>";
var_dump($res[0]->getTracks());
echo "<br><br>";
?>

<?php require_once "templates/footer.php";