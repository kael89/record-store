<?php
// Heroku autoload
require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/view.php";

requirePhp("api", "user");

switch (getGet("action")) {
    case "signup":
        extract($_POST);
        $user = User::create($firstName, $lastName, $email, $password, true);
        if ($user) {
            $user->login();
        }
        break;
    case "logout":
        $user = getSession("user");
        if ($user) {
            $user->logout();
        }
        break;
    default:
        break;
}

$page = getGet("page");
requirePhp("file", "templates/header.php");
requirePhp("file", "templates/navbar.php");
// If requested page does not exist, serve main page
if (!requirePhp("file", "pages/$page.php")) {
    requirePhp("file", "pages/main.php");
}
requirePhp("file", "templates/footer.php");
