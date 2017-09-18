<?php
/*** Program ***/
$title = ucwords(str_replace('-', ' ', getGet("page")));

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

    <script src="js/lib/jquery-3.2.1.js"></script>
    <script src="js/lib/bootstrap.js"></script>
    <script src="js/lib/library.js"></script>
</head>
<body>