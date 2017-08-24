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
        <li><a href="#">Z</a></li>β
        <li>
            <a href="#"><span>&raquo;</span></a>
        </li>
    </ul>
</nav>

<?php

// $x = getTracksByTitle("Fuel")[0];
// $x->setTitle("Afraid to Shoot Strangers");
// $x->setDuration(333);
// $x->setArtist(2);
// $x->setArtist(3);

$x = getRecordsByArtistId(1);
foreach ($x as $i) {
    var_dump($i->getTracks(), "<br><br>");
}

// var_dump($x);



?>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/templates/footer.php";