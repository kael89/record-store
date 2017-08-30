<?php
/* Program */
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/classes/User.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/lib/library.php";

switch (getGet("action")) {
    case "signup":
        if (getSession("user")) {
            break;
        }

        $firstName = trim(getPost("firstName"));
        $lastName = trim(getPost("lastName"));
        $email = trim(getPost("email"));
        $password = getPost("password");
        unset($_POST);

        $id = User::store($firstName, $lastName, $email, $password);
        if ($id > 0) {
            $user = new User($id, $firstName, $lastName, $email, $password);
            setSession(["user" => $user]);
        } else {
            echo 'Error: could not create user';
        }
        break;
    case "login":
        $email = trim(getPost("email"));
        $password = getPost("password");
        $user = User::login($email, $password);

        if ($user) {
            setSession(["user" => $user]);
        } else {
            echo 'User not found...';
        }
        break;
    case "logout":
        User::logout();
        break;
    default:
        break;
}
/********/

/* View */
$title = "Welcome to Metal Militia!";
require_once "templates/head.php";
require_once "templates/header.php";

?>

<p>Welcome to Metal Militia!</p>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/record-store/templates/footer.php";
/********/