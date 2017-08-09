<?php
/* Program */
require_once "lib/general.php";
require_once "lib/database.php";
require_once "lib/User.php";

$signup = getPost("signup");
$login = getPost("login");

if (isset($signup)) {
    $firstName = trim(getPost("firstName"));
    $lastName = trim(getPost("lastName"));
    $email = trim(getPost("email"));
    $password = getPost("password");

    $user = new User($firstName, $lastName, $email, $password);
    if ($user) {
        setSession(["user" => $user]);
    } else {
        echo 'Error: could not create user';
    }
} elseif (isset($login)) {
    $email = trim(getPost("email"));
    $password = getPost("password");
    $user = User::validate($email, $password);

    if ($user) {
        setSession(["user" => $user]);
    } else {
        echo 'User not found...';
    }
}

$action = getGet("action");
if ($action == "logout" && getSession("user")) {
    User::logout();
}
/********/

/* View */
$title = "Welcome to Metal Militia!";
require_once "templates/head.php";
require_once "templates/header.php";

?>

<p>Welcome to Metal Militia!</p>

<?php require_once "templates/footer.php";
/********/