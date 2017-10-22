<?php
/*** Program ***/
$fullPath = str_replace(".php", "", getUrlPath($_SERVER["REQUEST_URI"]));
$cat = ($fullPath != "index") ? ucfirst($fullPath) : "";
$page = getGet("page") ? ucwords(str_replace('-', ' ', getGet("page"))) : "";

if ($cat) {
    $title = $page ? "$cat - $page" : $cat;
} else {
    // Specifies a generic title when there are no page details
    $title = $page ?: "Metal Militia";
}

/*** View ***/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.2">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/details.css">

    <script src="js/lib/jquery-3.2.1.js"></script>
    <script src="js/lib/bootstrap.js"></script>
    <script src="js/lib/library.js"></script>
    <script src="js/tracklist.js"></script>
    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
</head>
<body>
    <div id="container" class="container">
        <div id="loading" class="row"><div class="col-xs-12">I am loading man</div></div>