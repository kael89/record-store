<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/library.php";
requirePhp("tables");
requirePhp("api", "user");
requirePhp("class", "user");

function createUser($firstName = "", $lastName = "", $email = "", $password = "", $admin = 0) {
    $row = [];

    if ($firstName === "" || $lastName === "" || $email === "" || $password === "") {
        return null;
    }
    $row["firstName"] = $firstName;
    $row["lastName"] = $lasstName;
    $row["email"] = $email;
    $row["password"] = getSalted($password);
    $row["admin"] = $admin;

    $insertId = insertRow("users", $row);
    if (!$insertId) {
        return null;
    }

    return new User($insertId, $firstName, $lastName, $email, $password, $admin);
}

function updateUser($id, $row) {
    if ($id < 1) {
        return false;
    }

    $conditions = [
        ["userId =", $id]
    ];
    
    return updateRows("users", $row, $conditions);
}

function loginUser($email, $password) {
    if (empty($email) || empty($password)) {
        return null;
    }

    $conditions = [
        ["email =", $email],
        ["password =", getSalted($password)]
    ];
    $result = getRows("users", $conditions);

    if (!$result) {
        return false;
    }

    extract($result[0]);
    $user = new User($userId, $firstName, $lastName, $email, $password, $admin);
    setSession(["user" => $user]);
    setSession(["admin" => $user->getAdmin()]);
    return true;
}

function logoutUser() {
    unsetSession("user");
    unsetSession("admin");
}
