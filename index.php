<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/view.php";

$page = getGet("page");
requirePhp("file", "templates/header.php");
requirePhp("file", "templates/navbar.php");
// If requested page does not exist, serve main page
if (!requirePhp("file", "pages/$page.php")) {
    requirePhp("file", "pages/main.php");
}
requirePhp("file", "templates/footer.php");
