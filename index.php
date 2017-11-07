<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/view.php";

requirePhp("api", "user");

switch (getGet("action")) {
    case "signup":
        extract($_POST);
        $user = User::create($firstName, $lastName, $email, $password);
        if ($user) {
            $user->login();
        }
        break;
    case "logout":
        $user = getSession("user");
        $user->logout();
        break;
    default:
        break;
}

$page = getGet("page");
requirePhp("file", "templates/header.php");
requirePhp("file", "templates/navbar.php");
// If requested page does not exist, serve "About" page
if (!requirePhp("file", "pages/$page.php")) {
    requirePhp("file", "pages/about.php");
}
requirePhp("file", "templates/footer.php");
