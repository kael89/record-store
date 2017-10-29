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
// If requested page does not exist, serve "About" page
if (!requirePhp("file", "pages/$page.php")) {
    requirePhp("file", "pages/about.php");
}
requirePhp("file", "templates/footer.php");
