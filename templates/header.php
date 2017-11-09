<?php
/*** Program ***/
$urlPath = substr(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), 1);
$cat = ($urlPath != "index.php") ? ucfirst(str_replace(".php", "", $urlPath)) : "";
$out = $_SERVER["REQUEST_URI"];
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

    <!-- bootstrap.css 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/details.css">

    <!-- jquery.js 3.2.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- bootstrap.js 3.3.7 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/lib/library.js"></script>
    <script src="js/tracklist.js"></script>
    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
</head>
<body>
    <div id="container" class="container">
        <div id="loading" class="row"><div class="col-xs-12"></div></div>