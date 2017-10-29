<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/view.php";

if (getGet("action") == "logout") {
    requirePhp("api", "user");
    logoutUser();
}

$page = getGet("page");
requirePhp("file", "templates/header.php");
requirePhp("file", "templates/navbar.php");
// If requested page does not exist, serve "All" page
if (!requirePhp("file", "pages/records/$page.php")) {
    requirePhp("file", "pages/records/all.php");
}
requirePhp("file", "templates/footer.php");
